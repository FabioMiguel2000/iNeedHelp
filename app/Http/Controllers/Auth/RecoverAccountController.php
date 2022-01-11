<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
            ? back()->withSuccess('Account recovery email sent to your email!')
            : back()->withErrors(['Something went wrong! Please try again later!']);
    }

    public function showPasswordResetPage(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:5'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->withSuccess('Your password was successfully changed!')
            : back()->withInput($request->only('email'))
                ->withErrors(['Invalid email address, user does not exist!']);
    }
}
