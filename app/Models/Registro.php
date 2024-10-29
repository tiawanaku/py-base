<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Solo si vas a usar soft deletes

class Registro extends Model
{
    use HasFactory; // Y SoftDeletes si es necesario

    protected $fillable = [
        'matricula', 'partida', 'nro', 'reposicion', 'actualizacion', 'cambio_a_matricula',
        'cambio_de_razon_social', 'cambio_de_jurisdiccion', 'solicitud_de_transferencia',
        'otros', 'nro_testimonio', 'nro_notaria', 'notario', 'distrito_judicial',
        'testimonio_de', '2do_traslado', 'otro', 'superficie_total',
        'superficie_restante', 'notaria_de_fe_publica', 'notaria_de_gobierno', 'ley_municipal',
        'adjudicacion', 'expropiacion', 'cesion_de_areas', 'ubicacion_denominacion_anterior',
        'actual_denominacion', 'codigo_catastral', 'equipamiento', 'area_verde', 'vias',
        'global', 'individual', 'si', 'no', 'otras_descripciones', 'distrito_municipal'
    ];

    // Ejemplo de relación
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
