<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Request;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = '/';

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    // public function getUser(){
    //     return $request->user();
    // }

    // public function home() {
    //     return redirect('login');
    // }

    // public function temp() {
    //     return "Hello";
    // }

    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){
        $this->validate($request, [
            'usernameOrEmail' => 'required|string',
            'password' => 'required|string',
        ]);
        if(!(auth()->attempt([
            'email' => $request->usernameOrEmail,
            'password' => $request->password
        ])||auth()->attempt([
            'username' => $request->usernameOrEmail,
            'password' => $request->password
        ]))){
            return back()->with('status', 'Invalid Login Credentials');
        }
        return redirect()->route('home');

    }

}
