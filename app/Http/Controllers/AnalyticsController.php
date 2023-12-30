<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Fetch the latest row from the analytics_table
        $latestRow = DB::table('analytics_table')->orderBy('id', 'desc')->first();

        // Check if $latestRow is not null
        if ($latestRow) {
            // Fetch data for the graph
            $graphData = DB::table('analytics_table')->select('id', 'nett_profit')->get();

            // Initialize arrays to store data for the graph
            $labels = $nettProfits = [];

            // Loop through the result and extract data for the graph
            foreach ($graphData as $data) {
                $labels[] = $data->id;
                $nettProfits[] = $data->nett_profit;
            }

            // Calculate the progress percentage based on nett_profit and the monthly target
            $monthlyTarget = 1000; // Set the target to RM 1,000
            $progressPercentage = ($latestRow->nett_profit / $monthlyTarget) * 100;

            // Limit the progress percentage to a maximum of 100%
            $progressPercentage = min($progressPercentage, 100);
        } else {
            // If $latestRow is null, set default values
            $labels = $nettProfits = [];
            $progressPercentage = 0;
        }

        // Return the view with data
        return view('analytics.index', compact('latestRow', 'labels', 'nettProfits', 'progressPercentage'));
    }
}
