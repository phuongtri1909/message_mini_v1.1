<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialsController;
use App\Http\Controllers\FriendController;

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

Route::get('/', [HomeController::class , 'index'])->name('home');
Route::get('/listfriend', [HomeController::class, 'listfriend']) -> name ('listfriend');

Route::post('/search-friend', [FriendController::class, 'searchFriend']);
Route::post('/send-friend-request', [FriendController::class, 'sendFriendRequest']);
Route::post('/check-friend-request-status', [FriendController::class, 'checkFriendRequestStatus'])->name('check.friend.request.status');
Route::post('/cancel-friend-request', [FriendController::class, 'cancelFriendRequest'])->name('cancel.friend.request');


Route::group(['middleware' => 'auth'], function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
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

