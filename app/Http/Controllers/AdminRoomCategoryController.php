<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use App\Models\RoomCategoryImage;
use Illuminate\Http\Request;

class AdminRoomCategoryController extends Controller
{
    public function index()
    {
        return view('admin.room-category.index', [
            'title' => 'Room Category'
        ]);
    }

    public function table()
    {
        $response = view('admin.room-category.table', [
            'room_categories' => RoomCategory::filter(request(['search_by', 'search']))->paginate(5)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function add()
    {
        return view('admin.room-category.add', [
            'title' => 'Add Room Category'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['required']
        ], [
            'name.required' => 'Name is required.',
            'description.required' => 'Description is required.'
        ]);

        RoomCategory::create($validatedData);
        return response()->json(['message' => 'Data saved successfully!']);
    }

    public function edit($id)
    {
        return view('admin.room-category.edit', [
            'title' => 'Edit Room Category',
            'room_category' => RoomCategory::find($id)
        ]);
    }

    public function image($id)
    {
        return view('admin.room-category.image', [
            'title' => 'Image Room Category',
            'room_category' => RoomCategory::find($id)
        ]);
    }

    public function images(Request $request)
    {
        $response = view('admin.room-category.images', [
            'room_category_images' => RoomCategoryImage::where('room_category_id', $request->id)->get()
        ])->render();
        return response()->json($response);
    }
}
