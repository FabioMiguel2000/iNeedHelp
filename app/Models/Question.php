<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
//    public $timestamps  = false;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function acceptedAnswer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(QuestionReview::class);
    }

    public function reviewedBy(User $user)
    {
        return $this->reviews->contains('user_id', $user->id);
    }

    public function likes(): HasMany
    {
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

    public function question_tags(): HasMany
    {
        return $this->hasMany(QuestionTags::class);
    }
    public function followed_by(): HasMany
    {
        return $this->hasMany(FollowQuestion::class);
    }
}
