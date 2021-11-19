<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ], [
            'username.required' => 'Username is required.',
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
        return redirect()->route('admin.login');
    }
}
