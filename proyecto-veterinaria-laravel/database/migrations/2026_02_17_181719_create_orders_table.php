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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->string('guest_name');
            $table->string('guest_email');
            $table->decimal('total', 10, 2);
            $table->string('status')->default('completed'); // for mock gateway, usually completed immediately
            $table->json('items'); // Storing simplified items for now
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
