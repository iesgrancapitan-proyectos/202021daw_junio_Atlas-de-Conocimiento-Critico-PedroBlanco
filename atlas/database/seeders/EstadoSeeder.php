<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Estado

class EstadoSeeder extends Seeder
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
        Estado::upsert([
            'nombre' => 'Fase 0 (del Manual 1.0)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Fase 1 (del Manual 1.0)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Fase 2 (del Manual 1.0)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Fase 3 (del Manual 1.0)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Fase 4 (del Manual 1.0)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Ejecución del plan de acción (del Manual 1.0)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Revisión del plan de acción (del Manual 1.0)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Fase 1 (del 1º Curso de Conocimiento Crítico)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Fase 2 (del 1º Curso de Conocimiento Crítico)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Fase 3 (del 1º Curso de Conocimiento Crítico)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Fase 4 (del 1º Curso de Conocimiento Crítico)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Ejecución del plan de acción (del 1º Curso de Conocimiento Crítico)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Revisión del plan de acción (del 1º Curso de Conocimiento Crítico)',
            'descripcion' => '',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Estado::upsert([
            'nombre' => 'Otro/Desconocido/No aplicable',
            'descripcion' => 'Otro estado, estado desconocido o no aplicable en este momento.',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );


    }

    
}
