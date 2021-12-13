<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBannerController extends Controller
{
    public function index()
    {
        return view('admin.banner.index', [
            'title' => 'Banner'
        ]);
    }

    public function table()
    {
        $response = view('admin.banner.table', [
            'banners' => Banner::filter(request(['search_by', 'search']))->paginate(5)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function add()
    {
        return view('admin.banner.add', [
            'title' => 'Add Banner'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'photo' => ['required', 'image', 'file', 'max:2048']
        ], [
            'name.required' => 'Name is required.',
            'photo.required' => 'Photo is required.',
            'photo.image' => 'Photo must be an image.',
            'photo.file' => 'Photo must be an file.'
        ]);

        if ($request->file('photo')) {
            $fileName = 'e-hotel-' . time() . '.' . $request->file('photo')->extension();
            Storage::putFileAs('banners-photo', $request->file('photo'), $fileName);
            $validatedData['photo'] = $fileName;
        }

        Banner::create($validatedData);
        return response()->json(['message' => 'Data saved successfully!']);
    }

    public function edit($id)
    {
        return view('admin.banner.edit', [
            'title' => 'Edit Banner',
            'banner' => Banner::find($id)
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'photo' => ['image', 'file', 'max:2048'],
        ], [
            'name.required' => 'Name is required.',
            'photo.image' => 'Photo must be an image.',
            'photo.file' => 'Photo must be an file.'
        ]);

        if ($request->file('photo')) {
            $fileName = 'e-hotel-' . time() . '.' . $request->file('photo')->extension();
            Storage::putFileAs('banners-photo', $request->file('photo'), $fileName);
            Storage::delete('banners-photo/' . $request->oldPhoto);
            $validatedData['photo'] = $fileName;
        }

        Banner::find($request->id)->update($validatedData);
        return response()->json(['message' => 'Data updated successfully!']);
    }

    public function delete($id)
    {
        if (Banner::find($id)->photo) {
            Storage::delete('banners-photo/' . Banner::find($id)->photo);
        }
        Banner::destroy($id);
        return response()->json(['message' => 'Data deleted successfully!']);
    }
}
