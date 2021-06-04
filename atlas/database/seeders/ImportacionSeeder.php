<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Autor;
use App\Models\Geo;
use App\Models\Mapa;

class ImportacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Ejemplo de upsert
        Administracion::upsert([ // Primero los campos 'fillable'
            'nombre' => 'Administración General',
            'descripcion' => 'Organización pública, instrumento del Gobierno para desarrollar e implementar sus políticas públicas o prestar servicios.',
        ],
        ['nombre'], // Segundo el campo 'unique' por el que nos vamos a guiar en el upsert
        ['nombre', 'descripcion'], // Tercero los campos que deben ser actualizados si el registro ya existe (no tienen que ser todos)
        );
        */

        // Abrir fichero de importación por defecto (normalmente va a ser siempre el mismo)
            // Posibles precondiciones:
                // ¿Fichero ordenado por fecha? ¿Por cual fecha?
                // ¿Columnas mínimas? ¿De qué entidades?
                // ¿Array asociativo a partir del título del fichero?

        // Quitamos línea de títulos (¿o extraemos a un array asociativo?)

        // Para cada línea
            // Extraemos Administracion
                // Upsert Administracion
            // Extraemos Ambito
                // Upsert Ambito
            // Extraemos Estado
                // Upsert Estado
            // Extraemos Autor
                // Upsert Autor
            // Extraemos Geo
                // Upsert Geo
            // Extraemos Mapa
                // Upsert Mapa

    }

}
