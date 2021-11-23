<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (Gate::allows('1_1')) {
            return view('admin.dashboard.index', [
                'title' => 'Dashboard'
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }
}
