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
use App\Models\User;

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


    public function openConversationByUser($userId)
    {
        $currentUserId = Auth::id();

        // Tìm hoặc tạo cuộc trò chuyện giữa người dùng hiện tại và người dùng được chọn
        $conversation = Conversation::whereHas('users', function ($query) use ($currentUserId) {
            $query->where('user_id', $currentUserId);
        })
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('is_group', false)
            ->with(['latestMessage', 'users', 'messages.sender'])
            ->first();

        if (!$conversation) {
            // Tạo cuộc trò chuyện mới nếu chưa tồn tại
            $conversation = Conversation::create([
                'is_group' => false,
                'created_by' => $currentUserId,
            ]);

            // Thêm người dùng vào cuộc trò chuyện
            $conversation->users()->attach([$currentUserId, $userId]);
        }

        // Lấy thông tin người bạn nếu không phải nhóm
        if (!$conversation->is_group) {
            $conversation->friend = $conversation->users->firstWhere('id', '!=', $currentUserId);
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

        return response()->json(['status' => 'success', 'html' => $html]);
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
        //return response()->json(['status' => 'error', 'message' => $request->all()]);
        try {
            $request->validate([
                'conversation_id' => 'required|exists:conversations,id',
                'message' => 'nullable|string',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // 5MB = 5120KB
                'files.*' => 'nullable|mimes:pdf,doc,docx,txt,xls,xlsx,zip,rar|max:5120' // 5MB = 5120KB
            ], [
                'conversation_id.required' => 'Không tìm thấy cuộc trò chuyện',
                'conversation_id.exists' => 'Cuộc trò chuyện không tồn tại',
                'message.string' => 'Nội dung tin nhắn phải là chuỗi',
                'images.*.image' => 'Tệp phải là hình ảnh',
                'images.*.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg',
                'images.*.max' => 'Hình ảnh không được vượt quá 5MB',
                'files.*.mimes' => 'Tệp phải có định dạng: pdf, doc, docx, txt, xls, xlsx, zip, rar',
                'files.*.max' => 'Tệp không được vượt quá 5MB'
            ]);

            $conversationId = $request->input('conversation_id');
            $senderId = Auth::id();
            $messageText = $request->input('message');

            if (empty($messageText) && $request->hasFile('images') && $request->hasFile('files')) {
                return response()->json(['status' => 'error', 'message' => 'Nội dung tin nhắn không được để trống'], 422);
            }

            $messages = [];

            if (!empty($messageText)) {
                $message = Message::create([
                    'conversation_id' => $conversationId,
                    'sender_id' => $senderId,
                    'message' => $messageText,
                    'type' => 'message'
                ]);
                $messages[] = $message;
            }

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    $currentDate = now()->format('Y/m/d');
                    $filename = 'image_' . now()->timestamp . '.' . $image->getClientOriginalExtension();
                    $path = $image->move(public_path("/uploads/images/{$currentDate}"), $filename);
                    $messageContent = "/uploads/images/{$currentDate}/{$filename}";

                    $message = Message::create([
                        'conversation_id' => $conversationId,
                        'sender_id' => $senderId,
                        'message' => $messageContent,
                        'type' => 'image'
                    ]);
                    $messages[] = $message;
                }
            }

            if ($request->hasFile('files')) {
                $files = $request->file('files');
                foreach ($files as $file) {
                    $currentDate = now()->format('Y/m/d');
                    $filename = 'file_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
                    $path = $file->move(public_path("/uploads/files/{$currentDate}"), $filename);
                    $messageContent = "/uploads/files/{$currentDate}/{$filename}";

                    $message = Message::create([
                        'conversation_id' => $conversationId,
                        'sender_id' => $senderId,
                        'message' => $messageContent,
                        'type' => 'file'
                    ]);
                    $messages[] = $message;
                }
            }

            foreach ($messages as $message) {
                $message->load('sender');
                $message->sender->avatar_url = $message->sender->avatar ? asset($message->sender->avatar) : asset('/assets/images/avatar_default.jpg');
                $message->time_diff = $this->formatTimeDiff($message->created_at, Carbon::now());

                $message->conversation = $message->conversation;

                // Phát sự kiện tin nhắn
                broadcast(new MessageSent($message))->toOthers();
            }

            return response()->json(['status' => 'success', 'messages' => $messages]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function showChat($conversationId)
    {
        $user = Auth::user();
        $conversation = Conversation::findOrFail($conversationId);

        // Lấy danh sách bạn bè của người dùng hiện tại
        $friends = User::whereHas('friends', function ($query) use ($user) {
            $query->where('friend_id', $user->id)
                  ->orWhere('user_id', $user->id);
        })->get();

        return view('window_chat', compact('friends', 'conversation'));
    }
}
