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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->foreignId('equipo_id')->constrained();
            $table->string('ssid');
            $table->string('password');
            $table->date('fecha_inicio');
            $table->date('fecha_vence');
            $table->double('preciototal', 8,2);
            $table->enum('estado', ['Autorizado', 'No Autorizado', 'Cancelado', 'Suspendido']);
            $table->string('referencia');
            $table->text('latitud');
            $table->text('longitud');
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
