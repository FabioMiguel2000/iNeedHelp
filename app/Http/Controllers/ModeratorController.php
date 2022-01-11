<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class ModeratorController extends Controller 
{
    function show($category)
    {
        switch ($category) {
            case 'users':
                $users = User::orderBy('id')->paginate(10);
                return view('pages.search-result', ['users' => $users]);

            case 'questions':
                $questions = Question::orderBy('id')->paginate(10);
                return view('pages.search-result', ['questions' => $questions]);

            case 'tags':
                $tags = Tag::orderBy('id')->paginate(10);
                return view('pages.search-result', ['tags' => $tags]);

            default:
                return view('home');
        }
    }

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