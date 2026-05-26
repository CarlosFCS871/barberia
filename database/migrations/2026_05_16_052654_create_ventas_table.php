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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            // CITA
            $table->foreignId('cita_id')->constrained('citas')->cascadeOnDelete();

            // CLIENTE
            $table->foreignId('cliente_id')->constrained('users')->cascadeOnDelete();

            // BARBERO
            $table->foreignId('barbero_id')->constrained('users')->cascadeOnDelete();

            // TOTAL
            $table->decimal('total', 8, 2);

            // MÉTODO PAGO
            $table->enum('metodo_pago', ['efectivo','yape','plin','tarjeta']);

            // ESTADO
            $table->enum('estado_pago', ['pendiente','pagado','anulado'])->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
