<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUsersController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'title' => 'User'
        ]);
    }

    public function table()
    {
        $response = view('admin.user.table', [
            'users' => User::where('is_admin', false)->filter(request(['search_by', 'search']))->paginate(10)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function delete($id)
    {
        if (User::find($id)->photo) {
            Storage::delete('users-photo/' . User::find($id)->photo);
        }
        User::destroy($id);
        return response()->json(['message' => 'Data deleted successfully!']);
    }
}
