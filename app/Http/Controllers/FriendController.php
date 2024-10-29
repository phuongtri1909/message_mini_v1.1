<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    
    
public function searchFriend(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|max:100',
    ], [
        'email.required' => 'Vui lòng nhập email.',
        'email.email' => 'Vui lòng nhập định dạng email hợp lệ.',
        'email.max' => 'Email không được vượt quá 100 ký tự.',
    ]);

    // Kiểm tra nếu dữ liệu đầu vào không hợp lệ
    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()->first('email'),
        ]);
    }

    $email = $request->input('email');
    $user = User::where('email', $email)->first();
    $currentUser = Auth::user();

    // Kiểm tra nếu người dùng đang tìm kiếm chính mình
    if ($currentUser->email === $email) {
        return response()->json(['status' => 'error', 'message' => 'Bạn đang tìm kiếm chính mình.']);
    }

    if ($user) {
        return response()->json([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'gender' => $user->gender
            ],
        ]);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Không tìm thấy người dùng.']);
    }
}

    
//Gửi lời mời kết bạn

public function sendFriendRequest(Request $request)
{
    $friendId = $request->input('friend_id');
    $user = Auth::user();

    // Kiểm tra xem hai người đã là bạn bè chưa
    $areFriends = DB::table('friends')->where(function ($query) use ($user, $friendId) {
        $query->where('user_id', $user->id)
            ->where('friend_id', $friendId);
    })->orWhere(function ($query) use ($user, $friendId) {
        $query->where('user_id', $friendId)
            ->where('friend_id', $user->id);
    })->exists();

    if ($areFriends) {
        return response()->json(['status' => 'error', 'message' => 'Các bạn đã là bạn bè rồi, không thể gửi yêu cầu kết bạn.']);
    }

    // Kiểm tra xem đã gửi yêu cầu kết bạn chưa
    $existingRequestSent = FriendRequest::where([
        ['sender_id', $user->id],
        ['receiver_id', $friendId],
        ['status', 'pending']
    ])->first();

    // Kiểm tra xem người đó đã gửi yêu cầu kết bạn cho bạn chưa
    $existingRequestReceived = FriendRequest::where([
        ['sender_id', $friendId],
        ['receiver_id', $user->id],
        ['status', 'pending']
    ])->first();

    if ($existingRequestSent) {
        return response()->json(['status' => 'error', 'message' => 'Bạn đã gửi yêu cầu trước đó.']);
    }

    if ($existingRequestReceived) {
        return response()->json(['status' => 'error', 'message' => 'Người này đã gửi lời mời kết bạn cho bạn rồi, không thể gửi yêu cầu kết bạn.']);
    }

    // Tạo yêu cầu kết bạn mới
    FriendRequest::create([
        'sender_id' => $user->id,
        'receiver_id' => $friendId,
        'status' => 'pending'
    ]);

    return response()->json(['status' => 'success', 'message' => 'Yêu cầu kết bạn đã được gửi.']);
}


    // Kiểm tra trạng thái yêu cầu kết bạn
    public function checkFriendRequestStatus(Request $request)
    {
        $friendId = $request->input('friend_id');
        $user = Auth::user();
    
        // Kiểm tra trạng thái bạn bè
        $areFriends = DB::table('friends')->where(function ($query) use ($user, $friendId) {
            $query->where('user_id', $user->id)
                ->where('friend_id', $friendId);
        })->orWhere(function ($query) use ($user, $friendId) {
            $query->where('user_id', $friendId)
                ->where('friend_id', $user->id);
        })->exists();
    
        if ($areFriends) {
            return response()->json(['status' => 'friends']);
        }
    
        // Kiểm tra trạng thái yêu cầu kết bạn từ người dùng hiện tại đến người bạn
        $friendRequestSent = FriendRequest::where([
            ['sender_id', $user->id],
            ['receiver_id', $friendId],
            ['status', 'pending']
        ])->first();
    
        // Kiểm tra trạng thái yêu cầu kết bạn từ người bạn đến người dùng hiện tại
        $friendRequestReceived = FriendRequest::where([
            ['sender_id', $friendId],
            ['receiver_id', $user->id],
            ['status', 'pending']
        ])->first();
    
        if ($friendRequestSent) {
            return response()->json(['status' => 'sent']);
        }
    
        if ($friendRequestReceived) {
            return response()->json(['status' => 'received']);
        }
    
        return response()->json(['status' => 'none']);
    }
    //Thu hồi lời mời
    public function cancelFriendRequest(Request $request)
    {
        $friendId = $request->input('friend_id');
        $user = Auth::user();

        $friendRequest = FriendRequest::where([
            ['sender_id', $user->id],
            ['receiver_id', $friendId],
            ['status', 'pending']
        ])->first();

        if ($friendRequest) {
            $friendRequest->delete();
            return response()->json(['status' => 'success', 'message' => 'Đã thu hồi yêu cầu kết bạn.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Yêu cầu đã được xử lý hoặc không tồn tại.']);
    }

    // Đồng ý kết bạn
    public function acceptFriendRequest(Request $request)
    {
        $requestId = $request->input('request_id'); // ID của yêu cầu kết bạn
        $friendRequest = FriendRequest::find($requestId);
    
        if ($friendRequest && $friendRequest->status === 'pending') {
            // Cập nhật trạng thái yêu cầu
            $friendRequest->status = 'accepted';
            $friendRequest->save();
    
            // Tạo mối quan hệ bạn bè
            DB::table('friends')->insert([
                'user_id' => $friendRequest->sender_id,   // ID của người gửi yêu cầu
                'friend_id' => $friendRequest->receiver_id, // ID của người nhận yêu cầu
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Xóa yêu cầu kết bạn sau khi đã chấp nhận
            $friendRequest->delete();
    
            return response()->json(['status' => 'success', 'message' => 'Bạn đã chấp nhận yêu cầu kết bạn.']);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Không tìm thấy yêu cầu kết bạn hoặc yêu cầu đã được xử lý.']);
    }

    // Từ chối

    public function declineFriendRequest(Request $request)
{
    $requestId = $request->input('request_id'); // ID của yêu cầu kết bạn
    $friendRequest = FriendRequest::find($requestId);

    if ($friendRequest) {
        // Kiểm tra trạng thái yêu cầu, chỉ xóa nếu nó đang ở trạng thái pending
        if ($friendRequest->status === 'pending') {
            // Xóa yêu cầu kết bạn
            $friendRequest->delete();
            return response()->json(['status' => 'success', 'message' => 'Bạn đã từ chối yêu cầu kết bạn.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Yêu cầu đã được xử lý trước đó.']);
        }
    }

    return response()->json(['status' => 'error', 'message' => 'Không tìm thấy yêu cầu kết bạn.']);
}

public function getFriendRequests()
{
    $user = Auth::user();

    // Lấy danh sách yêu cầu kết bạn mà người dùng hiện tại là người nhận
    $friendRequests = FriendRequest::where('receiver_id', $user->id)
        ->where('status', 'pending')
        ->with('sender:id,name,avatar') // Giả sử 'sender' là quan hệ đến user gửi yêu cầu
        ->get(['id', 'sender_id', 'created_at']);

    return response()->json([
        'status' => 'success',
        'requests' => $friendRequests,
    ]);
}
//Hiển thị yêu cầu kết bạn
public function showFriendRequests()
{
    $user = Auth::user();

    // Lấy danh sách yêu cầu kết bạn mà người dùng hiện tại là người nhận
    $friendRequests = FriendRequest::where('receiver_id', $user->id)
        ->where('status', 'pending')
        ->with('sender:id,name,avatar') // Giả sử 'sender' là quan hệ đến user gửi yêu cầu
        ->get();

    return view('modals.friend_requests', compact('friendRequests'));
}

// lấy danh sách bạn bè
public function getFriendsList()
{
    $user = Auth::user();

    // Lấy danh sách bạn bè bao gồm cả hai chiều
    $friends = DB::table('friends')
        ->join('users', function ($join) use ($user) {
            $join->on('friends.friend_id', '=', 'users.id')
                ->orOn('friends.user_id', '=', 'users.id');
        })
        ->where(function ($query) use ($user) {
            $query->where('friends.user_id', $user->id)
                ->orWhere('friends.friend_id', $user->id);
        })
        ->where('users.id', '!=', $user->id) // Loại bỏ người dùng hiện tại khỏi danh sách bạn bè
        ->select('users.id', 'users.name', 'users.email', 'users.avatar', 'users.gender')
        ->distinct()
        ->get();

    return response()->json([
        'status' => 'success',
        'friends' => $friends,
    ]);
}

public function showFriendsList()
    {
        $user = Auth::user();

        // Lấy danh sách bạn bè bao gồm cả hai chiều
        $friends = DB::table('friends')
            ->join('users', function ($join) use ($user) {
                $join->on('friends.friend_id', '=', 'users.id')
                    ->orOn('friends.user_id', '=', 'users.id');
            })
            ->where(function ($query) use ($user) {
                $query->where('friends.user_id', $user->id)
                    ->orWhere('friends.friend_id', $user->id);
            })
            ->where('users.id', '!=', $user->id) // Loại bỏ người dùng hiện tại khỏi danh sách bạn bè
            ->select('users.id', 'users.name', 'users.email', 'users.avatar', 'users.gender')
            ->distinct()
            ->get();

        return view('layouts.listfriend', ['friends' => $friends]);
    }

    //hủy kết bạn
   
    public function unfriend(Request $request)
    {
        $friendId = $request->input('friend_id');
        $user = Auth::user();
    
        // Kiểm tra xem mối quan hệ bạn bè có tồn tại hay không
        $friendship = DB::table('friends')
            ->where(function ($query) use ($user, $friendId) {
                $query->where('user_id', $user->id)
                    ->where('friend_id', $friendId);
            })
            ->orWhere(function ($query) use ($user, $friendId) {
                $query->where('user_id', $friendId)
                    ->where('friend_id', $user->id);
            })
            ->first();
    
        if ($friendship) {
            // Xóa mối quan hệ bạn bè
            DB::table('friends')
                ->where(function ($query) use ($user, $friendId) {
                    $query->where('user_id', $user->id)
                        ->where('friend_id', $friendId);
                })
                ->orWhere(function ($query) use ($user, $friendId) {
                    $query->where('user_id', $friendId)
                        ->where('friend_id', $user->id);
                })
                ->delete();
    
            return redirect()->back()->with('success', 'Đã hủy kết bạn thành công.');
        } else {
            return redirect()->back()->with('error', 'Mối quan hệ bạn bè không tồn tại nữa.');
        }
    }
}
