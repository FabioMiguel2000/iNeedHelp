<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AboutUsController extends Controller
{
    public function index(){
        return view('pages.about');
    }
}