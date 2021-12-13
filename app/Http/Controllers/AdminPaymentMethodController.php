<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPaymentMethodController extends Controller
{
    public function index()
    {
        return view('admin.payment-method.index', [
            'title' => 'Payment Method'
        ]);
    }

    public function table()
    {
        $response = view('admin.payment-method.table', [
            'payment_methods' => PaymentMethod::filter(request(['search_by', 'search']))->paginate(5)->withQueryString()
        ])->render();
        return response()->json($response);
    }

    public function add()
    {
        return view('admin.payment-method.add', [
            'title' => 'Add Payment Method'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'number' => ['required'],
            'owner' => ['required'],
            'logo' => ['required', 'image', 'file', 'max:2048'],
        ], [
            'name.required' => 'Name is required.',
            'number.required' => 'Number is required.',
            'owner.required' => 'Owner is required.',
            'logo.required' => 'Logo is required.',
            'logo.image' => 'Logo must be an image.',
            'logo.file' => 'Logo must be an file.'
        ]);

        if ($request->file('logo')) {
            $fileName = 'e-hotel-' . time() . '.' . $request->file('logo')->extension();
            Storage::putFileAs('payment_method-photo', $request->file('logo'), $fileName);
            $validatedData['logo'] = $fileName;
        }

        PaymentMethod::create($validatedData);
        return response()->json(['message' => 'Data saved successfully!']);
    }

    public function edit($id)
    {
        return view('admin.payment-method.edit', [
            'title' => 'Edit Payment Method',
            'payment_method' => PaymentMethod::find($id)
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'number' => ['required'],
            'owner' => ['required'],
            'logo' => ['image', 'file', 'max:2048'],
        ], [
            'name.required' => 'Name is required.',
            'number.required' => 'Number is required.',
            'owner.required' => 'Owner is required.',
            'logo.image' => 'Logo must be an image.',
            'logo.file' => 'Logo must be an file.'
        ]);

        if ($request->file('logo')) {
            $fileName = 'e-hotel-' . time() . '.' . $request->file('logo')->extension();
            Storage::putFileAs('payment_method-photo', $request->file('logo'), $fileName);
            Storage::delete('payment_method-photo/' . $request->oldLogo);
            $validatedData['logo'] = $fileName;
        }

        PaymentMethod::find($request->id)->update($validatedData);
        return response()->json(['message' => 'Data updated successfully!']);
    }

    public function delete($id)
    {
        if (PaymentMethod::find($id)->logo) {
            Storage::delete('payment_method-photo/' . PaymentMethod::find($id)->logo);
        }
        PaymentMethod::destroy($id);
        return response()->json(['message' => 'Data deleted successfully!']);
    }
}
