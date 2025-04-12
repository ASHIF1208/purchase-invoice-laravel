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
        Schema::create('purchase_mains', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('category_name');
            $table->string('supplier_name');
            $table->decimal('gross_total', 10, 2);
            $table->decimal('transport_frieght', 10, 2)->default(0);
            $table->decimal('loading_unloading_amount', 10, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2)->storedAs('gross_total + transport_frieght + loading_unloading_amount + tax_amount');
            $table->tinyInteger('status')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_main');
    }
};
