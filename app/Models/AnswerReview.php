<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerReview extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
