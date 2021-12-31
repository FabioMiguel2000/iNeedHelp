<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function show(){
        $users = User::orderBy('id')->paginate(10);
        return view('pages.admin', ['users'=> $users]);
    }
    
    function changeBlock(Request $request, User $user){

        $user->is_blocked = !$user->is_blocked;
        $user->save();

        // $users = User::paginate(10);
        // return view('pages.admin', ['users'=> $users]);
        return back();
    }

    function deleteUser(Request $request, User $user){
        $user->delete();
        return back();
    }

}
