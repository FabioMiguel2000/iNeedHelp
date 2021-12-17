<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function likes(): HasMany
    {
        return $this->reviews()->where('type', '=', 'like');
    }

    public function dislikes(): HasMany
    {
        return $this->reviews()->where('type', '=', 'dislike');
    }

    public function score(): int
    {
        return $this->likes()->count() - $this->dislikes()->count();
    }
}
