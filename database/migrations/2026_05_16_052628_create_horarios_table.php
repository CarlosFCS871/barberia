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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();

            // BARBERO
            $table->foreignId('barbero_id')->constrained('users')->cascadeOnDelete();
            // DÍA
            $table->enum('dia', ['lunes','martes','miercoles','jueves','viernes','sabado','domingo']);

            // HORAS
            $table->time('hora_inicio');

            $table->time('hora_fin');

            // ESTADO
            $table->enum('estado', ['disponible','descanso'])->default('disponible');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
