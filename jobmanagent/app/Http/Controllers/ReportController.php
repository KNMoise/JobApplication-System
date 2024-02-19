<?php


namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\StockRequisition;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generate(Request $request)
    {
        // Generate reports based on user's role
        $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
                $jobApplications = JobApplication::all();
                return view('reports.admin', compact('jobApplications'));
            case 'finance':
                    $approvedRequisitions = StockRequisition::where('status', 'approved')->get();
                    return view('reports.finance', compact('approvedRequisitions'));
            case 'finance':
                $requisitions = StockRequisition::where('status', 'approved')->get();
                return view('reports.finance', compact('requisitions'));

            case 'production':
                $inProduction = JobApplication::where('status', 'in_production')->get();
                return view('reports.production', compact('inProduction'));

            case 'stockkeeper':
                $pendingRequisitions = StockRequisition::where('status', 'pending')->get();
                return view('reports.stockkeeper', compact('pendingRequisitions'));
                case 'stockkeeper':
                    $approvedRequisitions = StockRequisition::where('status', 'approved')->get();
                    return view('reports.stockkeeper', compact('approvedRequisitions'));
    
                default:
                    return abort(403, 'Unauthorized action.');
        }
    }
    public function generateByRole(Request $request, $role)
    {
        // Generate reports based on user's role
        switch ($role) {
            case 'admin':
                $jobApplications = JobApplication::all();
                return view('reports.admin', compact('jobApplications'));

            case 'finance':
                $requisitions = StockRequisition::where('status', 'approved')->get();
                return view('reports.finance', compact('requisitions'));

            case 'production':
                $inProduction = JobApplication::where('status', 'in_production')->get();
                return view('reports.production', compact('inProduction'));

            case 'stockkeeper':
                $pendingRequisitions = StockRequisition::where('status', 'pending')->get();
                return view('reports.stockkeeper', compact('pendingRequisitions'));

            default:
                return abort(403, 'Unauthorized action.');
        }
    }
}



