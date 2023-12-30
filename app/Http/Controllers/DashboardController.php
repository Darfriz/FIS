<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Set the limit of records to display per page
        $limit = 5;

        // Retrieve data from the flights table with pagination
        $flights = Flight::paginate($limit);

        return view('dashboard.index', ['flights' => $flights]);
    }

    public function searchByName(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        // Perform the search in the database based on $searchTerm
        $results = Flight::where('name', 'LIKE', "%$searchTerm%")->get();

        return view('dashboard.search_results', ['results' => $results]);
    }

    public function deleteRow(Request $request)
    {
        $id = $request->input('id');

        try {
            // Perform the delete operation on the database
            DB::table('flights')->where('id', $id)->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error deleting record: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error deleting record']);
        }
    }
}
