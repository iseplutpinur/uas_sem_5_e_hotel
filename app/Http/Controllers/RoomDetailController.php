<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomDetailController extends Controller
{
    public function index(RoomCategory $room_category)
    {
        $facility_id = RoomCategory::where('id', $room_category->id)->value('facility_id');
        $facilities = Facility::whereIn('id', $facility_id)->get();
        return view('room.detail', [
            'title' => 'Room Detail',
            'room' => $room_category,
            'facilities' => $facilities
        ]);
    }
}
