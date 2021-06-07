<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Si estamos 'sembrando' la aplicación desde 0, ¿sería mejor un insert en vez de upsert para que salgan errores?
        User::upsert([
            'name' => 'super',
            'email' => 'super@example.com',
            'email_verified_at' => null,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // 'password' => 'password'
            'role_id' => Role::where('nombre', 'SuperAdministrador')->first()->id,
        ],
        ['email'],
        ['name', 'email', 'email_verified_at', 'password', 'role_id'],
        );
    }
}
