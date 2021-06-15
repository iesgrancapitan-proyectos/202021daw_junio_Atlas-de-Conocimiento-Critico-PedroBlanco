<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const IS_SUPER = 1;
    public const IS_ADMIN = 2;
    public const IS_SITE_EDITOR = 3;
    public const IS_MAP_EDITOR = 4;
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
