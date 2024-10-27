<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FriendRequest;

use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function searchFriend(Request $request)
    {
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


public function sendFriendRequest(Request $request)
{
    $friendId = $request->input('friend_id');
    $user = Auth::user();

    // Kiểm tra yêu cầu kết bạn đã tồn tại chưa
    $existingRequest = FriendRequest::where([
        ['sender_id', $user->id],
        ['receiver_id', $friendId]
    ])->first();

    if (!$existingRequest) {
        // Tạo yêu cầu kết bạn mới
        FriendRequest::create([
            'sender_id' => $user->id,
            'receiver_id' => $friendId,
            'status' => 'pending'
        ]);

        return response()->json(['status' => 'success', 'message' => 'Yêu cầu kết bạn đã được gửi.']);
    }

    return response()->json(['status' => 'error', 'message' => 'Bạn đã gửi yêu cầu trước đó.']);
}


public function checkFriendRequestStatus(Request $request)
{
    $friendId = $request->input('friend_id');
    $user = Auth::user();

    $friendRequest = FriendRequest::where([
        ['sender_id', $user->id],
        ['receiver_id', $friendId],
        ['status', 'pending']
    ])->first();

    if ($friendRequest) {
        return response()->json(['status' => 'pending']);
    }

    return response()->json(['status' => 'not_pending']);
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

    return response()->json(['status' => 'error', 'message' => 'Không tìm thấy yêu cầu kết bạn.']);
}

}
