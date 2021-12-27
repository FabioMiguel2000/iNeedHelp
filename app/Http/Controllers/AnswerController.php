<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    protected function create_answer(Request $request, int $questionId)
    {
        $this->validate($request, [
            'content' => 'required|string|min:10',
        ]);

        $answerCreated = Answer::create([
            'user_id' => Auth::user()->id,
            'question_id' => $questionId,
            'content' => $request->input('content'),
        ]);
        return redirect()->back();

    }
}
