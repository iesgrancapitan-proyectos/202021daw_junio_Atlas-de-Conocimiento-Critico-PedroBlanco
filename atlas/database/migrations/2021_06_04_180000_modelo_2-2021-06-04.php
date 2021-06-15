<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modelo220210604 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table ( 'Geo', function ( Blueprint $table ) {
            $table->decimal('longitud', 11, 8);
            $table->decimal('latitud', 10, 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ( 'Geo', function ( Blueprint $table ) {
            $table->dropColumn('longitud');
            $table->dropColumn('latitud');
        });
    }
}
