<?php


// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class AdminController extends Controller
{
    public function index()
    {
        // Logic for the admin dashboard
        $pendingApplications = JobApplication::where('status', 'pending')->count();
        $approvedApplications = JobApplication::where('status', 'approved')->count();
        $rejectedApplications = JobApplication::where('status', 'rejected')->count();

        return view('admin.dashboard', compact('pendingApplications', 'approvedApplications', 'rejectedApplications'));
    }
    public function viewJobApplications()
    {
        $jobApplications = JobApplication::where('status', 'pending')->get();

        return view('admin.viewJobApplications', compact('jobApplications'));
    }
    

    public function approveJobApplication($id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->status = 'approved';
        $jobApplication->save();

        return redirect()->route('admin.viewJobApplications')->with('success', 'Job application approved successfully!');
    }
    public function rejectJobApplication($id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->status = 'rejected';
        $jobApplication->save();

        // Notify employee

        return redirect()->route('admin.viewJobApplications')->with('error', 'Job application rejected!');
    }
    public function registerEmployee(Request $request)
    {
        // Validate and store employee data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'department' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->department = $request->input('department');
        $user->role = 'employee'; // Assigning the role as an employee
        $user->save();

        // Redirect to admin dashboard with success message
        return redirect()->route('admin.manageUsers')->with('success', 'Employee registered successfully!');
    }

    public function manageUsers()
    {
        // Retrieve and display user management view
        $users = User::all();
        $employees = User::where('role', 'employee')->get();

        return view('admin.manageUsers', compact('employees'));
    }
    public function showPendingApplications()
    {
        // Logic to display pending job applications
        $applications = JobApplication::where('status', 'pending')->get();
        return view('admin.pending-applications', compact('applications'));
    }
}

