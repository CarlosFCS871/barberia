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
        Schema::create('servicios', function (Blueprint $table) {
             $table->id();

            // BARBERO
            $table->foreignId('barbero_id')->constrained('users')->cascadeOnDelete();

            // INFORMACIÓN
            $table->string('nombre');

            $table->text('descripcion');

            $table->decimal('precio', 8, 2);

            $table->string('imagen')->nullable();

            // ESTADO
            $table->enum('estado', ['activo','inactivo'])->default('activo');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
