<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialsController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    Route::get('/friend-requests', [FriendController::class, 'showFriendRequests'])->name('friend.requests'); //
    Route::post('/friend-requests/accept', [FriendController::class, 'acceptFriendRequestPage'])->name('friend.requests.accept.page'); // Đồng ý kết bạn từ trang friend-requests
    Route::post('/friend-requests/decline', [FriendController::class, 'declineFriendRequestPage'])->name('friend.requests.decline.page'); // Từ chối kết bạn từ trang friend-requests  
    Route::post('/search-friend', [FriendController::class, 'searchFriend']); // tìm kiếm người dùng
    Route::post('/send-friend-request', [FriendController::class, 'sendFriendRequest']); // gửi lời mời kết bạn
    Route::post('/check-friend-request-status', [FriendController::class, 'checkFriendRequestStatus'])->name('check.friend.request.status'); // kiểm tra trạng thái lời mời kết bạn
    Route::post('/cancel-friend-request', [FriendController::class, 'cancelFriendRequest'])->name('cancel.friend.request'); // thu hồi lời mời kết bạn
    Route::get('/get-friend-requests', [FriendController::class, 'getFriendRequests']); // lấy danh sách lời mời kết bạn
    Route::post('/accept-friend-request', [FriendController::class, 'acceptFriendRequest'])->name('friend.requests.accept'); // chấp nhận lời mời kết bạn
    Route::post('/decline-friend-request', [FriendController::class, 'declineFriendRequest'])->name('friend.requests.decline'); // từ chối lời mời kết bạn
    Route::get('/friends-list-modal', [FriendController::class, 'getFriendsList'])->name('friends.list.modal'); // danh sách bạn bè
    Route::get('/friends-list', [FriendController::class, 'showFriendsList'])->name('friends.list'); // danh sách bạn bè trang listfriend
    Route::post('/unfriend', [FriendController::class, 'unfriend'])->name('unfriend'); // Hủy kết bạn
    Route::get('/friends/search', [FriendController::class, 'searchFriends'])->name('friends.search'); // Tìm kiếm bạn bè
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');



    Route::get('/chat/{conversation_id}', [MessageController::class, 'openConversation'])->name('chat');
    Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');
    Route::get('/messages/{conversationId}', [MessageController::class, 'fetchMessages']);
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function () {
        return view('pages.auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', function () {
        return view('pages.auth.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/forgot-password', function () {
        return view('pages.auth.forgot-password');
    })->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');

    Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
});
