<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

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
}
