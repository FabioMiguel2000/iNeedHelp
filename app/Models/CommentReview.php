<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentReview extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comment() {
        return $this->belongsTo(Comment::class);
    }
}
