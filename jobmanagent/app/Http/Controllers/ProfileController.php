<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Display user profile settings
    public function showProfile()
    {
        $user = Auth::user();

        return view('profile.showProfile', compact('user'));
    }

    // Update user profile
    public function updateProfile(Request $request)
    {
        // Add logic to update user profile
        // ...

        return redirect()->route('profile.showProfile')->with('success', 'Profile updated successfully!');
    }

    // Show password reset form
    public function showPasswordReset()
    {
        return view('profile.showPasswordReset');
    }

    // Update user password
    public function updatePassword(Request $request)
    {
        // Add logic to update user password
        // ...

        return redirect()->route('profile.showProfile')->with('success', 'Password updated successfully!');
    }
}

