<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ConversationUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{


    public function openConversation($conversationId)
    {
        $userId = Auth::id();

        // Lấy cuộc trò chuyện cụ thể với các thông tin cần thiết
        $conversation = Conversation::where('id', $conversationId)
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->with(['latestMessage', 'users' => function ($query) use ($userId) {
                $query->where('user_id', '!=', $userId); // Lấy thông tin người bạn
            }, 'creator', 'conversationUsers' => function ($query) {
                $query->with('user'); // Lấy thông tin user từ bảng conversation_user
            }])
            ->first();

        if (!$conversation) {
            return response()->json(['status' => 'error', 'message' => 'Không tìm thấy cuộc trò chuyện'], 404);
        }

        // Lấy thông tin người bạn nếu không phải nhóm
        if (!$conversation->is_group) {
            $conversation->friend = $conversation->users->first();
        }

        // Lấy tin nhắn cuối cùng và định dạng thời gian
        $now = Carbon::now();
        if ($conversation->latestMessage) {
            $latestMessageTime = Carbon::parse($conversation->latestMessage->created_at);
            $conversation->latestMessage->time_diff = $this->formatTimeDiff($latestMessageTime, $now);
        } else {
            $conversation->time_diff = $this->formatTimeDiff($conversation->created_at, $now);
        }

        // Lấy thông tin từ bảng conversation_user
        $conversation->conversationUserInfo = ConversationUser::where('conversation_id', $conversation->id)->get();

        // Lấy 20 tin nhắn mới nhất của cuộc trò chuyện này
        $conversation->messages = Message::where('conversation_id', $conversation->id)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->with('sender')
            ->get();

        $html = view('components.window_chat', ['conversation' => $conversation])->render();
        return response()->json(['html' => $html]);
    }

    private function formatTimeDiff($latestTime, $now)
    {
        if ($latestTime->diffInSeconds($now) < 60) {
            return $latestTime->diffInSeconds($now) . ' giây trước';
        } elseif ($latestTime->diffInMinutes($now) < 60) {
            return $latestTime->diffInMinutes($now) . ' phút trước';
        } elseif ($latestTime->diffInHours($now) < 24) {
            return $latestTime->diffInHours($now) . ' giờ trước';
        } else {
            return $latestTime->diffInDays($now) . ' ngày trước';
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
            $message->sender->avatar_url = $message->sender->avatar ? asset($message->sender->avatar) : asset('/assets/images/avatar_default.jpg');

            // Phát sự kiện tin nhắn
            broadcast(new MessageSent($message))->toOthers();

            return response()->json(['status' => 'success', 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
