<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Si estamos 'sembrando' la aplicación desde 0, ¿sería mejor un insert en vez de upsert para que salgan errores?
        Role::upsert([
            [ 'nombre' => 'SuperAdministrador', 'descripcion' =>  'Usuario con permiso sobre todos los aspectos de la aplicación.'],
            [ 'nombre' => 'Administrador', 'descripcion' => 'Usuario con todos los permisos sobre todas las entidades de la aplicación y todos los usuarios.'],
            [ 'nombre' => 'Editor', 'descripcion' => 'Usuario con permiso de edición de todas las entidades de la aplicación.'],
            [ 'nombre' => 'Usuario autenticado', 'descripcion' => 'Usuario con permiso de lectura.'],
        ],
        ['nombre'],
        ['descripcion']
        );
    }
}
