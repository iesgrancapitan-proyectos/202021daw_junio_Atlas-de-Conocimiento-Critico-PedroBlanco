<?php

namespace App\Models;

use App\Models\Mapa;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ambito extends Model
{
    use HasFactory;

    use Searchable;

    protected $table = 'Ambitos';

    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function mapas()
    {
        return $this->hasMany(Mapa::class);
    }

    public function searchableAs()
    {
        return 'ambitos_index';
    }
}
