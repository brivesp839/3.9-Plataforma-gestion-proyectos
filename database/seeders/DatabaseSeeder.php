<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Permite insertar las tablas directamente
use Illuminate\Support\Facades\Hash; //Protege las contraseñas

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            User::factory()->raw(['name' => 'Test User'])
        );

        // ------------------------------------------------------------
        // Datos mínimos para que la aplicación funcione al desplegarla
        // ------------------------------------------------------------

        // 1. Usuarios (tabla users) //Permito que si el usuario ya existe no lo cree de nuevo
        $ana = User::firstOrCreate(
            ['email' => 'ana@example.com'],
            ['name' => 'Ana García', 'password' => Hash::make('password')]
        );

        $luis = User::firstOrCreate(
            ['email' => 'luis@example.com'],
            ['name' => 'Luis Pérez', 'password' => Hash::make('password')]
        );

        // 2. Proyectos (tabla projects): cada uno con su creador
        $projects = [
            [
                'creator' => $ana,
                'title' => 'Aplicación de eventos',
                'description' => 'App para consultar eventos culturales y de ocio.',
                'due_date' => '2026-12-15',
                'status' => 'in_progress',
            ],
            [
                'creator' => $luis,
                'title' => 'Panel de administración',
                'description' => 'Dashboard para gestionar usuarios y contenidos.',
                'due_date' => null,
                'status' => 'pending',
            ],
        ];

        $projectIds = [];

        foreach ($projects as $project) {
            DB::table('projects')->updateOrInsert(
                ['user_id' => $project['creator']->id, 'title' => $project['title']],
                [
                    'description' => $project['description'],
                    'due_date' => $project['due_date'],
                    'status' => $project['status'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Guardamos el id del proyecto para usarlo en el paso siguiente
            $projectIds[$project['title']] = DB::table('projects')
                ->where('user_id', $project['creator']->id)
                ->where('title', $project['title'])
                ->value('id');
        }

        // 3. Participaciones (tabla project_user): quién participa en qué proyecto
        $participations = [
            ['Aplicación de eventos',   $ana,  'owner',     40.5],
            ['Aplicación de eventos',   $luis, 'developer', 25.0],
            ['Panel de administración', $luis, 'owner',     10.0],
        ];

        foreach ($participations as [$title, $user, $role, $hours]) {
            DB::table('project_user')->updateOrInsert(
                ['project_id' => $projectIds[$title], 'user_id' => $user->id],
                [
                    'role' => $role,
                    'contribution_hours' => $hours,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
