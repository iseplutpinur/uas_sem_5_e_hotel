<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Facility;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'e-hotel',
            'room_categories' => RoomCategory::latest()->get(),
            'banners' => Banner::latest()->get(),
            'facilities' => Facility::all()
        ]);
    }
}
