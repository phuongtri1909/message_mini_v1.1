<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friend extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'friend_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

}
