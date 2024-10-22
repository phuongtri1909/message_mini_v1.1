<?php

namespace App\Http\Controllers;

use App\Models\Socials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class SocialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socials = Socials::all();

        return view('admin.pages.socials.index', compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Socials $socials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($socials)
    {
        $social = Socials::find($socials);

        if (!$social) {
            return redirect()->route('socials.index')->with('error', 'Không tìm thấy thông tin mạng xã hội để chỉnh sửa');
        }

        return view('admin.pages.socials.edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $socials)
    {
        $social = Socials::find($socials);

        if (!$social) {
            return redirect()->route('socials.index')->with('error', 'Không tìm thấy thông tin mạng xã hội để cập nhật');
        }

        $this->validate($request, [
            'sub' => 'required',
            'url' => 'required|url',
        ], [
            'sub.required' => 'Vui lòng nhập thông tin mô tả',
            'url.required' => 'Vui lòng nhập đường dẫn',
            'url.url' => 'Đường dẫn không hợp lệ'
        ]);

        if ($request->hasFile('icon')) {
            $this->validate($request, [
                'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'icon.image' => 'Tệp tải lên phải là hình ảnh',
                'icon.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif, svg',
                'icon.max' => 'Hình ảnh tải lên không được vượt quá 2MB'
            ]);
        }


        DB::beginTransaction();
        try {

            if ($request->hasFile('icon')) {
                $iconBackup = $social->icon;
                $iconName = $social->id . time() . '.' . $request->icon->extension();
                $request->icon->move(public_path('/uploads/images/icon/'), $iconName);
                $iconPath = '/uploads/images/icon/' . $iconName;
    
                $social->icon = $iconPath;
            }
        
            $social->sub = $request->sub;
            $social->url = $request->url;
            $social->save();
            DB::commit();

            if (isset($iconBackup) && File::exists($iconBackup)) {
                $iconPath = public_path('/uploads/images/icon');
                if (strpos(realpath($iconBackup), realpath($iconPath)) === 0) {
                    File::delete($iconBackup);
                }
            }

            return redirect()->route('socials.index')->with('success', 'Cập nhật thông tin mạng xã hội thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            if (File::exists($iconPath)) {
                File::delete($iconPath);
            }
            return redirect()->route('socials.index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Socials $socials)
    {
        //
    }
}
