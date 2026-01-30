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
            $table->uuid('id')->primary();
            $table->foreignUuid('usuario_id')->constrained('usuarios')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('tipo'); // Perro, Gato, etc.
            $table->string('raza')->nullable();
            $table->integer('edad')->nullable(); // Años
            $table->decimal('peso', 5, 2)->nullable(); // kg
            $table->string('genero')->nullable(); // Macho, Hembra
            $table->text('notas_medicas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
