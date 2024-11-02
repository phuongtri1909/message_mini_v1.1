<?php

namespace App\Http\Controllers;

use App\Models\Socials;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Lấy các cuộc trò chuyện mà user tham gia
        $conversations = Conversation::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['latestMessage'])->get();
        return view('pages.home', compact('conversations'));
    }

}
