<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveTransactionController extends Controller
{
    public function index()
    {
        return view('active-transaction.index', [
            'title' => 'Active Transaction',
            'active_transaction' => Transaction::where('user_id', Auth::id())->whereIn('status', ['active', 'waiting', 'payment'])->first(),
            'payment_methods' => PaymentMethod::all()
        ]);
    }

    public function update_payment(Request $request)
    {
        $validatedData = $request->validate([
            'payment_method_id' => ['required']
        ], [
            'payment_method_id.required' => 'Payment method is required.'
        ]);

        Transaction::find($request->id)->update($validatedData);
    }
}
