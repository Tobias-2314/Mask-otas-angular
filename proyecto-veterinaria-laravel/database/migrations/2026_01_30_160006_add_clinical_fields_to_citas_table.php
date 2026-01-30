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
        Schema::table('citas', function (Blueprint $table) {
            $table->foreignUuid('mascota_id')->nullable()->constrained('mascotas')->nullOnDelete()->after('usuario_id');
            $table->foreignUuid('veterinario_id')->nullable()->constrained('usuarios')->nullOnDelete()->after('mascota_id');
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('notas_internas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            //
        });
    }
};
