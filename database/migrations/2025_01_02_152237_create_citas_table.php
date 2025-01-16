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
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita');  // Clave primaria de la cita
            $table->unsignedBigInteger('id_mascota');  // Relación con la mascota
            $table->dateTime('fecha_hora');  // Fecha y hora de la cita
            $table->enum('estado', ['Agendado', 'Cancelado', 'Cumplida'])->default('Agendado');  // Estado de la cita (por defecto 'Agendado')
            
            // Definición de la clave foránea para relacionar la cita con la mascota
            $table->foreign('id_mascota')
                ->references('id_mascota')  // Columna de la tabla 'mascotas' que se referencia
                ->on('mascotas')  // Tabla de mascotas
                ->onDelete('cascade');  // Si se elimina una mascota, también se eliminarán las citas asociadas

            $table->timestamps();  // Timestamps para seguimiento de la creación y actualización de la cita
        });
    }

    /**
     * Reverse the migrations.
     */
};
