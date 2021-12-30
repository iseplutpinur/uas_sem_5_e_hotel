<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
            'confirm_password.required' => 'Confirm password is required.'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['token'] = Str::random(64);

        User::create($validatedData);
        return response()->json(['message' => 'Register success!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
