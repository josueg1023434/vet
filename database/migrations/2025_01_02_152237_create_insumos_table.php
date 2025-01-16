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
        Schema::create('insumos', function (Blueprint $table) {
            $table->id('id_insumo');  // Clave primaria personalizada para el insumo
            $table->string('nombre_insumo', 150);  // Nombre del insumo con una longitud máxima de 150 caracteres
            $table->integer('cantidad');  // Cantidad disponible del insumo (puedes agregar validaciones para valores positivos)
            
            // Timestamps: para almacenar las fechas de creación y actualización del insumo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
};
