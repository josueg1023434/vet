<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasProcedimientosInsumosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas_procedimientos_insumos', function (Blueprint $table) {
            $table->id('id_cita_procedimiento_insumo');  // Clave primaria para la tabla intermedia
            $table->unsignedBigInteger('id_cita');  // Clave foránea que hace referencia a 'citas'
            $table->unsignedBigInteger('id_insumo_procedimiento');  // Clave foránea que hace referencia a 'insumos_procedimientos'
            
            // Establece las relaciones de clave foránea con las acciones correspondientes al eliminar registros
            $table->foreign('id_cita')
                  ->references('id_cita')
                  ->on('citas')
                  ->onDelete('cascade');
                  
            $table->foreign('id_insumo_procedimiento')
                  ->references('id_insumo_procedimiento')
                  ->on('insumos_procedimientos')
                  ->onDelete('cascade');
            
            $table->timestamps();  // Agrega los campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
}
