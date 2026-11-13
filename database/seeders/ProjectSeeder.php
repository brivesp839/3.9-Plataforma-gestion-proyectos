<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // [email => id] de los usuarios creados por UserSeeder
        // [email => id] de los usuarios creados por UserSeeder
        $users = DB::table('users')->pluck('id', 'email');
 
        $projects = [
            [
                'creator' => 'ana@example.com',
                'title' => 'Aplicación de eventos',
                'description' => 'App para consultar eventos culturales y de ocio.',
                'due_date' => '2026-12-15',
                'status' => 'in_progress',
            ],
            [
                'creator' => 'ana@example.com',
                'title' => 'Rediseño de la web',
                'description' => 'Nuevo diseño responsive para el sitio corporativo.',
                'due_date' => '2027-01-20',
                'status' => 'pending',
            ],
            [
                'creator' => 'luis@example.com',
                'title' => 'API de pagos',
                'description' => 'Integración con la pasarela de pago.',
                'due_date' => '2026-11-30',
                'status' => 'in_progress',
            ],
            [
                'creator' => 'maria@example.com',
                'title' => 'Panel de administración',
                'description' => 'Dashboard para gestionar usuarios y contenidos.',
                'due_date' => null,
                'status' => 'pending',
            ],
            [
                'creator' => 'carlos@example.com',
                'title' => 'Migración a la nube',
                'description' => 'Traslado de servicios a un proveedor cloud.',
                'due_date' => '2026-10-01',
                'status' => 'completed',
            ],
        ];
 
        foreach ($projects as $project) {
            DB::table('projects')->insert([
                'user_id' => $users[$project['creator']],
                'title' => $project['title'],
                'description' => $project['description'],
                'due_date' => $project['due_date'],
                'status' => $project['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
