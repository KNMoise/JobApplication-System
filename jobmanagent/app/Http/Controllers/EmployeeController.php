<?php

namespace App\Http\Controllers;
// app/Http/Controllers/EmployeeController.php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        // Retrieve and display employee dashboard view
        $jobApplications = JobApplication::where('user_id', Auth::id())->get();

        return view('employee.dashboard', compact('jobApplications'));
    }
    

    public function createJobApplication(Request $request)
    {
        // Validate and store job application
        $jobApplication = new JobApplication();
        $jobApplication->user_id = Auth::id();
        $jobApplication->status = 'pending'; // Initial status
        $jobApplication->save();

        // Notify finance department

        return redirect()->route('employee.dashboard')->with('success', 'Job application submitted successfully!');
    }
    public function viewJobApplicationStatus($id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        return view('employee.viewJobApplicationStatus', compact('jobApplication'));
    }

    public function profileSettings()
    {
        // Add logic to retrieve necessary data if needed
        return view('employee.profileSettings');
    }

    public function changePassword()
    {
        // Add logic to retrieve necessary data if needed
        return view('employee.changePassword');
    }
}
