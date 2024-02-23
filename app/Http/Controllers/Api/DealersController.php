<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dealers;
use Illuminate\Http\Request;


class DealersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Dealers::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string'
        ]);


        // Create the Customer
        $dealers = Dealers::create([
            'name' => $validatedData['name'],
        ]);


        // Return the created customer
        return $dealers;
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


        $dealers = Dealers::findOrFail($id);


        // Update the customer attributes
        $dealers->update($validatedData);


        return $dealers;
    }




    public function destroy($id)
    {
        // Logic to retrieve the specific vehicle before deleting it
        $dealers = Dealers::findOrFail($id);


        // Store the data before deletion
        $deletedData = $dealers->toArray();


        // Delete the customer
        $dealers->delete();


        // Return the deleted data in the response
        return response()->json(['message' => 'Dealer deleted successfully', 'deleted_data' => $deletedData]);
    }
}
