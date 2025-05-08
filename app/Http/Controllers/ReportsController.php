<?php

namespace App\Http\Controllers;

use App\Models\Product_In;
use App\Models\Product_Out;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // Get the date from request or use today's date
        $date = $request->get('date', date('Y-m-d'));

        // Get stock in records for the selected date
        $stockIns = Product_In::with('product')
            ->whereDate('prin_date', $date)
            ->get();

        // Get stock out records for the selected date
        $stockOuts = Product_Out::with('product')
            ->whereDate('prout_date', $date)
            ->get();

        // Calculate total stock in value
        $totalStockInValue = $stockIns->sum(function ($stockIn) {
            return $stockIn->prin_quantity * $stockIn->unit_price;
        });

        // Calculate total stock out quantity
        $totalStockOutQuantity = $stockOuts->sum('prout_quantity');

        return view('reports.index', compact(
            'stockIns',
            'stockOuts',
            'totalStockInValue',
            'totalStockOutQuantity',
            'date'
        ));
    }
}
