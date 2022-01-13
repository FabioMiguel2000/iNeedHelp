<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ModeratorController extends Controller 
{
    function changeBlock(User $user)
    {
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        return back();
    }

    function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('search-result', 'users');
    }


    function deleteQuestion(Question $question)
    {
        $question->delete();
        return redirect()->route('search-result', 'questions');
    }

    function deleteTag(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('search-result', 'tags');
    }
}