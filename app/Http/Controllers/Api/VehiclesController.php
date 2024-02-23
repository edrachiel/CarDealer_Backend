<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table("vehicles")
            ->join("models", "vehicles.models_id", "=", "models.models_id")
            ->join("brands", "brands.models_id", "=", "models.models_id")
            ->join("options", "models.models_id", "=", "options.options_id")
            ->join("inventories", "inventories.vehicle_id", "=", "vehicles.vehicle_id")



            ->select(
                "vehicles.vehicle_id",
                "vin",
                "models.body_style",
                "options.color",
                "options.transmission",
                "options.engine",
                'inventories.price',
                DB::raw('models.name as model_name'),
                DB::raw('brands.name as brand_name'),
            )
            ->get();
        return $data;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'vin' => 'required|string',
            'models_id' => 'required|exists:models,models_id',
            'dealers_id' => 'required|exists:dealers,dealers_id'
        ]);


        // Create the Customer
        $vehicles = Vehicle::create([
            'vin' => $validatedData['vin'],
            'models_id' => $validatedData['models_id'],
            'dealers_id' => $validatedData['dealers_id'],
        ]);


        // Return the created customer
        return $vehicles;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'vin' => 'required|string',
            'models_id' => 'required|exists:models,models_id',
            'dealers_id' => 'required|exists:dealers,dealers_id'
        ]);


        $vehicles = Vehicle::findOrFail($id);


        // Update the customer attributes
        $vehicles->update($validatedData);


        return $vehicles;
    }




    public function destroy($id)
    {
        // Logic to retrieve the specific vehicle before deleting it
        $vehicles = Vehicle::findOrFail($id);


        // Store the data before deletion
        $deletedData = $vehicles->toArray();


        // Delete the customer
        $vehicles->delete();


        // Return the deleted data in the response
        return response()->json(['message' => 'Vehicle deleted successfully', 'deleted_data' => $deletedData]);
    }
}
