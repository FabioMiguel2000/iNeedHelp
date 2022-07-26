<?php

namespace App\Policies;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool {
        return !$user->is_blocked;
    }

    public function accept(User $user, Question $question, Answer $answer): bool
    {
        return $answer->question->id === $question->id &&
            ($user->id === $question->user_id || $user->isAdministrator() || $user->isModerator());
    }

    public function update(User $user, Question $question): bool
    {
        return (!$user->is_blocked && $user->id === $question->user_id) || $user->isStaff();
    }

    // TODO maybe implement question locking?
    public function comment(User $user, Question $question): bool
    {
        return !$user->is_blocked;
    }

    public function answer(User $user, Question $question): bool
    {
        return !$user->is_blocked;
    }
}
