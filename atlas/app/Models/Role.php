<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Permiso sobre TODOS los aspectos de la aplicación
    public const IS_SUPER = 1;

    // Todos los permisos sobre todas las entidades relacionadas con los Mapas y todos los usuarios (menos los superusuarios)
    public const IS_ADMIN = 2;

    // Permiso de creación/edición/borrado de todas las entidades relacionadas con los Mapas
    public const IS_SITE_EDITOR = 3;

    // permiso de creación/edición/borrado de Mapas, de Localizaciones Geográficas y de Autores
    public const IS_MAP_EDITOR = 4;

    // Permiso de lectura
    public const IS_USER = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
