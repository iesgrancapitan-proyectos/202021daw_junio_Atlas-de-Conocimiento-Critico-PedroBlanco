<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(AmbitoSeeder::class);
        $this->call(AdministracionSeeder::class);
        $this->call(EstadoSeeder::class);

        $this->call(ImportacionClass::class);
    }
}
