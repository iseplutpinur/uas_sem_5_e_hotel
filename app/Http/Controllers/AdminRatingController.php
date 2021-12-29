<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\RoomCategory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminRatingController extends Controller
{
    public function index()
    {
        if (Gate::allows('11_1')) {
            return view('admin.rating.index', [
                'title' => 'Rating',
                'transactions' => Transaction::all(),
                'room_categories' => RoomCategory::all(),
                'users' => User::all()
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
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
        if (Gate::allows('10_4')) {
            Rating::destroy($id);
            return response()->json(['message' => 'Data deleted successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }
}
