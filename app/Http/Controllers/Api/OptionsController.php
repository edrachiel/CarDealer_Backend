<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Options;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Options::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'color' => 'required|string',
            'transmission' => 'required|string',
            'engine' => 'required|string'
        ]);


        // Create the Customer
        $options = Options::create([
            'color' => $validatedData['color'],
            'transmission' => $validatedData['transmission'],
            'engine' => $validatedData['engine'],
        ]);


        // Return the created customer
        return $options;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'color' => 'required|string',
            'transmission' => 'required|string',
            'engine' => 'required|string'
        ]);


        $options = Options::findOrFail($id);


        // Update the customer attributes
        $options->update($validatedData);


        return $options;
    }




    public function destroy($id)
    {
        // Logic to retrieve the specific vehicle before deleting it
        $options = Options::findOrFail($id);


        // Store the data before deletion
        $deletedData = $options->toArray();


        // Delete the customer
        $options->delete();


        // Return the deleted data in the response
        return response()->json(['message' => 'Options deleted successfully', 'deleted_data' => $deletedData]);
    }
}
