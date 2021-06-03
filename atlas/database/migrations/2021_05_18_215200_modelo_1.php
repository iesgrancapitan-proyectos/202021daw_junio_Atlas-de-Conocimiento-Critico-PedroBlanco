<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modelo1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// Todos los atributos url serán definidos con collation ascci_bin (por ser case-sensitive) y charset ascii (ver https://tools.ietf.org/html/rfc2616#section-3.2.3 ; aunque ya se permitan en los DNS otros charsets, se pueden convertir a punycode)
		// Su longitud será de 2083 (ver https://stackoverflow.com/questions/219569/best-database-field-type-for-a-url ; aunque habría que investigar cómo ha cambiado la situación)

		Schema::create ( 'Estados', function ( Blueprint $table ) {
			$table->id();
			$table->string('nombre', 100)->unique();
			$table->text('descripcion');
			$table->timestamps();
		});

        Schema::create ( 'Autores', function ( Blueprint $table ) {
			$table->id();
			// FIXME: ¿Tengo que hacer únicos la combinación Nombre y Apellidos? Para usar Upserts en el Seeder
			$table->string('nombre', 20);
			$table->string('apellidos', 40);
			$table->string('url', 2083)->collation('ascii_bin')->charset('ascii');
			$table->timestamps();
		});

        Schema::create ( 'Administraciones', function ( Blueprint $table ) {
			$table->id();
			$table->string('nombre', 100)->unique();
			$table->text('descripcion');
			$table->timestamps();
		});

        Schema::create ( 'Geo', function ( Blueprint $table ) {
			$table->id();
			$table->string('nombre', 100)->unique();
			// DIR3: Ver página 10 https://administracionelectronica.gob.es/ctt/resources/Soluciones/238/Descargas/manual%20de%20atributos.pdf?idIniciativa=238&idElemento=12232
			$table->string('dir3', 9);
			$table->timestamps();
		});

		Schema::create ( 'Ambitos', function ( Blueprint $table ) {
			$table->id();
			$table->string('nombre', 100)->unique();
			$table->text('descripcion');
			$table->timestamps();
		});

        Schema::create ( 'Mapas', function ( Blueprint $table ) {
			$table->id();
			$table->string('nombre', 100)->unique();
			$table->text('descripcion');
			$table->string('url', 2083)->collation('ascii_bin')->charset('ascii');
			$table->text('comentario');
			$table->date('f_creacion');
			$table->date('f_actualizado');
            $table->unsignedBigInteger('estado_id', false);
			$table->foreign('estado_id')->references('id')->on('Estados');
            $table->unsignedBigInteger('administracion_id', false);
			$table->foreign('administracion_id')->references('id')->on('Administraciones');
            $table->unsignedBigInteger('ambito_id', false);
			$table->foreign('ambito_id')->references('id')->on('Ambitos');
			$table->timestamps();
		});

        Schema::create ( 'Geo_Mapas', function ( Blueprint $table ) {
			$table->id();
            $table->unsignedBigInteger('geo_id', false);
			$table->foreign('geo_id')->references('id')->on('Geo');
            $table->unsignedBigInteger('mapa_id', false);
			$table->foreign('mapa_id')->references('id')->on('Mapas');
			$table->timestamps();
		});

        Schema::create ( 'Autores_Mapas', function ( Blueprint $table ) {
			$table->id();
            $table->unsignedBigInteger('autor_id', false);
			$table->foreign('autor_id')->references('id')->on('Autores');
            $table->unsignedBigInteger('mapa_id', false);
			$table->foreign('mapa_id')->references('id')->on('Mapas');
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Ambitos');
        Schema::dropIfExists('Administraciones');
        Schema::dropIfExists('Estados');
        Schema::dropIfExists('Autores_Mapas');
        Schema::dropIfExists('Geo_Mapas');
        Schema::dropIfExists('Autores');
        Schema::dropIfExists('Geo');
        Schema::dropIfExists('Mapas');
    }
}
