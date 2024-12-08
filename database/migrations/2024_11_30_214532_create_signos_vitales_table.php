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
        Schema::create('signos_vitales', function (Blueprint $table) {
            $table->id();
            $table->integer("paciente_id");
            $table->string("frecuencia_cardiaca",8,2);
            $table->string("tension_arterial");
            $table->string("pulso");
            $table->integer("temperatura");
            $table->integer("frecuencia_respiratoria");
            $table->string("oxigenacion");
            $table->float("peso",8,2);
            $table->float("talla",8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signos_vitales');
    }
};
