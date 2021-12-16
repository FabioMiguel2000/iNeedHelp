<?php

namespace App\Http\Controllers\Static;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class FaqController extends Controller
{
    public function index(){
        return view('pages.faq');
    }
}