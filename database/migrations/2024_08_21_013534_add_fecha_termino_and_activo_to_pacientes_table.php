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
        Schema::table('pacientes', function (Blueprint $table) {
            $table->timestamp('fecha_termino')->nullable(); // Campo para la fecha de término del tratamiento
            $table->boolean('activo')->default(true); // Campo para indicar si el paciente está activo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn('fecha_termino');
            $table->dropColumn('activo');
        });
    }
};