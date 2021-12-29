<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function review(Request $request, Comment $comment, string $type)
    {
        if ($comment->reviewedBy($request->user())) {
            // client wants to change review type
            $this->unreview($request, $comment);
        }

        $comment->reviews()->create([
            'user_id' => $request->user()->id,
            'type' => $type,
        ]);

        return back();
    }

    public function unreview(Request $request, Comment $comment)
    {
        $request->user()->commentReviews()->where('comment_id', $comment->id)->delete();
        return back();
    }

    public function create_comment(Request $request){
        $this->validate($request, [
            'content' => 'required|string|min:2',
        ]);
        if($request->input('type') == 'question'){
            Comment::create([
                'user_id' => Auth::user()->id,
                'question_id' => $request->input('identifier'),
                'content' => $request->input('content'),
            ]);
        }
        else if($request->input('type') == 'answer'){
            Comment::create([
                'user_id' => Auth::user()->id,
                'answer_id' => $request->input('identifier'),
                'content' => $request->input('content'),
            ]);
        }
        else{
            return back()->withErrors(['Type has to be either answer or question']);
        }
        return redirect()->back()->withSuccess('Your comment was successfully posted!');
    }
}
