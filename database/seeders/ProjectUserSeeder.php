<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = DB::table('users')->pluck('id', 'email');      // [email => id]
        $projects = DB::table('projects')->pluck('id', 'title'); // [title => id]

        // [proyecto, usuario, rol, horas de contribución]
        $participations = [
            ['Aplicación de eventos',    'ana@example.com',    'owner',     40.5],
            ['Aplicación de eventos',    'luis@example.com',   'developer', 25.0],
            ['Aplicación de eventos',    'maria@example.com',  'designer',  18.5],
            ['Rediseño de la web',       'ana@example.com',    'owner',      5.0],
            ['Rediseño de la web',       'maria@example.com',  'designer',  12.0],
            ['API de pagos',             'luis@example.com',   'owner',     30.0],
            ['API de pagos',             'carlos@example.com', 'developer', 22.5],
            ['Panel de administración',  'maria@example.com',  'owner',      8.0],
            ['Migración a la nube',      'carlos@example.com', 'owner',     60.0],
            ['Migración a la nube',      'luis@example.com',   'tester',    14.0],
        ];

        foreach ($participations as [$title, $email, $role, $hours]) {
            DB::table('project_user')->insert([
                'project_id' => $projects[$title],
                'user_id' => $users[$email],
                'role' => $role,
                'contribution_hours' => $hours,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
