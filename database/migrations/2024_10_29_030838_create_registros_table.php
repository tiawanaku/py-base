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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('matricula')->nullable();
            $table->string('partida')->nullable();
            $table->string('nro')->nullable();
            $table->boolean('reposicion')->default(false);
            $table->date('actualizacion')->nullable();
            $table->boolean('cambio_a_matricula')->default(false);
            $table->boolean('cambio_de_razon_social')->default(false);
            $table->boolean('cambio_de_jurisdiccion')->default(false);
            $table->boolean('solicitud_de_transferencia')->default(false);
            $table->string('otros')->nullable();
            $table->string('nro_testimonio')->nullable();
            $table->string('nro_notaria')->nullable();
            $table->string('notario')->nullable();
            $table->string('distrito_judicial')->nullable();
            $table->string('testimonio_de')->nullable();
            $table->boolean('2do_traslado')->default(false);
            $table->boolean('otro')->default(false);
            $table->decimal('superficie_total', 10, 2)->nullable();
            $table->decimal('superficie_restante', 10, 2)->nullable();
            $table->string('notaria_de_fe_publica')->nullable();
            $table->string('notaria_de_gobierno')->nullable();
            $table->string('ley_municipal')->nullable();
            $table->boolean('adjudicacion')->default(false);
            $table->boolean('expropiacion')->default(false);
            $table->boolean('cesion_de_areas')->default(false);
            $table->string('ubicacion_denominacion_anterior')->nullable();
            $table->string('actual_denominacion')->nullable();
            $table->string('codigo_catastral')->nullable();
            $table->boolean('equipamiento')->default(false);
            $table->boolean('area_verde')->default(false);
            $table->boolean('vias')->default(false);
            $table->boolean('global')->default(false);
            $table->boolean('individual')->default(false);
            $table->boolean('si')->default(false);
            $table->boolean('no')->default(false);
            $table->text('otras_descripciones')->nullable();
            $table->text('distrito_municipal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cambiar 'properties' por 'registros' aquí
        Schema::dropIfExists('registros');
    }
};
