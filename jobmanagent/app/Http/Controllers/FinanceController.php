<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use AdminRejectionNotification;
use App\Models\StockRequisition;
use EmployeeRejectionNotification;
use Illuminate\Notifications\Notification;

class FinanceController extends Controller
{
    public function dashboard()
    {
        $pendingJobApplications = JobApplication::where('status', 'pending')->get();
        $pendingStockRequisitions = StockRequisition::where('status', 'pending')->get();

        return view('finance.dashboard', compact('pendingJobApplications', 'pendingStockRequisitions'));

    }
    public function approveJobApplication($id)
    {
        // Approve the job application, notify admin, and move to production if needed
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->status = 'approved';
        $jobApplication->save();

        // Notify admin and production

        return redirect()->route('finance.dashboard')->with('success', 'Job application approved successfully!');
    }

    public function rejectJobApplication($id)
    {
        // Reject the job application, notify admin and employee
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->status = 'rejected';
        $jobApplication->save();

        // Notify admin and employee

        return redirect()->route('finance.dashboard')->with('error', 'Job application rejected!');
    }

    protected function moveToProduction(JobApplication $jobApplication)
    {
        // Logic to move job application to production
    }

    // protected function notifyAdminRejection(JobApplication $jobApplication)
    // {
    //     // Notify admin about the rejected job application
    //     Notification::send($jobApplication->user->adminUsers, new AdminRejectionNotification($jobApplication));
    // }

    // protected function notifyEmployeeRejection(JobApplication $jobApplication)
    // {
    //     // Notify employee about the rejected job application
    //     Notification::send($jobApplication->user, new EmployeeRejectionNotification($jobApplication));
    // }
    public function approveStockRequisition($id)
    {
        // Approve the stock requisition
        $requisition = StockRequisition::findOrFail($id);
        $requisition->status = 'approved';
        $requisition->save();

        // Notify stock keeper

        return redirect()->route('finance.dashboard')->with('success', 'Stock requisition approved successfully!');
    }
}
