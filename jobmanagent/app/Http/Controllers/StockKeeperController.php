<?php


namespace App\Http\Controllers;

use App\Models\StockRequisition;
use Illuminate\Http\Request;

class StockKeeperController extends Controller
{
    // ... (previous methods)

    public function updateStock(Request $request, $id)
    {
        // Update stock based on approved requisition
        $requisition = StockRequisition::findOrFail($request->requisition_id);

        // Add logic to update stock
        // ...

        // Notify production

        return redirect()->route('stock.dashboard')->with('success', 'Stock updated successfully!');
    }
    public function viewStockRequisition($id)
    {
        // View stock requisition details
        $requisition = StockRequisition::findOrFail($id);

        return view('stock.viewStockRequisition', compact('requisition'));
    }
    public function approveStockRequisition($id)
    {
        // Approve the stock requisition, update status
        $requisition = StockRequisition::findOrFail($id);
        $requisition->status = 'approved';
        $requisition->save();

        // Notify production

        return redirect()->route('stock.dashboard')->with('success', 'Stock requisition approved!');
    }

    public function rejectStockRequisition($id)
    {
        // Reject the stock requisition, update status
        $requisition = StockRequisition::findOrFail($id);
        $requisition->status = 'rejected';
        $requisition->save();

        // Notify production

        return redirect()->route('stock.dashboard')->with('success', 'Stock requisition rejected!');
    }
}

