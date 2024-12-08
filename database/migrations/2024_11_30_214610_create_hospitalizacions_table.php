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
            $table->integer("paciente_id");
            $table->string("medicamento");
            $table->string("dosis_max",8,2);
            $table->string("dosis_administrada");
            $table->integer("id_via_administracion");
            $table->string("intervalo");
            $table->string("servicio");
            $table->time("horario");
            $table->bigInteger("diaInicio");
            $table->string("mesInicio");
            $table->bigInteger("anioInicio");
            $table->bigInteger("diaTermino")->nullable();
            $table->string("mesTermino")->nullable();
            $table->bigInteger("anioTermino")->nullable();
            $table->string("intervencion");
            $table->string("interacciones");
            $table->string("contraindicaciones");
            $table->string("recomendacion");
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
