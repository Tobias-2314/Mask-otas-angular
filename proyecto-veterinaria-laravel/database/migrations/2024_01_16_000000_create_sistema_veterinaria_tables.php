<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Usuarios
        Schema::create('usuarios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contrasena'); // password
            $table->rememberToken();
            $table->timestamps();
        });

        // Citas
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('usuario_id')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->string('nombre_dueno');
            $table->string('email');
            $table->string('telefono');
            $table->string('nombre_mascota');
            $table->string('tipo_mascota');
            $table->string('tipo_servicio');
            $table->date('fecha_preferida');
            $table->string('hora_preferida');
            $table->text('notas')->nullable();
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });

        // Reseñas
        Schema::create('resenas', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('usuario_id')->constrained('usuarios')->cascadeOnDelete();
            $table->integer('calificacion');
            $table->text('comentario');
            $table->boolean('aprobado')->default(false);
            $table->timestamps();
        });

        // Sesiones (Requerido por Laravel)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUuid('user_id')->nullable()->index(); // Debería apuntar a usuarios? Laravel auth busca 'user_id'. 
            // Para simplificar, usaremos user_id string para UUID.
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resenas');
        Schema::dropIfExists('citas');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('sessions');
    }
};
