<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Geo extends Model
{
    use HasFactory;

    use Searchable;

    protected $table = 'Geo';

    protected $fillable = [
        'dir3', 'nombre',
        'longitud', 'latitud',
    ];

    public function mapas()
    {
        return $this->belongsToMany(Geo::class, 'Geo_Mapas', 'geo_id', 'mapa_id')->using(Geo_Mapa::class);
    }

    public function searchableAs()
    {
        return 'geos_index';
    }
}
