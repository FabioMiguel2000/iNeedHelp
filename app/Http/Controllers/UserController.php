<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\FollowQuestion;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function show($username)
    {
        $user = User::firstWhere("username", $username);
        $question_list = Question::orderBy('created_at', 'desc')->limit(5)->where('user_id', '=', $user->id)->get();
        $answer_list = Answer::orderBy('created_at', 'desc')->limit(5)->where('user_id', '=', $user->id)->get();

        $follow_list = FollowQuestion::where('user_id', '=', $user->id)->get();
        return view('pages.user-profile',
            [
                'user' => $user,
                'questions' => $question_list,
                'answers' => $answer_list,
                'following' => $follow_list,
                'title' => 'iNeedHelp | ' . $user->username
            ]);
    }

    public function edit($username)
    {
        $user = User::firstWhere("username", $username);
        return view('pages.user-profile-edit', ['user' => $user]);
    }

    public function update(Request $request, $username)
    {
        $this->validate($request, []);

        $imageFile = $request->file('profileImage');

        $user = User::firstWhere("username", $username);

        if ($imageFile != null) {
            $imagePath = "assets/profileImages/" . $username . '.' . $imageFile->extension();
            $imageFile->move(base_path('public/assets/profileImages'), $username . '.' . $imageFile->extension());
            $userProfileImage = Image::find($user->profile_image_id);
            if ($userProfileImage == null) {
                $userProfileImage = Image::create([
                    'path' => $imagePath,
                ]);
                $user->profile_image_id = $userProfileImage->id;
            } else {
                $userProfileImage->path = $imagePath;
                $userProfileImage->save();
            }
        }
        $user->full_name = $request->get('full-name');
        $user->status = $request->get('status');
        $user->bio = $request->get('bio');
        $user->location = $request->get('location');


        $user->save();

        return redirect('user/' . $username)->withSuccess('Your profile was successfully updated!');
    }

}
