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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('cedula',13)->unique();
            $table->timestamp('cedula_verified_at')->nullable();
            $table->string('telefono', 10);
            $table->string('direccion', 200);
            $table->string('email', 150);
            $table->string('nombre', 150);
            $table->string('apellido', 150);
            $table->string('password');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->rememberToken();
            $table->timestamps();
        });

        // Tabla 'password_reset_tokens' para restablecer contraseñas
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('cedula')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabla 'sessions' para registrar las sesiones
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();  // Identificador único de la sesión
            $table->foreignId('user_id')->nullable()->index();  // Relación con la tabla de usuarios
            $table->string('ip_address', 45)->nullable();  // Dirección IP de la sesión
            $table->text('user_agent')->nullable();  // Agente de usuario (información del navegador)
            $table->longText('payload');  // Información de la sesión
            $table->integer('last_activity')->index();  // Última actividad (timestamp)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
