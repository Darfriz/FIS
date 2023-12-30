<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Analytics;


class FlightController extends Controller
{
    public function index()
    {
        return view('flight.index'); //"flight" folder inside "resources/views" with "index.blade.php"
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'date' => 'required|date',
            'passengers' => 'required|integer|min:1',
            '_token' => 'required', // Ensure the CSRF token is present
        ]);

        // Calculate total price based on the pricing information provided
        $totalPrice = $this->calculateTotalPrice($validatedData['from_location'], $validatedData['to_location']);
        $totalPrice *= $validatedData['passengers'];

        // Create a new Flight model instance
        $flight = new Flight([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'from_location' => $validatedData['from_location'],
            'to_location' => $validatedData['to_location'],
            'date' => $validatedData['date'],
            'passengers' => $validatedData['passengers'],
            'total_price' => $totalPrice,
        ]);

        // Save the flight data to the database
        $flight->save();

        // Update the analytics table
        $this->updateAnalyticsTable($totalPrice);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Booking Successfully.');
    }

    // Helper method to calculate total price based on from_location and to_location
    private function calculateTotalPrice($fromLocation, $toLocation)
    {
        $pricingMatrix = [
            'Perlis' => [
                'Penang' => 50,
                'KL' => 100,
                'Terengganu' => 150,
                'Johor' => 200,
            ],
            'Penang' => [
                'Perlis' => 50,
                'KL' => 50,
                'Terengganu' => 100,
                'Johor' => 150,
            ],
            'KL' => [
                'Perlis' => 100,
                'Penang' => 50,
                'Terengganu' => 50,
                'Johor' => 100,
            ],
            'Terengganu' => [
                'Perlis' => 150,
                'Penang' => 100,
                'KL' => 50,
                'Johor' => 50,
            ],
            'Johor' => [
                'Perlis' => 200,
                'Penang' => 150,
                'KL' => 100,
                'Terengganu' => 50,
            ],
        ];
    
        // Check if the provided locations exist in the pricing matrix
        if (isset($pricingMatrix[$fromLocation]) && isset($pricingMatrix[$fromLocation][$toLocation])) {
            return $pricingMatrix[$fromLocation][$toLocation];
        } else {
            // Default price if the locations are not found in the matrix
            return 0;
        }
    }

    private function updateAnalyticsTable($totalPrice)
{
    // Calculate values for analytics (You need to define your own logic)
    $grossProfit = $totalPrice * 0.8; // Example: 80% of total price
    $tax = $totalPrice * 0.1; // Example: 10% of total price
    $operationalCost = $totalPrice * 0.1; // Example: 10% of total price
    $nettProfit = $grossProfit - $tax - $operationalCost;

    // Fetch the existing analytics record or create a new one if it doesn't exist
    $analytics = Analytics::find(1);

    // If no record exists, create a new one
    if (!$analytics) {
        $analytics = new Analytics(['id' => 1]);
    }

    // Add the calculated values to the existing values (considering null as 0)
    $analytics->gross_profit = ($analytics->gross_profit ?? 0) + $grossProfit;
    $analytics->tax = ($analytics->tax ?? 0) + $tax;
    $analytics->operational_cost = ($analytics->operational_cost ?? 0) + $operationalCost;
    $analytics->nett_profit = ($analytics->nett_profit ?? 0) + $nettProfit;

    // Save the changes
    $analytics->save();
}
}
