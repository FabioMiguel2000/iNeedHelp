<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){
        $this->validate($request, [
            'usernameOrEmail' => 'required|string',
            'password' => 'required|string',
        ]);
        //Tries to login, checks the credentials with both email and username
        if(!(auth()->attempt([
            'email' => $request->usernameOrEmail,
            'password' => $request->password
        ])||auth()->attempt([
            'username' => $request->usernameOrEmail,
            'password' => $request->password
        ]))){
            return back()->with('status', 'Invalid Login Credentials');
        }
        $isAdmin = Administrator::where('user_id', Auth::user()->id)->exists();
        
        if(!$isAdmin){
            return redirect()->route('home');

        }
        return redirect()->route('adminPage', 'users');
        // if(){


        

            

        // }
        // else{
        //     return redirect()->route('home');
        // }

        // $loggedInUser = Auth::user();
        // if($loggedInUser->admin()){
        //     dd("Hello admin");
        // }
        

    }
    public function showRecoverAccount(){
        
    }

}
