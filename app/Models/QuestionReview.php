<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionReview extends Model
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

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
