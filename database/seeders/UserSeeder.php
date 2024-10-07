<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        User::create([
            'name' => 'Juan',
            'apellidos' => 'Pérez Gómez',
            'dni' => '12345678L', // Formato español de DNI
            'email' => 'seguridadweb@campusviu.es',
            'password' => Hash::make('S3gur1d4d?W3b'),
            'telefono' => '+34600123456', // Número de teléfono con prefijo de país
            'pais' => 'ES', // Código del país
            'sobre_ti' => 'Soy un usuario de prueba para validaciones de seguridad web. Disfruto de la programación y las tecnologías web.',
        ]);
    }
}
