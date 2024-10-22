<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'avatar',
        'cover_image',
        'email',
        'password',
        'key_reset_password',
        'reset_password_at',
        'phone',
        'date_of_birth',
        'gender',
        'google_id',
        'active',
        'key_active',
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

    public function conversations()
    {
        return $this->belongsToMany(User::class, 'conversation_user')
                ->withPivot('role', 'invited_by', 'nickname') // Thêm 'nickname' vào pivot
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

}
