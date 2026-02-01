<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Show the edit profile page
    public function edit()
    {
        $vendor = Auth::user(); // get logged-in vendor
        return view('vendor.edit-profile', compact('vendor'));
    }

    // Handle profile update
    public function update(Request $request)
    {
        $vendor = Auth::user(); // get logged-in vendor

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($vendor->id),
            ],
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update fields
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->location = $request->location;
        $vendor->bio = $request->bio;

        // Handle profile image
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');

            // Delete old image if exists
            if ($vendor->profile_image && file_exists(storage_path('app/public/'.$vendor->profile_image))) {
                unlink(storage_path('app/public/'.$vendor->profile_image));
            }

            $vendor->profile_image = $imagePath;
        }

        // Handle password change
        if ($request->filled('password')) {
            $vendor->password = Hash::make($request->password);
        }

        $vendor->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
