<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\CountryController;


Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index');
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/purchases', [PurchaseOrderController::class, 'index'])->name('purchases.index');

Route::post('/suppliers_add', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('/suppliers_list', [SupplierController::class, 'list'])->name('suppliers.list');
Route::get('/suppliers_edit/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
Route::put('/suppliers_update/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::delete('/suppliers_delete/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
Route::get('/countries', [CountryController::class, 'index']);


Route::get('/items_list', [ItemController::class, 'list'])->name('items.list'); // For DataTable ajax
Route::post('/items_add', [ItemController::class, 'store'])->name('items.store');
Route::get('/items_edit/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items_update/{id}', [ItemController::class, 'update'])->name('items.update');
Route::delete('/items_delete/{id}', [ItemController::class, 'destroy'])->name('items.destroy');


// web.php
Route::get('/get-items-by-supplier/{supplierId}', [ItemController::class, 'getItemsBySupplier']);
Route::post('/purchase_orders', [PurchaseOrderController::class, 'store'])->name('purchase_orders.store');
Route::get('/purchase_list', [PurchaseOrderController::class, 'purchase_orders'])->name('purchases.list');
Route::get('/purchase_list_view', [PurchaseOrderController::class, 'list'])->name('purchases.list_view');
Route::get('/invoices/{id}', [PurchaseOrderController::class, 'show'])->name('invoices.show');

Route::get('/purchase/export/{id}', [PurchaseOrderController::class, 'export'])->name('purchase.export');
Route::delete('/purchases/{id}', [PurchaseOrderController::class, 'destroy'])->name('purchases.destroy');
