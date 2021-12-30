<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminResetPasswordController extends Controller
{
    public function index()
    {
        if (Gate::allows('13_1')) {
            return view('admin.reset-password.index', [
                'title' => 'Reset Password Request'
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function table()
    {
        $response = view('admin.reset-password.table', [
            'forgot_passwords' => ForgotPassword::latest()->paginate(10)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function check($id)
    {
        if (Gate::allows('13_3')) {
            ForgotPassword::find($id)->update(['is_sent' => true]);
            return response()->json(['message' => 'Checked successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }
}
