<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\RoomCategory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRatingController extends Controller
{
    public function index()
    {
        return view('admin.rating.index', [
            'title' => 'Rating',
            'transactions' => Transaction::all(),
            'room_categories' => RoomCategory::all(),
            'users' => User::all()
        ]);
    }

    public function table()
    {
        $response = view('admin.rating.table', [
            'ratings' => Rating::filter(request(['user_id', 'transaction_id', 'room_category_id']))->paginate(10)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function delete($id)
    {
        Rating::destroy($id);
        return response()->json(['message' => 'Data deleted successfully!']);
    }
}
