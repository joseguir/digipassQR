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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id'); // FK al evento
            $table->string('nombre');                // Ej: VIP, General
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->date('fecha_inicio')->nullable(); // fecha desde la que el lote está disponible
            $table->date('fecha_fin')->nullable();  
            $table->timestamps();

            $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
