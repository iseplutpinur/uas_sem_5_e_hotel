<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomCategoryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'title' => 'Add Room Category',
            'facilities' => Facility::where('is_addon', false)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'cover' => ['image', 'file', 'max:2048'],
        ], [
            'name.required' => 'Name is required.',
            'description.required' => 'Description is required.',
            'cover.image' => 'Cover must be an image.',
            'cover.file' => 'Cover must be an file.'
        ]);

        if ($request->file('cover')) {
            $fileName = 'e-hotel-' . time() . '.' . $request->file('cover')->extension();
            Storage::putFileAs('room_categories-photo', $request->file('cover'), $fileName);
            $validatedData['cover'] = $fileName;
        }

        $validatedData['facility_id'] = $request->facility;

        RoomCategory::create($validatedData);
        return response()->json(['message' => 'Data saved successfully!']);
    }

    public function edit($id)
    {
        return view('admin.room-category.edit', [
            'title' => 'Edit Room Category',
            'room_category' => RoomCategory::find($id),
            'facilities' => Facility::where('is_addon', false)->get()
        ]);
    }

    public function delete($id)
    {
        $room_category_images = RoomCategoryImage::where('room_category_id', $id)->get();
        foreach ($room_category_images as $room_category_image) {
            Storage::delete('room_category_images-photo/' . $room_category_image->photo);
        }
        if (RoomCategory::find($id)->cover) {
            Storage::delete('room_categories-photo/' . RoomCategory::find($id)->cover);
        }
        RoomCategoryImage::where('room_category_id', $id)->delete();
        RoomCategory::destroy($id);
        return response()->json(['message' => 'Data deleted successfully!']);
    }

    public function image($id)
    {
        return view('admin.room-category.image', [
            'title' => 'Image Room Category',
            'room_category' => RoomCategory::find($id)
        ]);
    }

    public function image_store(Request $request)
    {
        $validatedData = $request->validate([
            'room_category_id' => ['required'],
            'photo' => ['image', 'file', 'max:2048']
        ]);

        if ($request->file('photo')) {
            $fileName = 'e-hotel-' . time() . '.' . $request->file('photo')->extension();
            Storage::putFileAs('room_category_images-photo', $request->file('photo'), $fileName);
            $validatedData['photo'] = $fileName;
        }

        RoomCategoryImage::create($validatedData);
    }

    public function images(Request $request)
    {
        $response = view('admin.room-category.images', [
            'room_category_images' => RoomCategoryImage::where('room_category_id', $request->id)->get()
        ])->render();
        return response()->json($response);
    }

    public function image_delete($id)
    {
        if (RoomCategoryImage::find($id)->photo) {
            Storage::delete('room_category_images-photo/' . RoomCategoryImage::find($id)->photo);
        }
        RoomCategoryImage::destroy($id);
        return response()->json(['message' => 'Data deleted successfully!']);
    }

    public function detail($id)
    {
        $facility_id = RoomCategory::where('id', $id)->value('facility_id');
        $facilities = Facility::whereIn('id', $facility_id)->get();
        return view('admin.room-category.detail', [
            'title' => 'Room Category Detail',
            'room_category' => RoomCategory::find($id),
            'facilities' => $facilities
        ]);
    }
}
