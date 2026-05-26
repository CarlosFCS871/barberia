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
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();

            // CLIENTE OPCIONAL
            $table->foreignId('cliente_id')->nullable()->constrained('users')->nullOnDelete();

            // DATOS
            $table->string('nombre');

            $table->string('correo');

            $table->string('telefono')->nullable();

            $table->text('mensaje');

            // ESTADO
            $table->enum('estado', ['pendiente','respondido','cerrado'])->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};
