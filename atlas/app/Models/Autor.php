<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autor extends Model
{
    use HasFactory;

    use Searchable;

    protected $table = 'Autores';

    protected $fillable = [
        'nombre', 'apellidos', 'url'
    ];

    public function mapas()
    {
        return $this->belongsToMany(Mapa::class, 'Autores_Mapas', 'autor_id', 'mapa_id')->using(Autor_Mapa::class);
    }

    public function searchableAs()
    {
        return 'autores_index';
    }
}
