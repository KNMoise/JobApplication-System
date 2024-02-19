<?php

// app/Http/Controllers/StockController.php

// app/Http/Controllers/StockController.php

namespace App\Http\Controllers;

use App\Models\StockRequisition;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function raiseRequisition(Request $request)
    {
        $stockRequisition = new StockRequisition();
        $stockRequisition->job_application_id = $request->job_application_id;
        $stockRequisition->save();

        return redirect()->route('stock.dashboard')->with('success', 'Stock requisition raised!');
    }

    public function updateStock(Request $request)
    {
        // Update stock based on approved requisitions
        $requisition = StockRequisition::findOrFail($request->requisition_id);

        // Add logic to update stock
        // ...

        // Notify production

        return redirect()->route('stock.dashboard')->with('success', 'Stock updated successfully!');
    }
}
