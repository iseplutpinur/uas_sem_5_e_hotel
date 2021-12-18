<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function is_rent(Request $request)
    {
        $response = User::find($request->id)->is_rent;
        return response()->json($response);
    }
}
