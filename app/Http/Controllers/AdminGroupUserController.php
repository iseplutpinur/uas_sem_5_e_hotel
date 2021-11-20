<?php

namespace App\Http\Controllers;

use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PHPUnit\TextUI\XmlConfiguration\Group;

class AdminGroupUserController extends Controller
{
    public function index()
    {
        return view('admin.group-user-admin.index', [
            'title' => 'Group User Admin'
        ]);
    }

    public function table()
    {
        $response = view('admin.group-user-admin.table', [
            'groups' => GroupUser::filter(request(['search_by', 'search']))->paginate(10)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function add()
    {
        return view('admin.group-user-admin.add', [
            'title' => 'Add Group User Admin'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:group_users']
        ], [
            'name.required' => 'Name is required.',
            'name.unique' => 'Name is already used, please use a different name.'
        ]);

        GroupUser::create($validatedData);
        return response()->json(['message' => 'Data saved successfully!']);
    }

    public function edit($id)
    {
        return view('admin.group-user-admin.edit', [
            'title' => 'Edit Group User Admin',
            'group' => GroupUser::find($id)
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', Rule::unique('group_users')->ignore($request->id)]
        ], [
            'name.required' => 'Name is required.',
            'name.unique' => 'Name is already used, please use a different name.'
        ]);

        GroupUser::find($request->id)->update($validatedData);
        return response()->json(['message' => 'Data updated successfully!']);
    }

    public function delete($id)
    {
        GroupUser::destroy($id);
        return response()->json(['message' => 'Data deleted successfully!']);
    }
}
