<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function show(Request $request, $category){
        switch ($category) {
            case 'users':
                $users = User::orderBy('id')->paginate(10);
                return view('pages.adminUsers', ['users'=> $users]);

            case 'questions':
                $questions = Question::orderBy('id')->paginate(10);
                return view('pages.adminQuestions', ['questions'=> $questions]);

            case 'tags':
                $tags = Tag::orderBy('id')->paginate(10);
                return view('pages.adminTags', ['tags'=> $tags]);

            default:
                return redirect()->with('status', 'Access denied!');

        }

    }
    
    function changeBlock(Request $request, User $user){

        $user->is_blocked = !$user->is_blocked;
        $user->save();

        return back();


    }

    function deleteUser(Request $request, User $user){
        $user->delete();
        $users = User::orderBy('id')->paginate(10);

        return redirect()->route('adminPage', 'users');

    }


    function deleteQuestion(Request $request, Question $question){
        $question->delete();
        $questions = Question::orderBy('id')->paginate(10);
        return redirect()->route('adminPage', 'questions');
    }

    function deleteTag(Request $request, Tag $tag){
        dd("Working on...delete tag!");
    }

}
