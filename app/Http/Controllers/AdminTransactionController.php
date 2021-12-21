<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
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
        $room_category_id = Transaction::find($id)->room_category_id;

        return view('admin.transaction.detail', [
            'title' => 'Transaction Detail',
            'transaction' => Transaction::find($id),
            'rooms' => Room::where('room_category_id', $room_category_id)->where('is_available', false)->get()
        ]);
    }

    public function update_status(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required'],
            'status' => ['required']
        ]);

        if (in_array($request->status, ['active', 'waiting', 'payment', 'confirmation'])) {
            User::find($request->user_id)->update(['is_rent' => true]);
        } elseif (in_array($request->status, ['inactive', 'canceled'])) {
            User::find($request->user_id)->update(['is_rent' => false]);
        }

        Transaction::find($request->id)->update($validatedData);
    }

    public function update_room(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => ['required']
        ], [
            'room_id.required' => 'Room is required.'
        ]);

        Room::find($request->room_id)->update(['is_available' => 1]);
        Transaction::find($request->id)->update($validatedData);
    }

    public function change_room(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => ['required']
        ], [
            'room_id.required' => 'Room is required.'
        ]);

        Room::find($request->oldRoom)->update(['is_available' => 0]);
        Room::find($request->room_id)->update(['is_available' => 1]);
        Transaction::find($request->id)->update($validatedData);
    }

    public function end_room($id, Request $request)
    {
        Room::find($id)->update(['is_available' => 0]);
        Transaction::find($request->transaction_id)->update(['room_id' => null]);
    }
}
