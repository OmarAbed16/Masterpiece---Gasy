<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    public function create()
    {
        return view('pages.profile');
    }


    public function userManagement()
    {
        $users = User::where('is_deleted', '0')
        ->where('role', 'customer')
        ->get();
        return view('pages.laravel-examples.user-management', compact('users'));
    }

    public function update()
    {

        $user = request()->user();
        $attributes = request()->validate([
            'name' => 'required',
            'phone' => 'required|max:10',
            'location' => 'max:150',
            'about' => 'required|max:150',
            'governorate' => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if (request()->hasFile('profile_image')) {
            $image = request()->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/img/images'), $imageName);
            $attributes['profile_image'] =  $imageName;
        }
        
        $user->update($attributes);
        return back()->withStatus('Profile successfully updated.');
        
}
}