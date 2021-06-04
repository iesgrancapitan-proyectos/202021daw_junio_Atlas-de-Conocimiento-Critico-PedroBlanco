<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modelo220210604B extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table ( 'Estados', function ( Blueprint $table ) {
			$table->text('descripcion')->nullable(true)->change();
		});

        Schema::table ( 'Administraciones', function ( Blueprint $table ) {
			$table->text('descripcion')->nullable(true)->change();
		});

		Schema::table ( 'Ambitos', function ( Blueprint $table ) {
			$table->text('descripcion')->nullable(true)->change();
		});

        Schema::table ( 'Autores', function ( Blueprint $table ) {
			$table->string('apellidos', 40)->nullable(true)->change();
			$table->string('url', 2083)->collation('ascii_bin')->charset('ascii')->nullable(true)->change();
		});

        Schema::table ( 'Geo', function ( Blueprint $table ) {
			$table->string('dir3', 9)->nullable(true)->change();
            $table->decimal('longitud', 11, 8)->nullable(true)->change();
            $table->decimal('latitud', 10, 8)->nullable(true)->change();
		});

        Schema::table ( 'Mapas', function ( Blueprint $table ) {
			$table->text('descripcion')->nullable(true)->change();
			$table->string('url', 2083)->collation('ascii_bin')->charset('ascii')->nullable(true)->change();
			$table->text('comentario')->nullable(true)->change();
			$table->date('f_creacion')->nullable(true)->change();
			$table->date('f_actualizado')->nullable(true)->change();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ( 'Estados', function ( Blueprint $table ) {
			$table->text('descripcion')->nullable(false)->change();
		});

        Schema::table ( 'Administraciones', function ( Blueprint $table ) {
			$table->text('descripcion')->nullable(false)->change();
		});

		Schema::table ( 'Ambitos', function ( Blueprint $table ) {
			$table->text('descripcion')->nullable(false)->change();
		});

        Schema::table ( 'Autores', function ( Blueprint $table ) {
			$table->string('apellidos', 40)->nullable(false)->change();
			$table->string('url', 2083)->collation('ascii_bin')->charset('ascii')->nullable(false)->change();
		});

        Schema::table ( 'Geo', function ( Blueprint $table ) {
			$table->string('dir3', 9)->nullable(false)->change();
            $table->decimal('longitud', 11, 8)->nullable(false)->change();
            $table->decimal('latitud', 10, 8)->nullable(false)->change();
		});

        Schema::table ( 'Mapas', function ( Blueprint $table ) {
			$table->text('descripcion')->nullable(false)->change();
			$table->string('url', 2083)->collation('ascii_bin')->charset('ascii')->nullable(false)->change();
			$table->text('comentario')->nullable(false)->change();
			$table->date('f_creacion')->nullable(false)->change();
			$table->date('f_actualizado')->nullable(false)->change();
		});
    }
}
