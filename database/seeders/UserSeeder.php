<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Ana García',  'email' => 'ana@example.com'],
            ['name' => 'Luis Pérez',  'email' => 'luis@example.com'],
            ['name' => 'María López', 'email' => 'maria@example.com'],
            ['name' => 'Carlos Ruiz', 'email' => 'carlos@example.com'],
        ];

        //Busca un usuario con ese email y no existe lo crea
        foreach ($users as $data) {
            // firstOrCreate evita errores si el seeder se ejecuta más de una vez
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    //Convierte el texto password en un hash cifrado antes de guardarlo
                    'password' => Hash::make('password'),   
                ]
            );
        }
    }
}

