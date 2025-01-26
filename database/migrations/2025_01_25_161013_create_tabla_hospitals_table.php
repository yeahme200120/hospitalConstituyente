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
        Schema::create('tabla_hospitals', function (Blueprint $table) {
            $table->id();
            $table->string("paciente");
            $table->integer("id_paciente");
            $table->date("fecha");
            $table->time("hora");
            $table->string("servicio");
            $table->integer("id_servicio");
            $table->string("estatus");
            $table->integer("id_estatus");
            $table->string("cama");
            $table->integer("id_cama");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_hospitals');
    }
};
