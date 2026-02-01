<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class VendorAuthController extends Controller
{
    // Show vendor login page
    public function showLoginForm()
    {
        return view('vendor.auth.login');
    }

    // Handle vendor login
 public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('vendor')->attempt([
        'email' => $request->email,
        'password' => $request->password,
    ])) {
        return redirect()->route('vendor.dashboard');
    }

    return back()->with('error', 'Invalid vendor credentials');
}

    // Show vendor registration page
    public function showRegisterForm()
    {
        return view('vendor.auth.register');
    }

    // Handle vendor registration (UPDATED)
    public function register(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'company_name'  => 'required|string|max:255',
            'email'         => 'required|email|unique:vendors,email',
            'password'      => 'required|confirmed|min:6',
            'phone'         => 'nullable|string|max:20',
            'website'       => 'nullable|url',
            'location'      => 'nullable|string|max:255',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/vendors'), $imageName);
        }

        // Create vendor
        $vendor = Vendor::create([
            'name'         => $request->name,
            'company_name' => $request->company_name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone'        => $request->phone,
            'website'      => $request->website,
            'location'     => $request->location,
            'image'        => $imageName,
        ]);



        return redirect()->route('vendor.dashboard');
    }

    // Vendor logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('vendor.login');
    }
}
