<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        return view('pages.user-profile', ['user' => $user]);
    }
}