<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.user-admin.index', [
            'title' => 'User Admin'
        ]);
    }

    public function table()
    {
        $response = view('admin.user-admin.table', [
            'users' => User::where('is_admin', true)->filter(request(['search_by', 'search']))->paginate(10)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function add()
    {
        return view('admin.user-admin.add', [
            'title' => 'Add User Admin',
            'groups' => GroupUser::all()
        ]);
    }
}
