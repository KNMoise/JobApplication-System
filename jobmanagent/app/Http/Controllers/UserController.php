<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profileSettings(Request $request)
    {
        // Retrieve and display user profile settings view
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('manage-users')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manage-users')->with('success', 'User deleted successfully.');
    }
    
}
