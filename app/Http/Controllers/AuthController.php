<?php

namespace App\Http\Controllers;

use App\Mail\OTPForgotPWMail;
use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        if($request->has('email') && $request->has('otp') && $request->has('password')){
            try {
                $request->validate([
                    'email' => 'required|email',
                    'otp' => 'required',
                    'password' => 'required|min:6',
                ], [
                    'email.required' => 'Hãy nhập email của bạn vào đi',
                    'email.email' => 'Email bạn nhập không hợp lệ rồi',
                    'otp.required' => 'Hãy nhập mã OTP của bạn vào đi',
                    'password.required' => 'Hãy nhập mật khẩu của bạn vào đi',
                    'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->errors()
                ], 422);
            }

            try {
                $user = User::where('email', $request->email)->first();
                if (!$user) {
                    return response()->json([
                        'status' => 'error',
                        'message' => ['email' => ['Email này không hợp lệ']],
                    ], 422);
                }

                if (!password_verify($request->otp, $user->key_active)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => ['otp' => ['Mã OTP không chính xác']],
                    ], 422);
                }
                $user->key_active = null;
                $user->name = 'Nguoi dung ' . $user->id;
                $user->password = bcrypt($request->password);
                $user->active = 'active';
                $user->save();

                Auth::login($user);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Đăng ký thành công, chào mừng bạn đến với HOÀN XU',
                    'url' => route('home'),
                ]);

            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại sau.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
        try {
            $request->validate([
                'email' => 'required|email',
            ], [
                'email.required' => 'Hãy nhập email của bạn vào đi',
                'email.email' => 'Email bạn nhập không hợp lệ rồi',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Trả về lỗi validate dưới dạng JSON
            return response()->json([
                'status' => 'error',
                'message' => $e->errors()
            ], 422);
        }

        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user->active == 'active') {
                    return response()->json([
                        'status' => 'error',
                        'message' => ['email' => ['Email này đã tồn tại, hãy dùng email khác']],
                    ], 422);
                }

                if (!$user->updated_at->lt(Carbon::now()->subMinutes(3))) {
                    return response()->json([
                        'status' => 'error',
                        'message' => ['email' => ['Bạn chỉ có thể gửi lại sau 3 phút']],
                    ], 422);
                }
            } else {
                $user = new User();
                $user->email = $request->email;
            }

            $randomPassword = Str::random(10);
            $user->password = bcrypt($randomPassword);

            $otp = $this->generateRandomOTP();
            $user->key_active = bcrypt($otp);
            $user->save();

           Mail::to($user->email)->send(new OTPMail($otp));

            return response()->json([
                'status' => 'success',
                'message' => 'Đăng ký thành công, hãy kiểm tra email của bạn để lấy mã OTP',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại sau.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Hãy nhập email của bạn vào đi',
            'email.email' => 'Email bạn nhập không hợp lệ rồi',
            'password.required' => 'Hãy nhập mật khẩu của bạn vào đi',
        ]);

        try {
            
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'Thông tin xác thực không chính xác',
                ]);
            }

            if($user->active == 'inactive'){
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'Thông tin xác thực không chính xác',
                ]);
            }

            if (!password_verify($request->password, $user->password)) {
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'Thông tin xác thực không chính xác',
                ]);
            }

            Auth::login($user);

            if($user->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');

        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Đã xảy ra lỗi trong quá trình đăng nhập. Vui lòng thử lại sau.');
        }
    }

    public function logout(){
        Auth::logout(); 
        return redirect()->route(('home')); 
    }

    public function forgotPassword(Request $request){
        if($request->has('email')){
            try {
                $request->validate([
                    'email' => 'required|email',
                ], [
                    'email.required' => 'Hãy nhập email của bạn vào đi',
                    'email.email' => 'Email bạn nhập không hợp lệ rồi',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->errors()
                ], 422);
            }

            try {
                $user = User::where('email', $request->email)->first();
                if (!$user || $user->active == 'inactive') {
                    return response()->json([
                        'status' => 'error',
                        'message' => ['email' => ['Thông tin xác thực không chính xác']],
                    ], 422);
                }

                
                
                if($request->has('email') && $request->has('otp')){

                    try {
                        $request->validate([
                            'otp' => 'required',
                        ], [
                            'otp.required' => 'Hãy nhập mã OTP của bạn vào đi',
                        ]);
                    } catch (\Illuminate\Validation\ValidationException $e) {
                        return response()->json([
                            'status' => 'error',
                            'message' => $e->errors()
                        ], 422);
                    }

                    if (!password_verify($request->otp, $user->key_reset_password)) {
                        return response()->json([
                            'status' => 'error',
                            'message' => ['otp' => ['Mã OTP không chính xác']],
                        ], 422);
                    }

                    if($request->has('email') && $request->has('otp') && $request->has('password'))
                    {
                        try {
                            $request->validate([
                                'password' => 'required|min:6',
                            ], [
                                'password.required' => 'Hãy nhập mật khẩu của bạn vào đi',
                                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                            ]);
                        } catch (\Illuminate\Validation\ValidationException $e) {
                            return response()->json([
                                'status' => 'error',
                                'message' => $e->errors()
                            ], 422);
                        }
            
                        try {
                            
                            $user->key_reset_password = null;
                            $user->password = bcrypt($request->password);
                            $user->save();
            
                            Auth::login($user);
            
                            return response()->json([
                                'status' => 'success',
                                'message' => 'Đặt lại mật khẩu thành công',
                                'url' => route('home'),
                            ]);
            
                        } catch (Exception $e) {
                            return response()->json([
                                'status' => 'error',
                                'message' => 'Đã xảy ra lỗi trong quá trình đặt lại mật khẩu. Vui lòng thử lại sau.',
                                'error' => $e->getMessage(),
                            ], 500);
                        }
                    
                    }

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Hãy nhập mật khẩu mới của bạn',
                    ],200);
                }
                
                if ($user->reset_password_at != null) {
                    $resetPasswordAt = Carbon::parse($user->reset_password_at);
                    if (!$resetPasswordAt->lt(Carbon::now()->subMinutes(3))) {
                        return response()->json([
                            'status' => 'error',
                            'message' => ['email' => ['Bạn chỉ có thể gửi lại sau 3 phút']],
                        ], 422);
                    }
                }

                $randomOTPForgotPW = $this->generateRandomOTP();
                $user->key_reset_password = bcrypt($randomOTPForgotPW);
                $user->reset_password_at = Carbon::now();
                $user->save();

                Mail::to($user->email)->send(new OTPForgotPWMail($randomOTPForgotPW));
                return response()->json([
                    'status' => 'success',
                    'message' => 'Hãy kiểm tra email của bạn để lấy mã OTP',
                ],200);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Đã xảy ra lỗi trong quá trình đặt lại mật khẩu. Vui lòng thử lại sau.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
    }

    public function changePassword(){

    }
}
