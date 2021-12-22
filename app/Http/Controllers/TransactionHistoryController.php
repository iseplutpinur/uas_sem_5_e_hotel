<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        return view('transaction-history.index', [
            'title' => 'Transaction History',
            'transactions' => Transaction::where('user_id', Auth::id())->latest()->get()
        ]);
    }
}
