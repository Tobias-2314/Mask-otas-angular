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
        Schema::create('historial_medicos', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('mascota_id')->constrained('mascotas')->onDelete('cascade');
            $table->foreignUuid('usuario_id')->constrained('usuarios'); // Quién registró el evento (Vet/Admin)
            $table->string('tipo'); // Vacuna, Cirugía, Consulta, Nota
            $table->text('descripcion');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_medicos');
    }
};
