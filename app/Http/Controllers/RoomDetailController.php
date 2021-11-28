<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomDetailController extends Controller
{
    public function index(RoomCategory $room_category)
    {
        return view('room.detail', [
            'title' => 'Room Detail',
            'room' => $room_category
        ]);
    }
}
