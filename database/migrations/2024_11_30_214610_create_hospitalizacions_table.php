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
        Schema::create('hospitalizacions', function (Blueprint $table) {
            $table->id();
            $table->integer("id_paciente");
            $table->string("medicamento");
            $table->string("dosis_max",8,2);
            $table->string("dosis_administrada");
            $table->integer("id_via_administracion");
            $table->string("intervalo");
            $table->time("horario");
            $table->date("fecha_inicio");
            $table->date("fecha_termino")->nullable();
            $table->boolean("duplicidad");
            $table->boolean("intervencion");
            $table->boolean("acepatcion");
            $table->string("interacciones");
            $table->string("contraindicaciones");
            $table->string("recomendacion");
            $table->string("intervencion_text");
            $table->string("otros");
            $table->string("accion_tomada");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitalizacions');
    }
};
