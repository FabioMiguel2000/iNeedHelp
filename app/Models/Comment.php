<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    //    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'question_id',
        'answer_id',
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(CommentReview::class);
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
}
