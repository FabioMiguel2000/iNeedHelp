<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
   public $timestamps  = false;

    protected $fillable = [
        'id',
        'name',
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class,'question_tags');
    }
}
