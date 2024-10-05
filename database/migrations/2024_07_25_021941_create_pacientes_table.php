<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('rol')->unique();
            $table->string('nombre');
            $table->integer('edad');
            $table->string('rut');
            $table->string('prevision');
            $table->string('cama_hospitalizacion');
            $table->string('diagnostico');
            $table->string('cirujano');
            $table->string('cirugia');
            $table->string('tratamiento_modalidad')->nullable();
            $table->string('tratamiento_medicamento')->nullable();
            $table->string('tipo_bloqueo')->nullable();
            $table->json('factores_riesgo')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Añade este campo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
