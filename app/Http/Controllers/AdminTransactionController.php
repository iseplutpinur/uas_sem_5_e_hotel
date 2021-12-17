<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        $response = view('admin.transaction.table', [
            'transactions' => Transaction::latest()->get()
        ])->render();
        return response()->json($response);
    }

    public function detail($id)
    {
        return view('admin.transaction.detail', [
            'title' => 'Transaction Detail',
            'transaction' => Transaction::find($id)
        ]);
    }

    public function update_status(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required'],
            'status' => ['required']
        ]);
        Transaction::find($request->id)->update($validatedData);
    }
}
