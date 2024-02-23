<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Suppliers::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);


        // Create the Customer
        $suppliers = Suppliers::create([
            'name' => $validatedData['name'],
        ]);


        // Return the created customer
        return $suppliers;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);


        $suppliers = Suppliers::findOrFail($id);


        // Update the customer attributes
        $suppliers->update($validatedData);


        return $suppliers;
    }




    public function destroy($id)
    {
        // Logic to retrieve the specific vehicle before deleting it
        $suppliers = Suppliers::findOrFail($id);


        // Store the data before deletion
        $deletedData = $suppliers->toArray();


        // Delete the customer
        $suppliers->delete();


        // Return the deleted data in the response
        return response()->json(['message' => 'Supplier deleted successfully', 'deleted_data' => $deletedData]);
    }
}
