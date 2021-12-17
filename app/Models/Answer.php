<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    public $timestamps = false;

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

    public function likes() {
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
