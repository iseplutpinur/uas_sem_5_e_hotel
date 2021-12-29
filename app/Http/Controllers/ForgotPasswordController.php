<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    }
}
