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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();  //32
            $table->string('codigo')->unique(); //ei00921
            $table->unsignedBigInteger('subCategoria_id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('precio');
            $table->integer('stock_actual');
            $table->integer('stock_min');
            $table->integer('oferta')->default(0);
            $table->integer('precio_oferta')->nullable();
            $table->string('visible');
            $table->integer('ventas');
            $table->string('imagen');            
            $table->dateTime('registro');        
            
            $table->foreign('subCategoria_id')->references('id')->on('sub_categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
