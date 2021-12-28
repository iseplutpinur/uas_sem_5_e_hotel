<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminAuthorizationSettingController extends Controller
{
    public function index()
    {
        if (Gate::allows('4_1')) {
            return view('admin.authorization-setting.index', [
                'title' => 'Authorization Setting',
                'groups' => GroupUser::all()
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
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
            '2_4' => $request->has('groupuseradmin_4'),
            '3_1' => $request->has('useradmin_1'),
            '3_2' => $request->has('useradmin_2'),
            '3_3' => $request->has('useradmin_3'),
            '3_4' => $request->has('useradmin_4'),
            '4_1' => $request->has('authorizationsetting_1'),
            '4_2' => $request->has('authorizationsetting_2'),
            '4_3' => $request->has('authorizationsetting_3'),
            '4_4' => $request->has('authorizationsetting_4'),
            '5_1' => $request->has('banner_1'),
            '5_2' => $request->has('banner_2'),
            '5_3' => $request->has('banner_3'),
            '5_4' => $request->has('banner_4'),
            '6_1' => $request->has('roomcategory_1'),
            '6_2' => $request->has('roomcategory_2'),
            '6_3' => $request->has('roomcategory_3'),
            '6_4' => $request->has('roomcategory_4'),
            '7_1' => $request->has('room_1'),
            '7_2' => $request->has('room_2'),
            '7_3' => $request->has('room_3'),
            '7_4' => $request->has('room_4'),
            '8_1' => $request->has('facility_1'),
            '8_2' => $request->has('facility_2'),
            '8_3' => $request->has('facility_3'),
            '8_4' => $request->has('facility_4'),
            '9_1' => $request->has('paymentmethod_1'),
            '9_2' => $request->has('paymentmethod_2'),
            '9_3' => $request->has('paymentmethod_3'),
            '9_4' => $request->has('paymentmethod_4'),
            '10_1' => $request->has('transaction_1'),
            '10_2' => $request->has('transaction_2'),
            '10_3' => $request->has('transaction_3'),
            '10_4' => $request->has('transaction_4'),
            '11_1' => $request->has('rating_1'),
            '11_2' => $request->has('rating_2'),
            '11_3' => $request->has('rating_3'),
            '11_4' => $request->has('rating_4')
        ];
        GroupUser::find($request->group)->update($validatedData);
        return response()->json(['message' => 'Data updated successfully!']);
    }
}
