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

    public function userDelete($username){
        $user = User::firstWhere("username", $username);

        return view('pages.deleteAccount', ['user' => $user ]);
    }


    public function deleteAccount(Request $request, $username){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        //Checks the credentials
        if(!(auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))){
            return back()->with('error', 'Invalid Credentials');
            //return back()->withErrors(['Invalid Credentials']);
        }

        //dd($request);
        $user = User::firstWhere("username", $username);
   
        // $user->username = "Deleted User";
        // $user->status = "inactive";
        // $user->bio = "This user has deleted their Account. Posts will still show up as ANON";
        // $user->full_name = null;
        // $user->location = null;
        // $user->save();

        //$user->softDeletes();
        $user->delete();

        return redirect()->route('home')->withSuccess('Your Account has been deleted!');
   
    }

}
