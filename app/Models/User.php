<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UserStatusTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserStatusTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     // Model người dùng
    protected $fillable = [
        'name',
        'phone',
        'dov',
        'gender',
        'google_id',
        'email',
        'avatar',
        'cover_image',
        'description',
        'active',
        'key_active',
        'password',
        'key_reset_password',
        'key_reset_password_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
        public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }
    

    public function friendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function isFriendsWith($userId)
    {
        return $this->friends()->where('friend_id', $userId)->exists();
    }

    // public function conversations()
    // {
    //     return $this->belongsToMany(User::class, 'conversation_user')
    //         ->withPivot('role', 'invited_by', 'nickname') // Thêm 'nickname' vào pivot
    //         ->withTimestamps();
    // }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user')
                    ->withPivot('role')
                    ->withTimestamps();
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'invited_user_id');
    }
    public function sentFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function canJoinConversation($conversationId)
    {
        return $this->conversations()->where('conversation_id', $conversationId)->exists();
    }
}
