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
        /* Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        }); */

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id(); // Supplier No (auto-generated)
            $table->string('name');
            $table->string('address');
            $table->string('tax_no');
            $table->integer('country');
            $table->string('mobile_no');
            $table->string('email');
            $table->enum('status', ['Active', 'Inactive', 'Blocked'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
