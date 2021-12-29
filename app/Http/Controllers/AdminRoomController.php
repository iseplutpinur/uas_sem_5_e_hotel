<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminRoomController extends Controller
{
    public function index()
    {
        if (Gate::allows('7_1')) {
            return view('admin.room.index', [
                'title' => 'Room',
                'room_categories' => RoomCategory::all()
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
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
        if (Gate::allows('7_2')) {
            return view('admin.room.add', [
                'title' => 'Add Room',
                'room_categories' => RoomCategory::all()
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('7_2')) {
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
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function edit($id)
    {
        if (Gate::allows('7_3')) {
            return view('admin.room.edit', [
                'title' => 'Edit Room',
                'room_categories' => RoomCategory::all(),
                'room' => Room::find($id)
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function update(Request $request)
    {
        if (Gate::allows('7_3')) {
            $validatedData = $request->validate([
                'room_category_id' => ['required'],
                'number' => ['required'],
                'floor' => ['required'],
                'is_available' => ['required']
            ], [
                'room_category_id.required' => 'Room category is required.',
                'number.required' => 'Room number is required.',
                'floor.required' => 'Room floor is required.',
                'is_available.required' => 'Room status is required.'
            ]);

            Room::find($request->id)->update($validatedData);
            return response()->json(['message' => 'Data updated successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function delete($id)
    {
        if (Gate::allows('7_4')) {
            Room::destroy($id);
            return response()->json(['message' => 'Data deleted successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }
}
