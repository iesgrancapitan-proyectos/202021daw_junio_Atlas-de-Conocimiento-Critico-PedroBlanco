<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'Estados';

    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function mapas()
    {
        return $this->hasMany(Mapa::class);
    }
}
