<?php

namespace App\Http\Controllers;
use App\Models\User;

class UserController extends Controller
{
    public function show($username){
        $user = User::firstWhere("username", $username);
        return view('pages.user-profile', ['user' => $user]);
    }

    public function edit($username){
        $user = User::firstWhere("username", $username);
        return view('pages.user-profile-edit', ['user' => $user]);
    }
}