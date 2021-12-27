<?php

namespace App\Http\Controllers;
use App\Models\Question;


class HomePage
{
    public function show(){
        $new_questions = Question::orderBy('created_at', 'desc')->limit(10)->get();
        $top_questions = Question::withCount('likes')->orderBy('likes_count', 'desc')->limit(10)->get();
        return view('pages.home', ['new_questions' => $new_questions, 'top_questions' => $top_questions]);
    }

    


}
