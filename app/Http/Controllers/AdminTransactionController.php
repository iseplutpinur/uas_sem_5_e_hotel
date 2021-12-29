<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminTransactionController extends Controller
{
    public function index()
    {
        if (Gate::allows('10_1')) {
            return view('admin.transaction.index', [
                'title' => 'Transaction'
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
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
        if (Gate::allows('10_3')) {
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
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function update_room(Request $request)
    {
        if (Gate::allows('10_3')) {
            $validatedData = $request->validate([
                'room_id' => ['required']
            ], [
                'room_id.required' => 'Room is required.'
            ]);

            Room::find($request->room_id)->update(['is_available' => 1]);
            Transaction::find($request->id)->update($validatedData);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function change_room(Request $request)
    {
        if (Gate::allows('10_3')) {
            $validatedData = $request->validate([
                'room_id' => ['required']
            ], [
                'room_id.required' => 'Room is required.'
            ]);

            Room::find($request->oldRoom)->update(['is_available' => 0]);
            Room::find($request->room_id)->update(['is_available' => 1]);
            Transaction::find($request->id)->update($validatedData);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function end_room($id, Request $request)
    {
        if (Gate::allows('10_4')) {
            Room::find($id)->update(['is_available' => 0]);
            Transaction::find($request->transaction_id)->update(['room_id' => null]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }
}
