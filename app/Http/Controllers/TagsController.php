<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    public function index()
    {
        //$question = Question::find($id);
        $tags = Tags::orderBy('id', 'asc')->limit(25)->get();    
        return view('pages.tags', ['tags' => $tags]);
    }
}