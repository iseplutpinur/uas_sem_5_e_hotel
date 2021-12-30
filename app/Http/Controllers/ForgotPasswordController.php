<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('forgot-password.index', [
            'title' => 'Forgot Password'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required']
        ], [
            'email.required' => 'Email is required.'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $data = [
                'user_id' => $user->id
            ];
            ForgotPassword::create($data);
            return response()->json(['status' => 'success', 200]);
        } else {
            return response()->json(['status' => 'fail', 200]);
        }
    }

    public function reset()
    {
        return view('forgot-password.reset', [
            'title' => 'Reset Password'
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required'],
            'token' => ['required'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ], [
            'password.required' => 'Password is required.',
            'confirm_password.required' => 'Confirm password is required.'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::find($request->id)->update(['password' => $validatedData['password']]);
        return response()->json(['message' => 'Password changed successfully!']);
    }
}
