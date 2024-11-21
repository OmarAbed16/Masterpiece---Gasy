<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'national_number' => 'required|string|max:20|unique:drivers,national_number',
            'national_number_image' => 'required|image',
            'gas_license_image' => 'required|image',
            'driver_license_image' => 'required|image',
        ]);

        Driver::create($data);
        return redirect()->route('drivers.index')->with('success', 'Driver created successfully.');
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'national_number' => 'required|string|max:20|unique:drivers,national_number,' . $driver->id,
            'national_number_image' => 'nullable|image',
            'gas_license_image' => 'nullable|image',
            'driver_license_image' => 'nullable|image',
        ]);

        $driver->update($data);
        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }
}
