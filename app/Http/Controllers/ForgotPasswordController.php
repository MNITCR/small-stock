<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // Show the forgot password form
    public function showForm()
    {
        return view('auth.forgetpassword');
    }

    // Handle the form submission
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if a user with the provided email exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // User with the provided email does not exist
            return back()->withErrors(['email' => 'This email does not exist.']);
        }

        // Send the password reset link
        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            // Redirect to a success page or display a success message
            return redirect()->route('password.reset.success');
        }

        return back()->withErrors(['email' => __($status)]);
    }


    // Show the reset password form
    public function showResetForm(Request $request, $token)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    // Handle the password reset form submission
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
