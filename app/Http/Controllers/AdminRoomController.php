<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function index()
    {
        return view('admin.room.index', [
            'title' => 'Room',
            'room_categories' => RoomCategory::all()
        ]);
    }

    public function table()
    {
        $response = view('admin.room.table', [
            'rooms' => Room::filter(request(['search_by', 'search', 'room_category']))->paginate(10)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function add()
    {
        return view('admin.room.add', [
            'title' => 'Add Room',
            'room_categories' => RoomCategory::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_category_id' => ['required'],
            'number' => ['required'],
            'floor' => ['required']
        ], [
            'room_category_id.required' => 'Room category is required.',
            'number.required' => 'Room number is required.',
            'floor.required' => 'Room floor is required.'
        ]);

        Room::create($validatedData);
        return response()->json(['message' => 'Data saved successfully!']);
    }

    public function edit($id)
    {
        return view('admin.room.edit', [
            'title' => 'Edit Room',
            'room_categories' => RoomCategory::all(),
            'room' => Room::find($id)
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'room_category_id' => ['required'],
            'number' => ['required'],
            'floor' => ['required']
        ], [
            'room_category_id.required' => 'Room category is required.',
            'number.required' => 'Room number is required.',
            'floor.required' => 'Room floor is required.'
        ]);

        Room::find($request->id)->update($validatedData);
        return response()->json(['message' => 'Data updated successfully!']);
    }

    public function delete($id)
    {
        Room::destroy($id);
        return response()->json(['message' => 'Data deleted successfully!']);
    }
}
