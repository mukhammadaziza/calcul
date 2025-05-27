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
        Schema::create('logistics_warehouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_type_id')->nullable()->constrained(table: 'work_types');
            $table->string('warehouse_name')->nullable();
            $table->integer('value_0')->nullable();
            $table->integer('value_1')->nullable();
            $table->integer('value_2')->nullable();
            $table->integer('value_3')->nullable();
            $table->integer('value_4')->nullable();
            $table->integer('value_5')->nullable();
            $table->integer('value_6')->nullable();
            $table->integer('value_7')->nullable();
            $table->integer('value_8')->nullable();
            $table->integer('value_9')->nullable();
            $table->integer('value_10')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistics_warehouses');
    }
};
