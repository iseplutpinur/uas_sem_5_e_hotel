<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ], [
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.'
        ]);

        $remember_me = $request->has('remember_me');
        if (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'fail']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
