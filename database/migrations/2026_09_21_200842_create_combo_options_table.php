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
        Schema::create('combo_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('combo_id')->constrained('products')->onDelete('cascade');
            $table->string('step_name', 100);
            $table->foreignId('option_product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_options');
    }
};
