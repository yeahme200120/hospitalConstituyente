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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->integer("paciente_id");
            $table->integer("ingreso_dia");
            $table->integer("ingreso_mes");
            $table->bigInteger("ingreso_año");
            $table->time("ingreso_hora");
            $table->string("diagnostico");
            $table->integer("id_servicio");
            $table->integer("id_cama");
            $table->date("fecha");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
