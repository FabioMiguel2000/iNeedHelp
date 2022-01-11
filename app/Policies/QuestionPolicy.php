<?php

namespace App\Policies;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function accept(User $user, Question $question, Answer $answer)
    {
        return ($user->id === $question->user_id && $answer->question->id === $question->id)  || ($user->isAdministrator() || $user->isModerator());
    }

    public function update(User $user, Question $question)
    {
        return (!$user->is_blocked && $user->id === $question->user_id) || ($user->isAdministrator() || $user->isModerator());
    }
}
