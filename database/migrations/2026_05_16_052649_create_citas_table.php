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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            // CLIENTE
            $table->foreignId('cliente_id')->constrained('users')->cascadeOnDelete();

            // BARBERO
            $table->foreignId('barbero_id')->constrained('users')->cascadeOnDelete();

            // SERVICIO
            $table->foreignId('servicio_id')->constrained('servicios')->cascadeOnDelete();

            // FECHA Y HORA
            $table->date('fecha');

            $table->time('hora');

            // ESTADO
            $table->enum('estado', ['pendiente','confirmada','cancelada','finalizada'])->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
