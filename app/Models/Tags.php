<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasMany;

class Tags extends Model
{
//    public $timestamps  = false;

    protected $fillable = [
        'name',
    ];

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function answers(): HasMany
    // {
    //     return $this->hasMany(Answer::class);
    // }

    // public function comments(): HasMany
    // {
    //     return $this->hasMany(Comment::class);
    // }

    // public function likes(): HasMany
    // {
    //     return $this->reviews()->where('type', '=', 'like');
    // }

}
