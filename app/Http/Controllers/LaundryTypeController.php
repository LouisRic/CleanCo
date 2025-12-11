<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryType;

class LaundryTypeController extends Controller
{
    public function index()
    {
        $laundryTypes = LaundryType::all();

        return view('admin.services.index', compact('laundryTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'process_days' => 'required|numeric|min:1',
            'price_per_kg' => 'required|numeric|min:1000',
        ]);

        LaundryType::create([
            'name' => $request->name,
            'process_days' => $request->process_days,
            'price_per_kg' => $request->price_per_kg,
        ]);

        return redirect()->route('services.index')->with('success', 'Laundry Type added successfully');
    }

    public function create()
    {
        $laundryTypes = LaundryType::all();
        return view('admin.services.create');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'process_days' => 'required|numeric|min:1',
            'price_per_kg' => 'required|numeric|min:1000',
        ]);

        $laundryTypes = LaundryType::findOrFail($id);

        $laundryTypes->update([
            'name' => $request->name,
            'process_days' => $request->process_days,
            'price_per_kg' => $request->price_per_kg,
        ]);

        return redirect()->route('services.index')->with('success', 'Laundry Type added successfully');
    }

    public function edit($id)
    {
        $laundryType = LaundryType::findOrFail($id);
        return view('admin.services.edit', compact('laundryType'));
    }

    public function destroy($id)
    {
        $laundryTypes = LaundryType::findOrFail($id);
        $laundryTypes->delete();

        return redirect()->back()->with('success', 'Laundry Type deleted successfully');
    }
}
