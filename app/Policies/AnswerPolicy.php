<?php

namespace App\Policies;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Answer $answer) {
        return (!$user->is_blocked && $user->id === $answer->user_id) || $user->isStaff();
    }

    public function comment(User $user, Answer $answer): bool
    {
        return !$user->is_blocked;
    }
}
