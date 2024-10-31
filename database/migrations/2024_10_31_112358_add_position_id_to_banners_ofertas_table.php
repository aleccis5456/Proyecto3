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
        Schema::table('banners_ofertas', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id')->nullable()->after('id');
        
            // Si tienes una relación con la tabla `banner_position`, puedes agregar la clave foránea
            $table->foreign('position_id')->references('id')->on('banner_position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners_ofertas', function (Blueprint $table) {
            //
        });
    }
};
