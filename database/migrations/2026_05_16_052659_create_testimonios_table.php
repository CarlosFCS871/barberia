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
        Schema::create('testimonios', function (Blueprint $table) {
            $table->id();

            // CLIENTE
            $table->foreignId('cliente_id')->constrained('users')->cascadeOnDelete();

            // TESTIMONIO
            $table->text('comentario');

            $table->integer('calificacion');

            // ESTADO
            $table->enum('estado', ['pendiente','aprobado','rechazado'])->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonios');
    }
};
