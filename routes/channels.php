<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::routes(['middleware' => ['auth:api']]);

Broadcast::channel('chat.{conversationId}', function ($user, $conversationId) {
    // Kiểm tra xem người dùng có quyền truy cập vào cuộc trò chuyện này không
    return $user->conversations()->where('id', $conversationId)->exists();
});