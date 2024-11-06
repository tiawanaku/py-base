<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('matricula')->nullable(); // Matrícula del vehículo
            $table->string('partida')->nullable(); // Número de partida
            $table->string('nro')->nullable(); // Número
            $table->boolean('reposicion')->default(false); // Si es reposición
            $table->string('actualizacion')->nullable(); // Fecha de actualización
            $table->boolean('cambio_a_matricula')->default(false); // Si hay cambio a matrícula
            $table->boolean('cambio_de_razon_social')->default(false); // Si hay cambio de razón social
            $table->boolean('cambio_de_jurisdiccion')->default(false); // Si hay cambio de jurisdicción
            $table->boolean('solicitud_de_transferencia')->default(false); // Si hay solicitud de transferencia
            $table->string('otros')->nullable(); // Otros detalles
            $table->string('nro_testimonio')->nullable(); // Número de testimonio
            $table->string('nro_notaria')->nullable(); // Número de notaría
            $table->string('notario')->nullable(); // Nombre del notario
            $table->string('distrito_judicial')->nullable(); // Distrito judicial
            $table->string('testimonio_de')->nullable(); // Testimonio de
            $table->boolean('2do_traslado')->default(false); // Si es un segundo traslado
            $table->string('otro')->nullable(); // Otro campo

            $table->string('superficie_total')->nullable(); // Superficie total
            $table->string('superficie_restante')->nullable(); // Superficie restante
            $table->string('notaria_de_fe_publica')->nullable(); // Notaría de fe pública
            $table->string('notaria_de_gobierno')->nullable(); // Notaría de gobierno
            $table->string('ley_municipal')->nullable(); // Ley municipal
            $table->boolean('adjudicacion')->default(false); // Si es adjudicación
            $table->boolean('expropiacion')->default(false); // Si es expropiación
            $table->boolean('cesion_de_areas')->default(false); // Si es cesión de áreas
            $table->string('ubicacion_denominacion_anterior')->nullable(); // Ubicación anterior
            $table->string('actual_denominacion')->nullable(); // Denominación actual
            $table->string('codigo_catastral')->nullable(); // Código catastral
            $table->boolean('equipamiento')->default(false); // Si tiene equipamiento
            $table->boolean('area_verde')->default(false); // Si tiene área verde
            $table->boolean('vias')->default(false); // Si tiene vías
            $table->boolean('global')->default(false); // Si es global
            $table->boolean('individual')->default(false); // Si es individual
            $table->boolean('si')->default(false); // Si es sí
            $table->boolean('no')->default(false); // Si es no
            $table->text('otras_descripciones')->nullable(); // Otras descripciones
            $table->text('distrito_municipal')->nullable(); // Distrito municipal

            // Nuevos campos añadidos para la localización
            $table->decimal('latitude', 10, 8)->nullable(); // Coordenada de latitud
            $table->decimal('longitude', 11, 8)->nullable(); // Coordenada de longitud
            $table->json('description')->nullable(); // Campo para almacenar datos en formato JSON (GeoJSON)

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}
