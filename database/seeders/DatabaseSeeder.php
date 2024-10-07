<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama al seeder del usuario
        $this->call([
            PacienteSeeder::class,
            UserSeeder::class, // Añadido para ejecutar el seeder del usuario
        ]);

        // Ejemplo de generación de 10 usuarios ficticios, si lo necesitas
        // User::factory(10)->create();

        // Ejemplo de usuario ficticio, si lo necesitas
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
