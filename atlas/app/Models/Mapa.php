<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapa extends Model
{
    use HasFactory;

    protected $table = "Mapas";

    protected $fillable = [
        'nombre',
        'descripcion',
        'url',
        'comentario',
        'f_creacion',
        'f_actualizado',
        'administracion_id',
        'ambito_id',
        'estado_id'
    ];

    protected $casts = [
        'f_actualizado' => 'date',
        'f_creacion' => 'date'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function administracion()
    {
        return $this->belongsTo(Administracion::class);
    }

    public function geo()
    {
        return $this->belongsToMany(Geo::class, 'Geo_Mapas', 'mapa_id', 'geo_id')->using(Geo_Mapa::class);
    }

    public function ambito()
    {
        return $this->belongsTo(Ambito::class);
    }

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'Autores_Mapas', 'mapa_id', 'autor_id')->using(Autor_Mapa::class);
    }
}
