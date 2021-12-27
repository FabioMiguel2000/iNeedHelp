<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id', 'asc')->limit(25)->get();    
        return view('pages.tags', ['tags' => $tags]);
    }

    public function show($id)
    {
        $tags = Tag::find($id);
        // dd($tags->question_tags());
        return view('pages.taginfo', ['tags' => $tags]);
    }
}