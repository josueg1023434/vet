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
        Schema::create('insumos_procedimientos', function (Blueprint $table) {
            $table->id('id_insumo_procedimiento');  // Clave primaria personalizada para la tabla intermedia
            $table->unsignedBigInteger('id_procedimiento');  // Clave foránea que hace referencia a 'procedimientos'
            $table->unsignedBigInteger('id_insumo');  // Clave foránea que hace referencia a 'insumos'
            
            // Establece las relaciones entre las tablas y define la acción al eliminar un registro relacionado
            $table->foreign('id_procedimiento')
                  ->references('id_procedimiento')
                  ->on('procedimientos')
                  ->onDelete('cascade');
                  
            $table->foreign('id_insumo')
                  ->references('id_insumo')
                  ->on('insumos')
                  ->onDelete('cascade');
            
            $table->timestamps();  // Agrega timestamps para registrar la creación y actualización de los registros
        });
    }

    /**
     * Reverse the migrations.
     */
};
