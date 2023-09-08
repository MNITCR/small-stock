<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    protected $maxAttempts = 3; // Maximum login attempts allowed.
    protected $decayMinutes = 5; // Lockout duration in minutes.

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Apply rate limiting to login attempts.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Successful login, reset login attempts.
            $this->clearLoginAttempts($request);
            return redirect()->route('dashboard');
        }

        // Incorrect login, increment login attempts.
        $this->incrementLoginAttempts($request);

        return redirect()->route('login')
            ->withErrors(['email' => 'អ៊ី​ម៉ែ​ល​ឬ​ពាក្យសម្ងាត់​មិន​ត្រឹមត្រូវ'])
            ->withInput();
    }

    // Override the rate limiter methods.
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return RateLimiter::tooManyAttempts($this->throttleKey($request), $this->maxAttempts);
    }

    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request), $this->decayMinutes * 60);
    }

    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    protected function throttleKey(Request $request)
    {
        return mb_strtolower($request->input('email')) . '|' . $request->ip();
    }
}
