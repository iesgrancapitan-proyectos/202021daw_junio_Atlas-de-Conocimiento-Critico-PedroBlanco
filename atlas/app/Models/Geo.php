<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geo extends Model
{
    use HasFactory;

    protected $table = 'Geo';

    protected $fillable = [
        'dir3', 'nombre'
    ];

    public function mapas()
    {
        return $this->belongsToMany(Geo::class, 'Geo_Mapas', 'geo_id', 'mapa_id')->using(Geo_Mapa::class);
    }
}
