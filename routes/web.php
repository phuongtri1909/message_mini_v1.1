<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialsController;

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

Route::get('/shopee', function () {
    return view('pages.E-commerce.shopee.index');
})->name('shopee');


Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role.admin'], function () {

        Route::get('/import-banks', [BankController::class, 'importBanks']);

        Route::group(['prefix' => 'admin'], function () {
            Route::get('/dashboard', function () {
                return view('admin.pages.dashboard');
            })->name('admin.dashboard');

            Route::get('/login', function () {
                return view('admin.pages.auth.login');
            })->name('admin.login');

            Route::get('users', [UserController::class, 'index'])->name('users.index');

            Route::get('socials', [SocialsController::class, 'index'])->name('socials.index');
            Route::get('socials/edit/{social}', [SocialsController::class, 'edit'])->name('socials.edit');
            Route::put('socials/update/{social}', [SocialsController::class, 'update'])->name('socials.update');
        });
    });

    Route::group(['middleware' => 'role.user'], function () {
        Route::get('user-profile', [UserController::class, 'userProfile'])->name('user-profile');


        Route::post('update-profile/update-name-or-phone', [UserController::class, 'updateNameOrPhone'])->name('update.name.or.phone');
        Route::post('update-avatar', [UserController::class, 'updateAvatar'])->name('update.avatar');
        Route::post('update-password', [UserController::class, 'updatePassword'])->name('update.password');
        Route::post('update-bank-account', [UserController::class, 'updateBankAccount'])->name('update.bank.account');
    });

    Route::group(['middleware' => 'role.admin.user'], function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
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

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/login', function () {
            return view('admin.pages.auth.login');
        })->name('admin.login');
    });
});
