<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\StockRequisition;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JobApplicationStatusNotification;
use Illuminate\Notifications\Notification;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class JobApplicationController extends Controller
{
    use HasRoles, AuthenticatesUsers;
    
    public function create(Request $request)
    {
        // Validate and create a new job application
        $jobApplication = new JobApplication();
        $jobApplication->user_id = Auth::id();
        $jobApplication->status = 'pending'; // Initial status
        $jobApplication->save();

         // Create stock requisition
        $stockRequisition = new StockRequisition([
            'reference_number' => 'REQ_' . uniqid(),
        ]);
        $jobApplication->stockRequisition()->save($stockRequisition);

        
        return redirect()->route('employee.dashboard')->with('success', 'Job application submitted successfully!');
    }
    // public function create()
    // {
    //     return view('employee.createJobApplication');
    // }
    public function financeApproval($id)
    {
        // Logic for finance department approval or rejection
        $jobApplication = JobApplication::find($id);
        $jobApplication->finance_approval = true; // Update the approval status
        $jobApplication->save();

        // Notify user with job application status
        $jobApplication->user->notify(new JobApplicationStatusNotification($jobApplication));

        return redirect()->route('finance.dashboard')->with('success', 'Job application approved.');
    }

    public function adminApproval($id)
    {
        // Logic for admin department approval or rejection
        $jobApplication = JobApplication::find($id);
        $jobApplication->admin_approval = true; // Update the approval status
        $jobApplication->save();

        // Notify user with job application status
        $jobApplication->user->notify(new JobApplicationStatusNotification($jobApplication));

        return redirect()->route('admin.dashboard')->with('success', 'Job application approved.');
    }

    public function productionStart($id)
    {
        // Logic for starting production and updating dashboards
        $jobApplication = JobApplication::find($id);
        $jobApplication->production_started = true; // Update the production status
        $jobApplication->save();

        // Notify user with job application status
        $jobApplication->user->notify(new JobApplicationStatusNotification($jobApplication));

        return redirect()->route('production.dashboard')->with('success', 'Production started.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $user = auth()->user();

        $jobApplication = new JobApplication([
            'user_id' => $user->id,
            'description' => $request->description,
        ]);

        $jobApplication->save();

        return redirect()->route('employee.dashboard')->with('success', 'Job application submitted successfully!');
    }

    public function viewStatus($id)
    {
        $jobApplication = JobApplication::findOrFail($id);

        // Ensure the user has permission to view this job application
        $this->authorize('view', $jobApplication);

        return view('employee.viewJobApplicationStatus', compact('jobApplication'));
    }
    public function updateStatus(Request $request, $id, $status, $user)
    {
        $jobApplication = JobApplication::findOrFail($id);

        // Check if the status is approved
        if ($status == 'approved') {
            // Check if the current user is in the production department
            if (auth()->check() && auth()->$user->hasRole('production')) {
                // Check if materials are available in stock
                if ($this->checkMaterialsAvailability($jobApplication)) {
                    // Update status to 'under production'
                    $jobApplication->status = 'under production';
                    $jobApplication->save();
                    return redirect()->route('employee-dashboard')->with('success', 'Job application approved. Under production.');
                } else {
                    // Redirect to stock requisition form
                    return redirect()->route('raise-stock-requisition', $jobApplication->id)->with('info', 'Materials not available. Raise stock requisition.');
                }
            }
        }
        // Update status to 'rejected'
        $jobApplication->status = 'rejected';
        $jobApplication->save();
        return redirect()->route('employee-dashboard')->with('success', 'Job application rejected.');
    }
    private function checkMaterialsAvailability(JobApplication $jobApplication)
    {
        // Implement logic to check materials availability in stock
        // Return true if materials are available, false otherwise
    }
}


