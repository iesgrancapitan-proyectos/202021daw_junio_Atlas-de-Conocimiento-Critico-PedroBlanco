<?php

namespace App\Models;

use App\Models\Geo;
use App\Models\Autor;
use App\Models\Ambito;
use App\Models\Estado;
use App\Models\Geo_Mapa;
use App\Models\Autor_Mapa;
use Laravel\Scout\Searchable;
use App\Models\Administracion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapa extends Model
{
    use HasFactory;

    use Searchable;

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
        'f_actualizado' => 'datetime:Y-m-d',
        'f_creacion' => 'datetime:Y-m-d'
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

    public function searchableAs()
    {
        return 'mapas_index';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Eliminamos de los criterios de búsqueda:
        // - cuándo se actualizaron los registros (los cambios los registramos en otros campos)
        // - claves foráneas
        $array = array_diff_key ( $array, [
            'estado_id' => '',
            'administracion_id' => '',
            'ambito_id' => '',
            'created_at' => '',
            'updated_at' => '',
        ] );

        $array['autores'] = $this->autores()->get(['nombre','apellidos']);

        $array['geo'] = $this->geo()->get(['nombre']);

        $array['ambito'] = $this->ambito()->get(['nombre']);

        $array['administracion'] = $this->administracion()->get(['nombre']);

        $array['estado'] = $this->estado()->get(['nombre']);

        return $array;
    }
}
