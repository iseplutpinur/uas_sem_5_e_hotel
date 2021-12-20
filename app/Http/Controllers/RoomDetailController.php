<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\RoomCategory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class RoomDetailController extends Controller
{
    public function index(RoomCategory $room_category)
    {
        $facility_id = RoomCategory::where('id', $room_category->id)->value('facility_id');
        if ($facility_id) {
            $facilities = Facility::whereIn('id', $facility_id)->get();
        } else {
            $facilities = [];
        }
        return view('room.detail', [
            'title' => 'Room Detail',
            'room' => $room_category,
            'facilities' => $facilities
        ]);
    }

    public function book(Request $request)
    {
        $maxGuest = RoomCategory::find($request->room_category_id)->value('guest');

        $validatedData = $request->validate([
            'user_id' => ['required'],
            'room_category_id' => ['required'],
            'guest' => ['required', 'numeric', 'max:' . $maxGuest],
            'check_in' => ['required'],
            'check_out' => ['required']
        ], [
            'user_id.required' => 'User is required.',
            'room_category_id.required' => 'Room category is required.',
            'guest.required' => 'Guest count is required.',
            'guest.max' => 'Max guest is :max person for this room category.',
            'check_in.required' => 'Check in date is required.',
            'check_out.required' => 'Check out date is required.'
        ]);

        $validatedData['number'] = 'INV-' . time();

        User::find($request->user_id)->update(['is_rent' => true]);
        Transaction::create($validatedData);
        return response()->json(['message' => 'Book success, please wait admin confirmation!']);
    }
}
