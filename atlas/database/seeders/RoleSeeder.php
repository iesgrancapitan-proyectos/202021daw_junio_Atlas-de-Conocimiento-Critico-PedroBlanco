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
                [
                    'id' => Role::IS_SUPER,
                    'nombre' => 'SuperAdministrador',
                    'descripcion' =>  'Usuario con permiso sobre todos los aspectos de la aplicación.',
                ],
                [
                    'id' => Role::IS_ADMIN,
                    'nombre' => 'Administrador',
                    'descripcion' => 'Usuario con todos los permisos sobre todas las entidades relacionadas con los mapas y todos los usuarios (menos los superusuarios).',
                ],
                [
                    'id' => Role::IS_SITE_EDITOR,
                    'nombre' => 'Editor de sitio',
                    'descripcion' => 'Usuario con permiso de creación/edición/borrado de todas las entidades relacionadas con los Mapas.',
                ],
                [
                    'id' => Role::IS_MAP_EDITOR,
                    'nombre' => 'Editor de mapas',
                    'descripcion' => 'Usuario con permiso de creación/edición/borrado de Mapas, de Localizaciones Geográficas y de Autores.',
                ],
                [
                    'id' => Role::IS_USER,
                    'nombre' => 'Usuario autenticado',
                    'descripcion' => 'Usuario con permiso de lectura.',
                ],
            ],
            ['id'],
            ['nombre','descripcion']
        );
    }
}
