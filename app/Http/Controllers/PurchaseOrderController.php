<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use App\Models\Item;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class PurchaseOrderController extends Controller
{
    public function index()
    {
       
        $orderNo = 'PO' . str_pad(PurchaseOrder::max('id') + 1, 6, '0', STR_PAD_LEFT);

        // Fetch all active suppliers
        $suppliers = Supplier::where('status', 'Active')->get();


        return view('purchase_order', compact('orderNo', 'suppliers'));
    }

    public function store(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'order_no' => 'required|unique:purchase_orders',
            'order_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'items' => 'required|array',
            'items.*.id' => 'required',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.discount' => 'required',
            'items.*.net_amount' => 'required',
            'items.*.packing_unit' => 'required',
            // Additional fields can be validated as needed
        ]);

        // Create the Purchase Order
        $purchaseOrder = PurchaseOrder::create([
            'order_no' => $validatedData['order_no'],
            'order_date' => $validatedData['order_date'],
            'supplier_id' => $validatedData['supplier_id'],
            'item_total' => $request->input('item_total'),
            'discount' => $request->input('discount'),
            'net_amount' => $request->input('net_amount'),
        ]);

        // Save the line items
        foreach ($validatedData['items'] as $itemData) {
            PurchaseOrderItem::create([
                'purchase_order_id' => $purchaseOrder->id,
                'item_id' => $itemData['id'],
                'order_qty' => $itemData['quantity'],
                'unit_price' => $itemData['unit_price'],
                'discount' => $itemData['discount'],
                'item_amount' => $itemData['unit_price'] * $itemData['quantity'],
                'net_amount' => $itemData['net_amount'],
                'packing_unit' => $itemData['packing_unit'],
            ]);
        }

        return response()->json(['message' => 'Purchase order submitted successfully!'], 200);
    }

    public function purchase_orders(){
        return view('purchase_list');
    }
    
    public function list()
    {
        $countries = PurchaseOrder::all();
        return response()->json($countries);
    }

    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::with(['items' => function ($query) {
            $query->with(['item' => function ($subQuery) {
                $subQuery->select('id', 'name'); // Select only the id and name from the items table
            }]);
        }])->where('id', $id)->firstOrFail();

        // Filter items where item_id matches the purchase order items
        $purchaseOrder->items = $purchaseOrder->items->map(function ($orderItem) {
            $orderItem->item_name = $orderItem->item->where('id', $orderItem->item_id)->first()->name ?? null; 
            return $orderItem;
        });

        // Pass the purchase order data to the invoice view
        return view('invoice', compact('purchaseOrder'));
    }

    public function export($id)
    {
        //$purchaseOrder = PurchaseOrder::with(['items'])->findOrFail($id);

        $purchaseOrder = PurchaseOrder::with(['items' => function ($query) {
            $query->with(['item' => function ($subQuery) {
                $subQuery->select('id', 'name'); // Select only the id and name from the items table
            }]);
        }])->where('id', $id)->firstOrFail();

        // Filter items where item_id matches the purchase order items
        $purchaseOrder->items = $purchaseOrder->items->map(function ($orderItem) {
            $orderItem->item_name = $orderItem->item->where('id', $orderItem->item_id)->first()->name ?? null; 
            return $orderItem;
        });

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headers
        $sheet->setCellValue('A1', 'Item');
        $sheet->setCellValue('B1', 'Quantity');
        $sheet->setCellValue('C1', 'Unit Cost');
        $sheet->setCellValue('D1', 'Total');

        // Add data to the sheet
        $row = 2; // Start from the second row
        foreach ($purchaseOrder->items as $item) {
            $sheet->setCellValue('A' . $row, $item->item_name);
            $sheet->setCellValue('B' . $row, $item->order_qty);
            $sheet->setCellValue('C' . $row, $item->unit_price);
            $sheet->setCellValue('D' . $row, $item->order_qty * $item->unit_price);
            $row++;
        }

        // Set file name and download it
        $fileName = 'Invoice_' . $purchaseOrder->order_no . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }

    public function destroy($id)
    {
        // Find the purchase order
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        // First, delete all related purchase order items
        $purchaseOrder->items()->delete();

        // Then, delete the purchase order itself
        $purchaseOrder->delete();

        return response()->json(['success' => true]);
    }



    

}
