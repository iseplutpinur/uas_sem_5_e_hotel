<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GroupUser;
use Illuminate\Http\Request;

class AdminAuthorizationSettingController extends Controller
{
    public function index()
    {
        return view('admin.authorization-setting.index', [
            'title' => 'Authorization Setting',
            'groups' => GroupUser::all()
        ]);
    }

    public function table(Request $request)
    {
        $response = view('admin.authorization-setting.table', [
            'group' => GroupUser::find($request->group)
        ])->render();
        return response()->json($response);
    }

    public function update(Request $request)
    {
        $validatedData = [
            '1_1' => $request->has('dashboard_1'),
            '1_2' => $request->has('dashboard_2'),
            '1_3' => $request->has('dashboard_3'),
            '1_4' => $request->has('dashboard_4'),
            '2_1' => $request->has('groupuseradmin_1'),
            '2_2' => $request->has('groupuseradmin_2'),
            '2_3' => $request->has('groupuseradmin_3'),
            '2_4' => $request->has('groupuseradmin_4')
        ];
        GroupUser::find($request->group)->update($validatedData);
        return response()->json(['message' => 'Data updated successfully!']);
    }
}
