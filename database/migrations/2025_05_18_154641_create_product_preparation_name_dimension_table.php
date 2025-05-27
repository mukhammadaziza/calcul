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
        Schema::create('product_preparation_name_dimension', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preparation_name_id')->constrained(table: 'product_preparations_names');
            $table->foreignId('product_dimension_id')->constrained(table: 'product_preparations_dimensions');
            $table->decimal('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_preparation_name_dimension');
    }
};
