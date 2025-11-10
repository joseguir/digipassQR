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
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            
              // Entrada que se transfiere
            $table->foreignId('entrada_id')
                ->constrained()
                ->onDelete('cascade');

            // Usuario que envía
            $table->foreignId('remitente_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Usuario que recibe
            $table->foreignId('receptor_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Estado de la transferencia
            $table->enum('estado', ['pendiente', 'aceptada', 'rechazada'])
                ->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transferencias');
    }
};
