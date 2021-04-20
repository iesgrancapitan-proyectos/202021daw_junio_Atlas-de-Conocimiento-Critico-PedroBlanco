<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellidos', 'url'
    ];

    public function mapas()
    {
        return $this->belongsToMany(Mapa::class, 'Autores_Mapas', 'autor_id', 'mapa_id')->using(Autor_Mapa::class);
    }
}
