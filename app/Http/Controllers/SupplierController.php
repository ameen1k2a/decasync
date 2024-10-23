<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;
use App\Models\Country;
class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tax_no' => 'required|string|max:255',
            'country' => 'required|integer|exists:countries,id', // Validate country as an integer and ensure it exists in the countries table
            'mobile_no' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'status' => 'required|in:Active,Inactive,Blocked',
        ]);
        
        Supplier::create([
            'name' => $request->name,
            'address' => $request->address,
            'tax_no' => $request->tax_no,
            'country' => $request->country, // Use country_id instead of country
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'status' => $request->status,
        ]);
        
        return response()->json(['success' => 'Supplier added successfully!']);
        
    }

   
    public function list(Request $request)
    {
        // Get suppliers with their country information
        $suppliers = Supplier::with('country')->get(); // Eager load the country relationship

        // Map the suppliers to include the country name
        $suppliers = $suppliers->map(function ($supplier) {
            // Retrieve the country name based on the country_id
            $country = Country::where('id', $supplier->country)->first(); // Get the country based on the supplier's country
            
            return [
                'id' => $supplier->id,
                'name' => $supplier->name,
                'address' => $supplier->address,
                'tax_no' => $supplier->tax_no,
                'country' => $supplier->country, // Keep the original country
                'country_name' => $country ? $country->country_name : null, // Add country name if it exists
                'mobile_no' => $supplier->mobile_no,
                'email' => $supplier->email,
                'status' => $supplier->status,
            ];
        });

        return response()->json($suppliers);
    }


    public function edit($id)
    {
        $supplier = Supplier::find($id);
    
        if (!$supplier) {
            return response()->json(['error' => 'Supplier not found'], 404);
        }
    
        return response()->json($supplier); // Return supplier data as JSON
    }
    

     public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tax_no' => 'required|string|max:255',
            'country' => 'required|integer|exists:countries,id', // Validate country as country_id
            'mobile_no' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'status' => 'required|in:Active,Inactive,Blocked',
        ]);

        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['error' => 'Supplier not found'], 404);
        }

        // Update only the required fields manually
        $supplier->update([
            'name' => $request->name,
            'address' => $request->address,
            'tax_no' => $request->tax_no,
            'country' => $request->country, // Save country as country_id
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        return response()->json(['success' => 'Supplier updated successfully!']);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['error' => 'Supplier not found'], 404);
        }

        $supplier->delete();

        return response()->json(['success' => 'Supplier deleted successfully!']);
    }



}
