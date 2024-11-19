<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->to('/')->with('error', 'The provided credentials are incorrect.');
        }

        return redirect()->route('dashboard')->with('success', 'Logged in successfully.')->setStatusCode(200);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
