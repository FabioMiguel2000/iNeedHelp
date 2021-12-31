<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;

class SearchController extends Controller
{

    public function scopeSearch($q)
    {
        return empty(request()->search) ? $q : $q->where('title', 'like', '%'.request()->search.'%');
    }
    
    public function show(Request $request){

        $search = $request->input('search');

        $questions = Question::query()
        ->where('title', 'ilike', '%' . $search . '%')->get();

        $users = User::query()
        ->where('username', 'ilike', '%' . $search . '%')->get();

        return view('pages.search-result')
        ->with(compact('questions'))
        ->with(compact('users'));
    }
}
