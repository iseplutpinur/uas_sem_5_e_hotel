<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminFacilityController extends Controller
{
    public function index()
    {
        return view('admin.facility.index', [
            'title' => 'Facility'
        ]);
    }
}
