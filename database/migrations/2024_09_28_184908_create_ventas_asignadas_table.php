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
        Schema::create('ventas_asignadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendedor_id');
            $table->unsignedBigInteger('pedido_id')->unique();

            $table->foreign('vendedor_id')->references('id')->on('vendedores')->cascadeOnDelete();
            $table->foreign('pedido_id')->references('id')->on('pedidos')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas_asignadas');
    }
};
