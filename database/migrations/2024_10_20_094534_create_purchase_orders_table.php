<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       /*  Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        }); */

        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id(); // Order No (auto-generated)
            $table->string('order_no')->unique();
            $table->date('order_date');
            $table->foreignId('supplier_id')->constrained('suppliers'); // Dropdown
            $table->decimal('item_total', 10, 2)->default(0); // readonly
            $table->decimal('discount', 10, 2)->default(0); // readonly
            $table->decimal('net_amount', 10, 2)->default(0); // readonly
            $table->timestamps();
        });

        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders');
            $table->foreignId('item_id')->constrained('items'); // Item No
            $table->integer('order_qty');
            $table->decimal('unit_price', 10, 2);
            $table->string('packing_unit');
            $table->decimal('item_amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
