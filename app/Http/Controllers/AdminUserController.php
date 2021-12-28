<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        if (Gate::allows('3_1')) {
            return view('admin.user-admin.index', [
                'title' => 'User Admin'
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function table()
    {
        $response = view('admin.user-admin.table', [
            'users' => User::where('is_admin', true)->filter(request(['search_by', 'search']))->paginate(10)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function add()
    {
        if (Gate::allows('3_2')) {
            return view('admin.user-admin.add', [
                'title' => 'Add User Admin',
                'groups' => GroupUser::all()
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('3_2')) {
            $validatedData = $request->validate([
                'name' => ['required'],
                'username' => ['required', 'unique:users'],
                'email' => ['required', 'unique:users'],
                'password' => ['required'],
                'confirm_password' => ['required', 'same:password'],
                'photo' => ['image', 'file', 'max:2048'],
                'group_id' => ['required']
            ], [
                'name.required' => 'Name is required.',
                'username.required' => 'Username is required.',
                'username.unique' => 'Username is already used, please use a different username.',
                'email.required' => 'Email is required.',
                'email.unique' => 'Email is already used, please use a different email.',
                'password.required' => 'Password is required.',
                'confirm_password.required' => 'Confirm password is required.',
                'confirm_password.same' => 'Confirm password does not match, please check again.',
                'photo.image' => 'Photo must be an image.',
                'photo.file' => 'Photo must be an file.',
                'group_id.required' => 'Group is required.'
            ]);

            if ($request->file('photo')) {
                $fileName = 'e-hotel-' . time() . '.' . $request->file('photo')->extension();
                Storage::putFileAs('users-photo', $request->file('photo'), $fileName);
                $validatedData['photo'] = $fileName;
            }

            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['is_admin'] = 1;
            User::create($validatedData);
            return response()->json(['message' => 'Data saved successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function edit($id)
    {
        if (Gate::allows('3_3')) {
            return view('admin.user-admin.edit', [
                'title' => 'Edit User Admin',
                'groups' => GroupUser::all(),
                'user' => User::find($id)
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function update(Request $request)
    {
        if (Gate::allows('3_3')) {
            $validatedData = $request->validate([
                'name' => ['required'],
                'username' => ['required', Rule::unique('users')->ignore($request->id)],
                'email' => ['required', Rule::unique('users')->ignore($request->id)],
                'photo' => ['image', 'file', 'max:2048'],
                'group_id' => ['required']
            ], [
                'name.required' => 'Name is required.',
                'username.required' => 'Username is required.',
                'username.unique' => 'Username is already used, please use a different username.',
                'email.required' => 'Email is required.',
                'email.unique' => 'Email is already used, please use a different email.',
                'photo.image' => 'Photo must be an image.',
                'photo.file' => 'Photo must be an file.',
                'group_id.required' => 'Group is required.'
            ]);

            if ($request->file('photo')) {
                $fileName = 'e-hotel-' . time() . '.' . $request->file('photo')->extension();
                Storage::putFileAs('users-photo', $request->file('photo'), $fileName);
                Storage::delete('users-photo/' . $request->oldPhoto);
                $validatedData['photo'] = $fileName;
            }

            User::find($request->id)->update($validatedData);
            return response()->json(['message' => 'Data updated successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function update_password(Request $request)
    {
        if (Gate::allows('3_3')) {
            $validatedData = $request->validate([
                'password' => ['required'],
                'confirm_password' => ['required', 'same:password']
            ], [
                'password.required' => 'Password is required.',
                'confirm_password.required' => 'Confirm password is required.',
                'confirm_password.same' => 'Confirm password does not match, please check again.'
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);
            User::find($request->id)->update($validatedData);
            return response()->json(['message' => 'Data updated successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function delete($id)
    {
        if (Gate::allows('3_4')) {
            if (User::find($id)->photo) {
                Storage::delete('users-photo/' . User::find($id)->photo);
            }
            User::destroy($id);
            return response()->json(['message' => 'Data deleted successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }
}
