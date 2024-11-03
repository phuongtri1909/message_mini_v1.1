<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Message;
use App\Models\Socials;
use App\Models\Conversation;
use App\Models\ConversationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Lấy các cuộc trò chuyện mà user tham gia và có tin nhắn
        $conversations = Conversation::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->whereHas('messages') // Chỉ lấy các cuộc trò chuyện có tin nhắn
            ->with(['latestMessage', 'users' => function ($query) use ($userId) {
                $query->where('user_id', '!=', $userId); // Lấy thông tin người bạn
            }])
            ->get();

        // Kiểm tra nếu không có cuộc trò chuyện nào
        if ($conversations->isEmpty()) {
            return view('pages.home', compact('conversations'));
        }

        // Lọc các cuộc trò chuyện không phải nhóm và lấy thông tin người bạn
        $conversations = $conversations->map(function ($conversation) use ($userId) {
            if (!$conversation->is_group) {
                $conversation->friend = $conversation->users->first();
            }

            // Lấy tin nhắn cuối cùng và định dạng thời gian
            if ($conversation->latestMessage) {
                $latestMessageTime = Carbon::parse($conversation->latestMessage->created_at);
                $now = Carbon::now();

                if ($latestMessageTime->diffInSeconds($now) < 60) {
                    $conversation->latestMessage->time_diff = $latestMessageTime->diffInSeconds($now) . ' giây trước';
                } elseif ($latestMessageTime->diffInMinutes($now) < 60) {
                    $conversation->latestMessage->time_diff = $latestMessageTime->diffInMinutes($now) . ' phút trước';
                } elseif ($latestMessageTime->diffInHours($now) < 24) {
                    $conversation->latestMessage->time_diff = $latestMessageTime->diffInHours($now) . ' giờ trước';
                } else {
                    $conversation->latestMessage->time_diff = $latestMessageTime->diffInDays($now) . ' ngày trước';
                }
            }
            return $conversation;
        });

        // Sắp xếp các cuộc trò chuyện theo tin nhắn mới nhất
        $conversations = $conversations->sortByDesc(function ($conversation) {
            return $conversation->latestMessage->created_at;
        });

        // Lấy cuộc trò chuyện có tin nhắn mới nhất
        $latestConversation = $conversations->first();
        
        if ($latestConversation) {
            // Lấy thông tin từ bảng conversation_user
            $latestConversation->conversationUserInfo = ConversationUser::where('conversation_id', $latestConversation->id)
                ->get();
            
            // Lấy 20 tin nhắn mới nhất của cuộc trò chuyện này
            $latestConversation->messages = Message::where('conversation_id', $latestConversation->id)
                ->orderBy('created_at', 'desc')
                ->take(20)
                ->with('sender')
                ->get();

        }

        return view('pages.home', compact('conversations', 'latestConversation'));
    }
}
