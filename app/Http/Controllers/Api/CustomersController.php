<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;


class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Customers::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required|string',
        ]);


        // Create the Customer
        $customers = Customers::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'gender' => $validatedData['gender'],
        ]);


        // Return the created customer
        return $customers;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required|string',
        ]);


        $customers = Customers::findOrFail($id);


        // Update the customer attributes
        $customers->update($validatedData);


        return $customers;
    }




    public function destroy($id)
    {
        // Logic to retrieve the specific vehicle before deleting it
        $customers = Customers::findOrFail($id);


        // Store the data before deletion
        $deletedData = $customers->toArray();


        // Delete the customer
        $customers->delete();


        // Return the deleted data in the response
        return response()->json(['message' => 'Customer deleted successfully', 'deleted_data' => $deletedData]);
    }
}
