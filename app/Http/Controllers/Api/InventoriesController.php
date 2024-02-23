<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inventory::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'price' => 'required|string',
            'date_of_sale' => 'required|date',
            'vehicle_id' => 'required|exists:vehicles,vehicle_id'
        ]);


        // Create the Customer
        $inventories = Inventory::create([
            'price' => $validatedData['price'],
            'date_of_sale' => $validatedData['date_of_sale'],
            'vehicle_id' => $validatedData['vehicle_id'],
        ]);


        // Return the created customer
        return $inventories;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'price' => 'required|string',
            'date_of_sale' => 'required|date',
            'vehicle_id' => 'required|exists:vehicles,vehicle_id'
        ]);


        $inventories = Inventory::findOrFail($id);


        // Update the customer attributes
        $inventories->update($validatedData);


        return $inventories;
    }




    public function destroy($id)
    {
        // Logic to retrieve the specific vehicle before deleting it
        $inventories = Inventory::findOrFail($id);


        // Store the data before deletion
        $deletedData = $inventories->toArray();


        // Delete the customer
        $inventories->delete();


        // Return the deleted data in the response
        return response()->json(['message' => 'Inventory deleted successfully', 'deleted_data' => $deletedData]);
    }
}
