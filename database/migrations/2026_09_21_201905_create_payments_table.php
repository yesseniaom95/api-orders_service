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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('restrict');
            $table->foreignId('cash_register_id')->constrained('cash_registers')->onDelete('restrict');
            $table->enum('payment_method', ['efectivo', 'tarjeta', 'transferencia'])->default('efectivo');
            $table->decimal('amount_paid', 10, 2);
            $table->decimal('tip', 10, 2)->default(0.00);
            $table->timestamp('paid_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
