<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory,Notifiable;

    // Don't add create and update timestamps in database.
    // public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'full_name',
        'email',
        'password',
        'status',
        'bio',
        'location',
        'is_blocked',
        'profile_image_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questionReviews()
    {
        return $this->hasMany(QuestionReview::class);
    }

    public function answerReviews()
    {
        return $this->hasMany(AnswerReview::class);
    }

    public function commentReviews()
    {
        return $this->hasMany(CommentReview::class);
    }

    public function followQuestion()
    {
        return $this->hasMany(FollowQuestion::class);
    }

    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'user_id');
    }

    public function moderator()
    {
        return $this->hasOne(Moderator::class, 'user_id');
    }

    public function isAdministrator(): bool
    {
        return $this->administrator()->exists();
    }

    public function isModerator():bool
    {
        return $this->moderator()->exists();
    }

    public function profileImage()
    {
        return $this->belongsTo(Image::class, 'profile_image_id');
    }

    public function getProfileImage()
    {
        if ($this->profile_image_id != null) {
            return asset(Image::find($this->profile_image_id)->path);
        }
        return null;
    }
}
