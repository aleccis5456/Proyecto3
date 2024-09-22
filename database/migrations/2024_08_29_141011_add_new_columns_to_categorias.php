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
        Schema::table('categorias', function (Blueprint $table) {
            $table->unsignedBigInteger('reg_por_adm_id');
            $table->dateTime('mod_fecha')->nullable();                    
            $table->unsignedBigInteger('modificado_por_adm_id')->nullable();     
            
            $table->foreign('reg_por_adm_id')->references('id')->on('administradores');
            $table->foreign('modificado_por_adm_id')->references('id')->on('administradores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
         
        });
    }
};
