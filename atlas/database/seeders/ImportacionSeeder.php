<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Administracion;
use App\Models\Ambito;
use App\Models\Estado;
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
        $nombre_archivo_csv = 'data/2021-06-04.csv';
        $archivo_csv = false;
        $cabecera = [];
        $linea = [];

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
                // ('nombre','apellidos') de Autor lo consideramos clave única (en la importación sólo)
        if ( $archivo_csv = fopen ( $nombre_archivo_csv, 'r' ) !== false ) {
            // Quitamos línea de cabecera
            if ( ( $cabecera = fgetcsv ( $archivo_csv, 1000, ',', '"' ) ) !== false ) {
                // Para cada línea con datos
                while ( ($linea = fgetcsv ( $archivo_csv, 2000, ',', '"' ) ) !== false ) {
                    // Extraemos Administracion - Upsert
                    $temp_administracion = $this->upsert_administracion ( $linea[5] );

                    // Extraemos Ambito - Upsert
                    $temp_ambito = $this->upsert_ambito ( $linea[7] );

                    // Extraemos Estado - Upsert
                    $temp_estado = $this->upsert_estado ( $linea[6] );

                    // Extraemos Autor - InsertOrUpdate
                        // No podemos hacer Upsert - No tenemos un campo único y la combinación ('nombre','apellidos') no es única
                        // No podemos añadir un campo NULLABLE y UNIQUE (sólo una fila podría ser NULL)
                        // Así que al menos en la importación suponemos que el autor es único y por tanto lo tratamos así (pero sin Upsert)
                    $temp_autor = $this->insert_autor ( $linea[8], $linea[9] );

                    // Extraemos Geo - Upsert
                    $temp_geo = $this->upsert_geo ( $linea[10], $linea[11], $linea[12] );

                    // Extraemos Mapa - Upsert
                    $temp_mapa = $this->upsert_mapa ( $linea[1], $linea[2], $linea[3], $linea[4],
                                    $temp_administracion->id, $temp_ambito->id, $temp_estado->id, $temp_autor->id, $temp_geo->id
                    );

                }
            } else {
                // Si el archivo está vacío deberíamos hacer algo...
            }
            fclose ( $archivo_csv );
        }
    }

    protected function upsert_administracion ( $nombre )
    {
        return Administracion::upsert([ // Primero los campos 'fillable' que vamos a _upsertar_
                'nombre' => $nombre,
            ],
            ['nombre'], // Segundo el campo 'unique' por el que nos vamos a guiar en el upsert
            ['nombre'] // Tercero los campos que deben ser actualizados si el registro ya existe (no tienen que ser todos)
        );
    }

    protected function upsert_administracion ( $nombre )
    {
        return Administracion::upsert([ // Primero los campos 'fillable' que vamos a _upsertar_
                'nombre' => $nombre,
            ],
            ['nombre'], // Segundo el campo 'unique' por el que nos vamos a guiar en el upsert
            ['nombre'] // Tercero los campos que deben ser actualizados si el registro ya existe (no tienen que ser todos)
        );
    }

    protected function upsert_ambito ( $nombre )
    {
        return Ambito::upsert([ // Primero los campos 'fillable' que vamos a _upsertar_
                'nombre' => $nombre,
            ],
            ['nombre'], // Segundo el campo 'unique' por el que nos vamos a guiar en el upsert
            ['nombre'] // Tercero los campos que deben ser actualizados si el registro ya existe (no tienen que ser todos)
        );
    }

    protected function insert_autor ( $apellidos, $nombre )
    {
        return Autor::updateOrCreate([
                'nombre' => $nombre,
                'apellidos' => $apellidos,
        ]);
    }

    protected function upsert_geo ( $nombre, $longitud, $latitud )
    {
        return Geo::upsert([ // Primero los campos 'fillable' que vamos a _upsertar_
                'nombre' => $nombre,
                'longitud' => $longitud,
                'latitud' => $latitud,
            ],
            ['nombre'], // Segundo el campo 'unique' por el que nos vamos a guiar en el upsert
            ['nombre','longitud','latitud'] // Tercero los campos que deben ser actualizados si el registro ya existe (no tienen que ser todos)
        );
    }

    protected function upsert_mapa ( $nombre, $descripcion, $f_creacion, $f_actualizado,
                                    $id_administracion, $id_ambito, $id_estado, $id_autor, $id_geo )
    {
        $mapa = Mapa::upsert([ // Primero los campos 'fillable' que vamos a _upsertar_
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'f_creacion' => $f_creacion,
                'f_actualizado' => $f_actualizado,
                'administracion_id' => $id_administracion,
                'ambito_id' => $id_ambito,
                'estado_id' => $id_estado,
            ],
            ['nombre'], // Segundo el campo 'unique' por el que nos vamos a guiar en el upsert
            ['nombre','descripcion','f_creacion','f_actualizado','administracion_id','ambito_id','estado_id'] // Tercero los campos que deben ser actualizados si el registro ya existe (no tienen que ser todos)
        );

        $mapa->autores()->sync($id_autor);
        $mapa->geo()->sync($id_geo);

        return $mapa;
    }

}
