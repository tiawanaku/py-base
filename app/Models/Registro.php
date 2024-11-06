<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Solo si vas a usar soft deletes

class Registro extends Model
{
    use HasFactory; // Y SoftDeletes si es necesario

    // Definir las columnas que son asignables en masa
    protected $fillable = [
        'matricula', 'partida', 'nro', 'reposicion', 'actualizacion', 'cambio_a_matricula',
        'cambio_de_razon_social', 'cambio_de_jurisdiccion', 'solicitud_de_transferencia',
        'otros', 'nro_testimonio', 'nro_notaria', 'notario', 'distrito_judicial',
        'testimonio_de', '2do_traslado', 'otro', 'superficie_total',
        'superficie_restante', 'notaria_de_fe_publica', 'notaria_de_gobierno', 'ley_municipal',
        'adjudicacion', 'expropiacion', 'cesion_de_areas', 'ubicacion_denominacion_anterior',
        'actual_denominacion', 'codigo_catastral', 'equipamiento', 'area_verde', 'vias',
        'global', 'individual', 'si', 'no', 'otras_descripciones', 'distrito_municipal',
        'latitude', 'longitude', 'description', 'geojson' // Añadido 'geojson' y 'description'
    ];

    // Configuración de tipos de datos que se deben convertir automáticamente
    protected $casts = [
        'description' => 'array', // Decodificación automática de 'description' a un array
        'geojson' => 'array', // Decodificación automática de 'geojson' a un array
    ];

    // Ejemplo de relación: Un Registro pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accesor para obtener 'geojson' como un objeto decodificado
    public function getGeojsonAttribute($value)
    {
        return json_decode($value, true); // Devuelve el 'geojson' como un array
    }

    // Accesor para obtener 'description' como un objeto decodificado
    public function getDescriptionAttribute($value)
    {
        return json_decode($value, true); // Devuelve 'description' como un array
    }

    // Si usas SoftDeletes, este es el trait que permite eliminar de manera suave
    // Si no lo necesitas, puedes eliminar la línea `use SoftDeletes;`
    // use SoftDeletes;
}
