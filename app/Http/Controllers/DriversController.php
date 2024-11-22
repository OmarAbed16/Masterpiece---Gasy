<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function index()
{
    // Join drivers with users and trucks tables to get driver, user, and truck info
    $drivers = Driver::join('users', 'drivers.user_id', '=', 'users.id')
        ->leftJoin('trucks', 'drivers.driver_id', '=', 'trucks.driver_id') // Join with trucks table
        ->select(
            'drivers.*', 
            'users.name', 
            'users.email', 
            'users.phone',
            'users.governorate',
            'users.profile_image',
            'users.created_at',
            'trucks.license_plate as truck_license_plate', // Select truck details
            'trucks.company_name as company',
            'trucks.capacity as truck_capacity',
            'trucks.current_load as truck_load',
            'trucks.status as truck_status'
        )
        ->get();

    return view('pages.tables', compact('drivers'));
}



    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        return view('pages.view_driver', compact('driver'));
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('pages.edit_driver', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|string',
        ]);

        $driver = Driver::findOrFail($id);
        $driver->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully!');
    }

    public function destroy($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found.'
        ], 404);
    }

    $user->is_deleted = 1;
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'User marked as deleted successfully!'
    ]);
}

    
}
