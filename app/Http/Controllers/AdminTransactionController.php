<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index()
    {
        return view('admin.transaction.index', [
            'title' => 'Transaction'
        ]);
    }

    public function table()
    {
        $response = view('admin.transaction.table', [])->render();
        return response()->json($response);
    }
}
