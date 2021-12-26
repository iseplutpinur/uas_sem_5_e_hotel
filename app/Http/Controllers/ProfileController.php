<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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

    public function update_profile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->ignore($request->id)]
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'Email is already used, please use a different email.'
        ]);

        User::find($request->id)->update($validatedData);
        return response()->json(['message' => 'Profile updated successfully!']);
    }

    public function update_password(Request $request)
    {
        $user = User::find($request->id);
        $validatedData = $request->validate([
            'old_password' => ['required'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ], [
            'old_password.required' => 'Old password is required.',
            'password.required' => 'Password is required.',
            'confirm_password.required' => 'Confirm password is required.',
            'confirm_password.same' => 'Confirm password does not match, please check again.'
        ]);

        if (Hash::check($request->old_password, $user->password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::find($request->id)->update($validatedData);
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }
}
