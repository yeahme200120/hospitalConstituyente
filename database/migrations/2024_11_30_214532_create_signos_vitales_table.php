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
            $table->string("frecuencia_cardiaca");
            $table->string("tension_arterial");
            $table->string("temperatura");
            $table->string("frecuencia_respiratoria");
            $table->string("oxigenacion");
            $table->string("peso");
            $table->string("talla");
            $table->date("fecha");
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
