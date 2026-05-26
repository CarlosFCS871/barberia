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
        Schema::create('promociones', function (Blueprint $table) {
            $table->id();

            // BARBERO
            $table->foreignId('barbero_id')->constrained('users')->cascadeOnDelete();

            // INFORMACIÓN
            $table->string('nombre');

            $table->text('descripcion');

            $table->string('imagen')->nullable();

            // DESCUENTO
            $table->decimal('descuento', 5, 2);

            // FECHAS
            $table->date('fecha_inicio');

            $table->date('fecha_fin');

            // ESTADO
            $table->enum('estado', ['activa','inactiva','finalizada'])->default('activa');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};
