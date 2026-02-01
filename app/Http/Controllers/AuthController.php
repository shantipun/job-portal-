<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
 public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);

        // 🔥 ROLE BASED REDIRECT
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'vendor') {
            return redirect()->route('vendor.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.'
    ]);
}
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }  public function registerSubmit(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:user,vendor,admin',
        ]);

        // 🔐 security: admin block
        $role = in_array($request->role, ['user', 'vendor'])
                ? $request->role
                : 'user';

        // 📂 profile image upload
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')
                ->store('profiles', 'public');
        }

        // 📂 resume upload
     

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone'        => $request->phone,
            'location'     => $request->location,
          
            'bio'          => $request->bio,
            'role'         => $role,
            'profile_image'=> $profileImagePath,
           
        ]);

        return redirect()->route('login')
            ->with('success', 'Account created successfully!');
    }
public function showRegister()
{
    return view('auth.register'); // or your blade path
}
  
}
