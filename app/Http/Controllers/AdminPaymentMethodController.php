<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class AdminPaymentMethodController extends Controller
{
    public function index()
    {
        return view('admin.payment-method.index', [
            'title' => 'Payment Method'
        ]);
    }

    public function table()
    {
        $response = view('admin.payment-method.table', [
            'payment_methods' => PaymentMethod::filter(request(['search_by', 'search']))->paginate(5)->withQueryString()
        ])->render();
        return response()->json($response);
    }
}
