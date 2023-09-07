<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Import your custom User model

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login'); // Assuming your login view is in resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = [
            'name' => $request->input('name'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            dd('Login Success'); // Debugging message
            return redirect('/user')->with('success', 'Login Success');
        }

        dd('Login Failed'); // Debugging message
        return back()->with('error', 'Error Name or Password');
    }


    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
