<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Message;
use App\Models\Invitation;
use App\Models\Conversation;
use App\Models\ConversationUser;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function generateRandomOTP($length = 6)
    {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= rand(0, 9);
        }
        return $otp;
    }

    // Kiem tra xem 2 nguoi dung co la ban be khong
    function areFriends($userId, $friendId) {
        return Friend::where('user_id', $userId)->where('friend_id', $friendId)->exists() ||
               Friend::where('user_id', $friendId)->where('friend_id', $userId)->exists();
    }

    // Tao cuoc tro chuyen
    function startConversation($userId, $friendId) {
        if (!$this->areFriends($userId, $friendId)) {
            return response('Not friends', 403);
        }
    
        $conversation = Conversation::create([
            'name' => 'Private Chat',
            'is_group' => false,
            'created_by' => $userId
        ]);
    
        ConversationUser::create(['conversation_id' => $conversation->id, 'user_id' => $userId]);
        ConversationUser::create(['conversation_id' => $conversation->id, 'user_id' => $friendId]);
    
        return $conversation;
    }

    // Tao nhom tro chuyen
    function createGroupConversation($creatorId, $name, $members) {
        $conversation = Conversation::create([
            'name' => $name,
            'is_group' => true,
            'created_by' => $creatorId
        ]);
    
        foreach ($members as $memberId) {
            ConversationUser::create([
                'conversation_id' => $conversation->id,
                'user_id' => $memberId,
                'invited_by' => $creatorId,
                'role' => 'member'
            ]);
        }
    
        return $conversation;
    }


    // Gui loi moi ket ban
    function inviteUserToGroup($conversationId, $invitedUserId, $invitedBy) {
        Invitation::create([
            'conversation_id' => $conversationId,
            'invited_user_id' => $invitedUserId,
            'invited_by' => $invitedBy,
            'status' => 'pending'
        ]);
    }
    

    // Gui tin nhan
    function sendMessage($conversationId, $senderId, $messageText) {
        return Message::create([
            'conversation_id' => $conversationId,
            'sender_id' => $senderId,
            'message' => $messageText
        ]);
    }

    // Lay danh sach cuoc tro chuyen cua nguoi dung
    function getConversations($userId) {
        return ConversationUser::where('user_id', $userId)->with('conversation')->get();
    }

    // Lay danh sach tin nhan cua cuoc tro chuyen
    function getConversationMessages($conversationId) {
        return Message::where('conversation_id', $conversationId)->with('sender')->get();
    }
    

    // Lay danh sach thanh vien cua cuoc tro chuyen
    function getConversationUsers($conversationId) {
        return ConversationUser::where('conversation_id', $conversationId)->with('user')->get();
    }

    function endcodeId($id) {
        $encryptionKey = env('ENCRYPTION_KEY');
        $encryptedId = openssl_encrypt($id, 'aes-256-cbc', $encryptionKey, 0, substr($encryptionKey, 0, 16));
        return base64_encode($encryptedId);
    }

    function decodeId($encryptedId) {
        $encryptionKey = env('ENCRYPTION_KEY');
    
        $encryptedId = base64_decode($encryptedId);
        $decryptedId = openssl_decrypt($encryptedId, 'aes-256-cbc', $encryptionKey, 0, substr($encryptionKey, 0, 16));
    
        if ($decryptedId === false) {
            return redirect()->back()->with('error', 'ID Không hợp lệ');
        }
    
        return $decryptedId;
    }
}
