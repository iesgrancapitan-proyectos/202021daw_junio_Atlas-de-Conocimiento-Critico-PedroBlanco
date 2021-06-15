<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Administracion;

class AdministracionSeeder extends Seeder
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
        Administracion::upsert([
            'nombre' => 'Administración General',
            'descripcion' => 'Organización pública, instrumento del Gobierno para desarrollar e implementar sus políticas públicas o prestar servicios.',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Administracion::upsert([
            'nombre' => 'Empleo',
            'descripcion' => 'Sector de la Administración relacionado con la políticas de Empleo.',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Administracion::upsert([
            'nombre' => 'Sanidad',
            'descripcion' => 'Sanidad Pública y la administración que le presta servicio.',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Administracion::upsert([
            'nombre' => 'Educación',
            'descripcion' => 'Educación Pública y la administración que le presta servicio.',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Administracion::upsert([
            'nombre' => 'Admón. al servicio de la Justicia',
            'descripcion' => 'Denominada "administración de la Administración de Justicia" según jurisprudencia del Tribunal Constitucional, que la considera el conjunto de medios personales y materiales que se colocan al servicio de la Administración de Justicia.',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Administracion::upsert([
            'nombre' => 'Otros sectores públicos',
            'descripcion' => 'Otros sectores públicos de carácter oficial que no se encuadran en las otras categorías.',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

        Administracion::upsert([
            'nombre' => 'No aplicable',
            'descripcion' => 'No aplicable',
        ],
        ['nombre'],
        ['nombre', 'descripcion'],
        );

    }
}
