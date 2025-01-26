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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->integer("id_paciente");
            $table->string("telefono");
            $table->integer("fecha_nac_dia");
            $table->integer("fecha_nac_mes");
            $table->bigInteger("fecha_nac_año");
            $table->integer("edad");
            $table->string("genero");
            $table->string("id_enfermedad_cronica");
            $table->string("alergias");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
