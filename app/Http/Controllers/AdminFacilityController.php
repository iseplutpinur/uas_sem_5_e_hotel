<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminFacilityController extends Controller
{
    public function index()
    {
        if (Gate::allows('8_1')) {
            return view('admin.facility.index', [
                'title' => 'Facility'
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function table()
    {
        $response = view('admin.facility.table', [
            'facilities' => Facility::filter(request(['search_by', 'search']))->paginate(10)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function add()
    {
        if (Gate::allows('8_2')) {
            return view('admin.facility.add', [
                'title' => 'Add Facility'
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('8_2')) {
            $validatedData = $request->validate([
                'icon' => ['required'],
                'name' => ['required']
            ], [
                'icon.required' => 'Icon is required.',
                'name.required' => 'Name is required.'
            ]);

            $validatedData['price'] = $request->price;
            $validatedData['is_addon'] = $request->has('is_addon');
            Facility::create($validatedData);
            return response()->json(['message' => 'Data saved successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function edit($id)
    {
        if (Gate::allows('8_3')) {
            return view('admin.facility.edit', [
                'title' => 'Edit Facility',
                'facility' => Facility::find($id)
            ]);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function update(Request $request)
    {
        if (Gate::allows('8_3')) {
            $validatedData = $request->validate([
                'icon' => ['required'],
                'name' => ['required']
            ], [
                'icon.required' => 'Icon is required.',
                'name.required' => 'Name is required.'
            ]);

            $validatedData['price'] = $request->price;
            $validatedData['is_addon'] = $request->has('is_addon');
            Facility::find($request->id)->update($validatedData);
            return response()->json(['message' => 'Data updated successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }

    public function delete($id)
    {
        if (Gate::allows('8_4')) {
            Facility::destroy($id);
            return response()->json(['message' => 'Data deleted successfully!']);
        } else {
            return redirect()->route('admin.error-401');
        }
    }
}
