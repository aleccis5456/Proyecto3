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
        Schema::create('banner_position', function (Blueprint $table) {
            $table->id();            
            $table->string('category'); // Nombre de la categoría (ej. 'informatica', 'ropa')
            $table->string('position'); // Posición del banner (ej. 'top', 'mid', 'bottom', 'left', 'right')
            $table->string('image_path'); // Ruta de la imagen para el banner
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_position');
    }
};
