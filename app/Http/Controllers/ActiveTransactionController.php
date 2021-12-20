<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActiveTransactionController extends Controller
{
    public function index()
    {
        return view('active-transaction.index', [
            'title' => 'Active Transaction',
            'active_transaction' => Transaction::where('user_id', Auth::id())->whereIn('status', ['active', 'waiting', 'payment', 'confirmation'])->first(),
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

    public function update_pay(Request $request)
    {
        $validatedData = $request->validate([
            'payment_slip' => ['required', 'image', 'file', 'max:2048']
        ], [
            'payment_slip.required' => 'Payment slip is required.',
            'payment_slip.image' => 'Payment slip must be an image.',
            'payment_slip.file' => 'Payment slip must be an file.'
        ]);

        if ($request->file('payment_slip')) {
            $fileName = 'e-hotel-' . time() . '.' . $request->file('payment_slip')->extension();
            Storage::putFileAs('transactions-photo', $request->file('payment_slip'), $fileName);
            Storage::delete('transactions-photo/' . $request->oldSlip);
            $validatedData['payment_slip'] = $fileName;
        }
        $validatedData['status'] = 'confirmation';

        Transaction::find($request->id)->update($validatedData);
    }
}
