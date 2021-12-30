<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function show($username)
    {
        $user = User::firstWhere("username", $username);
        $question_list = Question::orderBy('created_at', 'desc')->limit(5)->where('user_id', '=', $user->id)->get();
        return view('pages.user-profile', ['user' => $user, 'questions' => $question_list]);
    }

    public function edit($username)
    {
        $user = User::firstWhere("username", $username);
        return view('pages.user-profile-edit', ['user' => $user]);
    }

    protected function update(Request $request, $username)
    {
        $this->validate($request, []);

        $user = User::firstWhere("username", $username);

        $user->full_name = $request->get('full-name');
        $user->status = $request->get('status');
        $user->bio = $request->get('bio');
        $user->location = $request->get('location');

        $user->save();

        return redirect('user/' . $username);
    }
}
