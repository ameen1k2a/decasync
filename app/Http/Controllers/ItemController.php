<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\StockUnit;
class ItemController extends Controller
{
    public function index()
    {
        // Fetch suppliers from the database
        $suppliers = Supplier::all();
        $stockUnits = StockUnit::all(); // Fetch stock units
    
        // Pass the suppliers and stockUnits to the view
        return view('items', compact('suppliers', 'stockUnits'));
    
    }

    public function list()
    {
        $items = Item::with(['supplier', 'stockUnit']) // Eager load supplier and stock unit relationships
            ->select('items.*') // Select all columns from the items table
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'inventory_location' => $item->inventory_location,
                    'brand' => $item->brand,
                    'category' => $item->category,
                    'supplier_name' => $item->supplier ? $item->supplier->name : null, // Get supplier name
                    'stock_unit_name' => $item->stockUnit ? $item->stockUnit->name : null, // Get stock unit name
                    'unit_price' => $item->unit_price,
                    'status' => $item->status,
                ];
            });

        return response()->json($items);
    }


    public function store(Request $request)
    {
       // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'inventory_location' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock_unit' => 'required|exists:stock_units,id',
            'unit_price' => 'required|numeric|min:0',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'status' => 'required|in:Enabled,Disabled',
        ]);

        $item = Item::create($request->all());

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                // Store each image and get the path
                $path = $image->store('item_images', 'public'); 
                $item->images()->create(['path' => $path]);
            }
        }

        return response()->json(['success' => 'Item added successfully!', 'item' => $item]);
    }

    
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'inventory_location' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock_unit' => 'required|exists:stock_units,id',
            'unit_price' => 'required|numeric|min:0',
            'status' => 'required|in:Enabled,Disabled',
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return response()->json(['success' => 'Item updated successfully!', 'item' => $item]);
    }

   
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json(['success' => 'Item deleted successfully!']);
    }


    public function getItemsBySupplier($supplierId)
    {
        $items = Item::where('supplier_id', $supplierId)
                     ->join('stock_units', 'items.stock_unit', '=', 'stock_units.id') // Joining stock_units table
                     ->select('items.*', 'stock_units.name as stock_unit_name') // Selecting all items columns + stock unit name
                     ->get();
        
        return response()->json(['items' => $items]);
    }
    
    

}
