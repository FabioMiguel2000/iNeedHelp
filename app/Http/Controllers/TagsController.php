<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id', 'asc')->paginate(25);
        return view('pages.tags', ['tags' => $tags]);
    }

    public function show($id)
    {
        $tag = Tag::find($id);
        // dd($tags->question_tags());
        return view('pages.taginfo', ['tag' => $tag]);
    }

    protected function create_tag(Request $request, string $tagName)
    {

        $existsTag = Tag::where('name', $tagName)->exists();

        if($existsTag){
            //Error
            // return redirect()->back()->withErrors(['You have already posted an answer on this question!']);
        }

        $this->validate($request, [
            'name' => 'required|string|min:1',
        ]);

        $createdTag = Tag::create([
                'name'=>$tagName,
        ]);
        // return redirect()->back()->withSuccess('Your answer was successfully posted!');

    }

}
