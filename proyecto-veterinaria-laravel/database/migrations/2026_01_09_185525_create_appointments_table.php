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
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('owner_name');
            $table->string('email');
            $table->string('phone');
            $table->string('pet_name');
            $table->string('pet_type');
            $table->string('service_type');
            $table->date('preferred_date');
            $table->string('preferred_time');
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->foreignUuid('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
