<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
//    public $timestamps  = false;

    protected $fillable = [
        'id','name',
    ];

    public function question_tags(): HasMany
    {
        return $this->hasMany(QuestionTags::class);
    }

}
