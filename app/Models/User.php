<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'surname',
        'email',
        'password',
        'day',
        'month',
        'year',
        'gender',
        'verification_code',
        'is_verified',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function posts()
{
    return $this->hasMany(Post::class);
}
public function sentFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'sender_id', 'receiver_id')
        ->wherePivot('status', 'accepted')
        ->withTimestamps();
    }
// যাদের আমি ফ্রেন্ড রিকোয়েস্ট পাঠিয়েছি (accepted হয়েছে)
public function sentFriends()
{
    return $this->belongsToMany(User::class, 'friend_requests', 'sender_id', 'receiver_id')
                ->wherePivot('status', 'accepted')
                ->withTimestamps();
}

// যাদের কাছ থেকে আমি রিকোয়েস্ট পেয়েছি (accepted হয়েছে)
public function receivedFriends()
{
    return $this->belongsToMany(User::class, 'friend_requests', 'receiver_id', 'sender_id')
                ->wherePivot('status', 'accepted')
                ->withTimestamps();
}

    public function pendingFriendRequests()
    {
        return $this->receivedFriendRequests()->where('status', 'pending');
    }

    public function mutualFriendsCount($otherUser)
    {
        $myFriendIds = $this->friends()->pluck('users.id')->toArray();
$otherFriendIds = $otherUser->friends()->pluck('users.id')->toArray();

$mutualCount = count(array_intersect($myFriendIds, $otherFriendIds));

return $mutualCount;
    }
}