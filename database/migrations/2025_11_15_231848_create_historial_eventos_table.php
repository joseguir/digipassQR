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
        Schema::create('historial_eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Quien realiza la acción
            $table->foreignId('usuario_destino_id')->nullable()->constrained('users')->onDelete('set null'); // Solo para transferencias
            $table->foreignId('evento_id')->constrained()->onDelete('cascade'); // Evento relacionado
            $table->integer('cantidad')->default(1); // Cantidad de entradas afectadas
            $table->string('tipo_accion'); // 'compra' o 'transferencia'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_eventos');
    }
};
