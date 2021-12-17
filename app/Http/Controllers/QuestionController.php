<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{
    public function show($id)
    {
        $question = Question::find($id);
        return view('pages.question', ['question' => $question]);
    }
}
