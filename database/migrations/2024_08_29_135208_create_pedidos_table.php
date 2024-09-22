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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->unsignedBigInteger('user_id');            
            $table->string('departamento');
            $table->string('ciudad');
            $table->string('calle');
            $table->integer('coste');
            $table->string('estado');
            $table->string('formaEntrega');
            $table->string('costoEnvio');
            $table->string('formaPago');
            $table->dateTime('registro');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
