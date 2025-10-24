<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'is_group'];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'participants')
                    ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

    // Check if user is participant
    public function isParticipant($userId)
    {
        return $this->participants()->where('user_id', $userId)->exists();
    }

    // Mark messages as read for a user
    public function markAsRead($userId)
    {
        $this->messages()->where('user_id', '!=', $userId)
             ->update(['is_read' => true]);
        
        $this->participants()->where('user_id', $userId)
             ->update(['last_read' => now()]);
    }
}