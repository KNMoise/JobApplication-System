<?php

// app/Http/Controllers/ProductionController.php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\JobApplication;

// app/Http/Controllers/ProductionController.php

class ProductionController extends Controller
{
    public function checkStock(Request $request)
    {
        // Check stock for required materials
        // If materials not available, initiate stock requisition
        // Redirect back to production dashboard
    }
    public function dashboard()
    {
        // Retrieve and display production dashboard view
        $inProductionApplications = JobApplication::where('status', 'in_production')->get();

        return view('production.dashboard', compact('inProductionApplications'));
    }

    protected function initiateStockRequisition(JobApplication $jobApplication)
    {
        // Logic to initiate stock requisition
    }
    public function startProduction($id)
    {
        // Start production for the approved job application
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->status = 'in_production';
        $jobApplication->save();

        // Notify employees and update job application status

        return redirect()->route('production.dashboard')->with('success', 'Production started successfully!');
    }
    
    public function notifyEmployees($id)
    {
        // Notify employees about the started production
        $jobApplication = JobApplication::findOrFail($id);

        // Add logic to send notifications to employees
        // ...

        return redirect()->route('production.dashboard')->with('success', 'Employees notified about production start!');
    }
    public function checkMaterialsAvailability($id)
    {
        // Check materials availability before starting production
        $jobApplication = JobApplication::findOrFail($id);

        // Add logic to check materials availability in stock
        // ...
$materialsAvailable = Stock::checkMaterialsAvailability($jobApplication);
        if ($materialsAvailable) {
            return redirect()->route('production.startProduction', $id)->with('success', 'Materials available. Proceed to production.');
        } else {
            // Redirect to raise stock requisition
            return redirect()->route('stock.raiseRequisition', $id)->with('info', 'Materials not available. Raise stock requisition.');
        }
    }

    public function confirmStartProduction($id)
    {
        // Confirm the start of production
        $jobApplication = JobApplication::findOrFail($id);

        // Add logic to update job application status and start production
        // ...

        return redirect()->route('production.dashboard')->with('success', 'Production started!');
    }

    public function createStockRequisition($id)
    {
        // Create stock requisition for materials needed in production
        $jobApplication = JobApplication::findOrFail($id);

        // Add logic to create stock requisition
        // ...

        return redirect()->route('production.dashboard')->with('info', 'Materials requisition created. Waiting for approval.');
    }
}



