<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function show($id)
    {
        $question = Question::find($id);
        return view('pages.question', ['question' => $question]);
    }

    public function show_create()
    {
        return view('pages.new-question');
    }

    protected function create_question(array $data): Question
    {
        return Question::create([
            'user_id' => 1/*Auth::user()->id*/,
            'title' => $data['question-title'],
            'content' => $data['content'],
        ]);
    }
    
    
}
