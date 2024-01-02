<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Fetch all rows from the analytics_table
        $allRows = DB::table('analytics_table')->get();

        // Calculate the total of each column across all rows
        $totalGrossProfit = $allRows->sum('gross_profit');
        $totalTax = $allRows->sum('tax');
        $totalOperationalCost = $allRows->sum('operational_cost');
        $totalNettProfit = $allRows->sum('nett_profit');

        // Return the view with data
        return view('analytics.index', compact(
            'totalGrossProfit',
            'totalTax',
            'totalOperationalCost',
            'totalNettProfit'
        ));
    }
}
