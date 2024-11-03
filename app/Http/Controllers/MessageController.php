<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    

    public function openConversation($conversationId)
    {
        $conversation = Conversation::find($this->decodeId($conversationId));
        
        if (!$conversation) {
            return redirect()->route('home')->with('error', 'Cuộc trò chuyện không tồn tại');
        }

        
    }

    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'conversation_id' => 'required|exists:conversations,id',
                'message' => 'required|string'
            ], [
                'conversation_id.required' => 'Không tìm thấy cuộc trò chuyện',
                'conversation_id.exists' => 'Cuộc trò chuyện không tồn tại',
                'message.required' => 'Nội dung tin nhắn không được để trống',
                'message.string' => 'Nội dung tin nhắn phải là chuỗi'
            ]);
    
            $conversationId = $request->input('conversation_id');
            $senderId = Auth::id();
            $messageText = $request->input('message');
    
            $message = Message::create([
                'conversation_id' => $conversationId,
                'sender_id' => $senderId,
                'message' => $messageText
            ]);

            $message->load('sender');
    
            // Phát sự kiện tin nhắn
            broadcast(new MessageSent($message))->toOthers();
    
            return response()->json(['status' => 'success', 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
