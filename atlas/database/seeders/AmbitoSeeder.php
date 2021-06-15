<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Ambito;

class AmbitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Si estamos 'sembrando' la aplicación desde 0, ¿sería mejor un insert en vez de upsert para que salgan errores?
        // Si fueran muchas filas usaríamos un archivo externo, pero para el sembrado inicial con valores prefijados, mejor así
        Ambito::upsert([
            'nombre' => 'Proceso',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Ambito::upsert([
            'nombre' => 'Área',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Ambito::upsert([
            'nombre' => 'Puesto',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Ambito::upsert([
            'nombre' => 'Otro',
            'descripcion' => 'Otro',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );
    }
}
