<?php

namespace App\Http\Controllers;

use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use PHPUnit\TextUI\XmlConfiguration\Group;

class AdminGroupUserController extends Controller
{
    public function index()
    {
        if (Gate::allows('2_1')) {
            return view('admin.group-user-admin.index', [
                'title' => 'Group User Admin'
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
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
        if (Gate::allows('2_2')) {
            return view('admin.group-user-admin.add', [
                'title' => 'Add Group User Admin'
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('2_2')) {
            $validatedData = $request->validate([
                'name' => ['required', 'unique:group_users']
            ], [
                'name.required' => 'Name is required.',
                'name.unique' => 'Name is already used, please use a different name.'
            ]);

            GroupUser::create($validatedData);
            return response()->json(['message' => 'Data saved successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function edit($id)
    {
        if (Gate::allows('2_3')) {
            return view('admin.group-user-admin.edit', [
                'title' => 'Edit Group User Admin',
                'group' => GroupUser::find($id)
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function update(Request $request)
    {
        if (Gate::allows('2_3')) {
            $validatedData = $request->validate([
                'name' => ['required', Rule::unique('group_users')->ignore($request->id)]
            ], [
                'name.required' => 'Name is required.',
                'name.unique' => 'Name is already used, please use a different name.'
            ]);

            GroupUser::find($request->id)->update($validatedData);
            return response()->json(['message' => 'Data updated successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function delete($id)
    {
        if (Gate::allows('2_4')) {
            GroupUser::destroy($id);
            return response()->json(['message' => 'Data deleted successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }
}
