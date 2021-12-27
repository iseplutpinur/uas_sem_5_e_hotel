<?php

namespace App\Http\Controllers;

use App\Models\Rating;
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

    public function rating(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required'],
            'transaction_id' => ['required'],
            'room_category_id' => ['required'],
            'star' => ['required']
        ]);

        Rating::create($validatedData);
        Transaction::find($request->transaction_id)->update(['is_rated' => true]);
    }
}
