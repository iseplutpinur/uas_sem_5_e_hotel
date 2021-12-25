<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'title' => 'Profile',
            'user' => User::find(Auth::id())
        ]);
    }

    public function update_photo(Request $request)
    {
        $validatedData = $request->validate([
            'photo' => ['image', 'file', 'max:2048']
        ], [
            'photo.image' => 'Photo must be an image.',
            'photo.file' => 'Photo must be an file.'
        ]);

        if ($request->file('photo')) {
            $fileName = 'e-hotel-' . time() . '.' . $request->file('photo')->extension();
            Storage::putFileAs('users-photo', $request->file('photo'), $fileName);
            Storage::delete('users-photo/' . $request->oldPhoto);
            $validatedData['photo'] = $fileName;
        }

        User::find($request->id)->update($validatedData);
        return response()->json(['message' => 'Profile picture changed successfully!']);
    }
}
