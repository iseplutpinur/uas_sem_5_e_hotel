<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class AdminFacilityController extends Controller
{
    public function index()
    {
        return view('admin.facility.index', [
            'title' => 'Facility'
        ]);
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
        return view('admin.facility.add', [
            'title' => 'Add Facility'
        ]);
    }

    public function store(Request $request)
    {
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
    }

    public function edit($id)
    {
        return view('admin.facility.edit', [
            'title' => 'Edit Facility',
            'facility' => Facility::find($id)
        ]);
    }

    public function update(Request $request)
    {
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
    }

    public function delete($id)
    {
        Facility::destroy($id);
        return response()->json(['message' => 'Data deleted successfully!']);
    }
}
