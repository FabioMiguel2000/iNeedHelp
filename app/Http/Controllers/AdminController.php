<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use App\Models\Moderator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function show($category)
    {
        switch ($category) {
            case 'users':
                $users = User::orderBy('id')->paginate(10);
                return view('pages.adminUsers', ['users' => $users]);

            case 'questions':
                $questions = Question::orderBy('id')->paginate(10);
                return view('pages.adminQuestions', ['questions' => $questions]);

            case 'tags':
                $tags = Tag::orderBy('id')->paginate(10);
                return view('pages.adminTags', ['tags' => $tags]);

            default:
                return redirect()->route('adminPage', 'users')->with('status', 'Unknown admin panel category');
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
        return redirect()->route('adminPage', 'users');
    }


    function deleteQuestion(Question $question)
    {
        $question->delete();
        return redirect()->route('adminPage', 'questions');
    }

    function deleteTag(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('adminPage', 'tags');
    }

    function changeModerator(User $user)
    {
        if($user->isModerator()){
            $mod = Moderator::firstWhere("user_id", $user->id);
            $mod->delete();
        }
        else {
            $new_mod = new Moderator;
            $new_mod->user_id = $user->id;
            $new_mod->save();
        }
        return redirect()->route('adminPage', 'users');
    }
}
