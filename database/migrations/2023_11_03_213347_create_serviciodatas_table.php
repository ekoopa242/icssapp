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
        Schema::create('serviciodatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained();
            $table->string('service_port');
            $table->string('OLT_port');
            $table->string('ONT_ID');
            $table->string('PPPOE');
            $table->string('SN');
            $table->string('VLAN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_data');
    }
};
