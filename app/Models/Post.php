<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'content', 'image', 'privacy'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
{
    return $this->hasMany(Like::class);
}
public function getIsLikedAttribute()
{
    return $this->likes()->where('user_id', auth()->id())->exists();
}
}
