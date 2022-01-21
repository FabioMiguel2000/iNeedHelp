<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
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

    public function create_comment(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|string|min:2',
        ]);

        $id = $request->input('identifier');

        $type = $request->input('type');
        switch ($type) {
            case 'question':
                $this->authorize('comment', Question::find($id));
                $column = 'question_id';
                break;
            case 'answer':
                $this->authorize('comment', Answer::find($id));
                $column = 'answer_id';
                break;
            default:
                return back()->withErrors(['Type has to be either answer or question']);
        }

        Comment::create([
            'user_id' => Auth::user()->id,
            $column => $id,
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->withSuccess('Your comment was successfully posted!');
    }

    public function delete(Request $request, Comment $comment)
    {
        $this->authorize('update', [$comment]);

        $comment->reviews()->delete();
        $comment->delete();
        return back();
    }

    protected function updateComment(Request $request, Comment $comment): RedirectResponse
    {
        $this->authorize('update', [$comment]);

        $this->validate($request, [
            'content' => 'required|string|min:2',
        ]);

        $comment->content = $request->get('content');

        $comment->save();

        return back();
    }
}
