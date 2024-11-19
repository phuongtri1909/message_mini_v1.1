<?php

namespace App\Traits;

use Carbon\Carbon;

trait UserStatusTrait
{
    public function isOnline()
    {
        return $this->last_seen && Carbon::parse($this->last_seen)->diffInMinutes(now()) < 1;
    }
}