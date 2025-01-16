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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id('id_mascota');  // Clave primaria personalizada para la mascota
            $table->unsignedBigInteger('id_usuario');  // ID de usuario relacionado
            $table->string('nombre_mascota', 100);  // Nombre de la mascota
            $table->string('raza_mascota', 100);  // Raza de la mascota
            $table->string('color_mascota', 100);  // Color de la mascota
            $table->decimal('peso_mascota', 5, 2)->nullable();  // Peso de la mascota (opcional)
            $table->date('fecha_mascota');  // Fecha de nacimiento o ingreso de la mascota
            $table->string('foto_mascota', 255)->nullable();  // Foto de la mascota (opcional)
            
            // Establecer la clave foránea con `onDelete('cascade')` para eliminar las mascotas asociadas cuando el usuario se elimina
            $table->foreign('id_usuario')
                ->references('id_usuario')  // Hace referencia a la columna id_usuario en la tabla usuarios
                ->on('users')  // Tabla usuarios
                ->onDelete('cascade');  // Cuando se elimina un usuario, también se eliminan sus mascotas asociadas

            // Timestamps: Para saber cuándo se creó o actualizó la mascota
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
};
