<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    public function index()
    {
        return view('pages.tags', ['tags' => Tag::orderBy('id', 'asc')->paginate(25)]);
    }

    public function show($id)
    {
        return view('pages.taginfo', ['tag' => Tag::find($id)]);
    }
}
