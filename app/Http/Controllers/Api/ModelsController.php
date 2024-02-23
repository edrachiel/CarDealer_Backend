<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models;

class ModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Models::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'body_style' => 'required|string',
            'options_id' => 'required|exists:options,options_id',
            'suppliers_id' => 'required|exists:suppliers,suppliers_id'
        ]);


        // Create the Customer
        $models = Models::create([
            'name' => $validatedData['name'],
            'body_style' => $validatedData['body_style'],
            'options_id' => $validatedData['options_id'],
            'suppliers_id' => $validatedData['suppliers_id'],
        ]);


        // Return the created customer
        return $models;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'body_style' => 'required|string',
            'options_id' => 'required|exists:options,options_id',
            'suppliers_id' => 'required|exists:suppliers,suppliers_id'
        ]);


        $models = Models::findOrFail($id);


        // Update the customer attributes
        $models->update($validatedData);


        return $models;
    }




    public function destroy($id)
    {
        // Logic to retrieve the specific vehicle before deleting it
        $models = Models::findOrFail($id);


        // Store the data before deletion
        $deletedData = $models->toArray();


        // Delete the customer
        $models->delete();


        // Return the deleted data in the response
        return response()->json(['message' => 'Models deleted successfully', 'deleted_data' => $deletedData]);
    }
}
