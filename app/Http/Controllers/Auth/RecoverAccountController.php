<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class RecoverAccountController extends Controller
{
    public function show()
    {
        return view('auth.recover');
    }

    public function sendRecoverEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:320',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return redirect()->back()->withErrors(['Invalid email address, user does not exist!']);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);

        // //Create Password Reset Token
        // DB::table('password_resets')->insert([
        //     'email' => $request->email,
        //     'token' => Str::random(60),
        //     'created_at' => Carbon::now()
        // ]);

        // //Get the token just created above
        // $tokenData = DB::table('password_resets')->where('email', $request->email)->first();

        // dd($tokenData);
        // if ($this->sendResetEmail($request->email, $tokenData->token)) {
        //     return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
        // } else {
        //     return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        // }
    }

    public function changePassword(Request $request){
        dd("Changed password!");
    }
}
