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
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password', 255);
            $table->integer('celular');
            $table->boolean('activo');
            $table->string('departamento');
            $table->string('ciudad');
            $table->integer('ventas_asginadas')->default(0);
            $table->integer('ventas_completadas')->default(0);
            $table->datetime('registro');
            $table->string('registrado_por');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedores');
    }
};
