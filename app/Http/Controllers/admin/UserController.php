<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
public function index()
{
    $users = User::where('role', 'user')->latest()->get();
    return view('admin.users', compact('users'));
}


  public function block($id)
{
    User::where('id', $id)->update(['status' => 0]);
    return back()->with('success', 'User blocked successfully');
}

public function unblock($id)
{
    User::where('id', $id)->update(['status' => 1]);
    return back()->with('success', 'User unblocked successfully');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
