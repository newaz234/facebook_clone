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
        'cover_photo',
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
    public function allfriends()
    {
        $sentFriends = $this->sentFriends()->get();
        $receivedFriends = $this->receivedFriends()->get();

        // merge করে duplicate বাদ দাও (id অনুযায়ী)
        return $sentFriends->merge($receivedFriends)->unique('id')->values();
    }
// যাদের আমি ফ্রেন্ড রিকোয়েস্ট পাঠিয়েছি (accepted হয়েছে)
public function sentFriends()
{
    return $this->belongsToMany(User::class, 'friend_requests', 'sender_id', 'receiver_id')
                ->wherePivot('status', 'accepted')
                ->withTimestamps();
}
public function isFriendWith($userId)
{
    return $this->sentFriends()->where('users.id', $userId)->exists() ||
           $this->receivedFriends()->where('users.id', $userId)->exists();
}
public function hasSentFriendRequestTo($userId)
{
    return $this->sentFriendRequests()
                ->where('receiver_id', $userId)
                ->where('status', 'pending')
                ->exists();
}
public function hasReceivedFriendRequestFrom($userId)
{
    return $this->receivedFriendRequests()
                ->where('sender_id', $userId)
                ->where('status', 'pending')
                ->exists();
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
        $sentF = $this->sentFriends()->pluck('users.id');
        $receiveF = $this->receivedFriends()->pluck('users.id');
        $myfriends = $sentF->merge($receiveF)->unique()->values()->toArray();
        $sentOF =$otherUser->sentFriends()->pluck('users.id');
        $receiveOF = $otherUser->receivedFriends()->pluck('users.id');
        $otherfriends = $sentOF->merge($receiveOF)->unique()->values()->toArray();
        $mutualCount = count(array_intersect($myfriends,  $otherfriends));

        return $mutualCount;
    }
    public function likes()
{
    return $this->hasMany(Like::class);
}
public function conversations()
{
    return $this->belongsToMany(Conversation::class, 'participants')
                ->withTimestamps();
}

public function messages()
{
    return $this->hasMany(Message::class);
}

public function participants()
{
    return $this->hasMany(Participant::class);
}
}