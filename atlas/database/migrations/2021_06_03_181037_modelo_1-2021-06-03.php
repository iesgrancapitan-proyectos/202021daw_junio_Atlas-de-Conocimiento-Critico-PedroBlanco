<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modelo120210603 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hago los siguientes atributos únicos:
        // - Para poder usar Upserts en los Seeders correspondientes
        // - Porque tiene sentido semánticamente

        Schema::table ( 'Estados', function ( Blueprint $table ) {
			$table->unique('nombre');
		});

        Schema::table ( 'Administraciones', function ( Blueprint $table ) {
			$table->unique('nombre');
		});

        Schema::table ( 'Geo', function ( Blueprint $table ) {
			$table->unique('nombre');
		});

		Schema::table ( 'Ambitos', function ( Blueprint $table ) {
			$table->unique('nombre');
		});

        Schema::table ( 'Mapas', function ( Blueprint $table ) {
			$table->unique('nombre');
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
			$table->dropUnique('nombre');
		});

        Schema::table ( 'Administraciones', function ( Blueprint $table ) {
			$table->dropUnique('nombre');
		});

        Schema::table ( 'Geo', function ( Blueprint $table ) {
			$table->dropUnique('nombre');
		});

		Schema::table ( 'Ambitos', function ( Blueprint $table ) {
			$table->dropUnique('nombre');
		});

        Schema::table ( 'Mapas', function ( Blueprint $table ) {
			$table->dropUnique('nombre');
		});
    }
}
