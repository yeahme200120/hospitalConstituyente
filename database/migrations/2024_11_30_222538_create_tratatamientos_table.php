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
        Schema::create('tratatamientos', function (Blueprint $table) {
            $table->id();
            $table->integer("paciente_id");
            $table->integer("id_medico");
            $table->string("diagnostico_agregado");
            $table->string("diagnostico_egreso");
            $table->string("laboratorios");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratatamientos');
    }
};
