<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public function updateLastSeen(User $user)
    {
        $user->last_seen = Carbon::now();
        $user->save();
    }
}