<?php

namespace App\Http\Controllers;

use App\Models\Facility;
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

    public function detail(Transaction $transaction_history)
    {
        $facility_id = $transaction_history->value('facility_id');
        if ($facility_id) {
            $facilities = Facility::whereIn('id', $facility_id)->get();
        } else {
            $facilities = [];
        }
        return view('transaction-history.detail', [
            'title' => 'Transaction History',
            'transaction' => $transaction_history,
            'facilities' => $facilities
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
