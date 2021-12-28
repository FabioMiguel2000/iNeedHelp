<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'content',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function reviews() {
        return $this->hasMany(AnswerReview::class);
    }

    public function reviewedBy(User $user)
    {
        return $this->reviews->contains('user_id', $user->id);
    }

    public function likes() {
        return $this->reviews()->where('type', '=', 'like');
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function dislikes(): HasMany
    {
        return $this->reviews()->where('type', '=', 'dislike');
    }

    public function dislikedBy(User $user)
    {
        return $this->dislikes->contains('user_id', $user->id);
    }

    public function score(): int
    {
        return $this->likes()->count() - $this->dislikes()->count();
    }
}
