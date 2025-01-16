<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones para crear las tablas necesarias para el sistema de roles y permisos.
     */
    public function up(): void
    {
        // Obtener las configuraciones desde el archivo config/permission.php
        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

        // Validación de configuración cargada correctamente
        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        // Validación si se usa equipos (teams)
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        // Crear la tabla "permissions" para almacenar los permisos del sistema
        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            //$table->engine('InnoDB'); // Descomentar para asegurar uso de InnoDB en MySQL
            $table->bigIncrements('id'); // ID único del permiso
            $table->string('name');       // Nombre del permiso
            $table->string('guard_name'); // Nombre del guard (por ejemplo: 'web', 'api')
            $table->timestamps();        // Tiempos de creación y actualización

            $table->unique(['name', 'guard_name']); // Unicidad combinada para evitar permisos duplicados con el mismo nombre y guard
        });

        // Crear la tabla "roles" para almacenar los roles del sistema
        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
            //$table->engine('InnoDB'); // Descomentar para asegurar uso de InnoDB en MySQL
            $table->bigIncrements('id'); // ID único del rol
            if ($teams || config('permission.testing')) { // Si se usan equipos o en modo testing con SQLite
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable(); // Clave foránea para equipos (si aplica)
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index'); // Índice para equipo
            }
            $table->string('name');       // Nombre del rol
            $table->string('guard_name'); // Nombre del guard
            $table->timestamps();        // Tiempos de creación y actualización

            // Unicidad combinada para roles con equipo y guard
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        // Crear la tabla "model_has_permissions" que asocia los permisos con los modelos (usuarios, etc.)
        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
            $table->unsignedBigInteger($pivotPermission); // Clave foránea al permiso

            $table->string('model_type'); // Tipo de modelo (ej: User, Admin)
            $table->unsignedBigInteger($columnNames['model_morph_key']); // Clave foránea al modelo
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index'); // Índice de relación

            $table->foreign($pivotPermission)
                ->references('id') // Relación con permisos
                ->on($tableNames['permissions'])
                ->onDelete('cascade'); // Eliminación en cascada

            // Si se usan equipos (teams), agregar equipo a la relación
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index'); // Índice de equipo

                // Primary key con relación a equipo, permiso y modelo
                $table->primary([$columnNames['team_foreign_key'], $pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                // Primary key sin relación a equipo
                $table->primary([$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }
        });

        // Crear la tabla "model_has_roles" que asocia los roles con los modelos
        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotRole, $teams) {
            $table->unsignedBigInteger($pivotRole); // Clave foránea al rol

            $table->string('model_type'); // Tipo de modelo (ej: User, Admin)
            $table->unsignedBigInteger($columnNames['model_morph_key']); // Clave foránea al modelo
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index'); // Índice de relación

            $table->foreign($pivotRole)
                ->references('id') // Relación con roles
                ->on($tableNames['roles'])
                ->onDelete('cascade'); // Eliminación en cascada

            // Si se usan equipos (teams), agregar equipo a la relación
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index'); // Índice de equipo

                // Primary key con relación a equipo, rol y modelo
                $table->primary([$columnNames['team_foreign_key'], $pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                // Primary key sin relación a equipo
                $table->primary([$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        // Crear la tabla "role_has_permissions" que asocia los roles con los permisos
        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames, $pivotRole, $pivotPermission) {
            $table->unsignedBigInteger($pivotPermission); // Clave foránea al permiso
            $table->unsignedBigInteger($pivotRole); // Clave foránea al rol

            $table->foreign($pivotPermission)
                ->references('id') // Relación con permisos
                ->on($tableNames['permissions'])
                ->onDelete('cascade'); // Eliminación en cascada

            $table->foreign($pivotRole)
                ->references('id') // Relación con roles
                ->on($tableNames['roles'])
                ->onDelete('cascade'); // Eliminación en cascada

            // Primary key con la combinación de permiso y rol
            $table->primary([$pivotPermission, $pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        // Limpiar la caché de permisos después de crear las tablas
        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Revierte las migraciones eliminando las tablas creadas.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        // Validación de que las configuraciones estén cargadas antes de proceder
        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        // Eliminar las tablas en orden inverso para mantener las dependencias
        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
};
