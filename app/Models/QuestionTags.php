<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class QuestionTags extends Model
{
//    public $timestamps  = false;

    protected $fillable = [
        'question_id',
        'tag_id',
    ];

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }

    // public function question_tags(): HasMany
    // {
    //     return $this->hasMany(QuestionTags::class);
    // }
}