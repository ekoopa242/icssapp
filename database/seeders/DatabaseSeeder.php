<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Plan;
use App\Models\User;
use App\Models\Velocidad;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Crea usuario
        $usuario = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'rol' => 'Administracion',
        ]);

        // Crea velocidades
        $velocidad3 = Velocidad::create([
            'cantVelocidad' => '3MB'
        ]);
        $velocidad4 = Velocidad::create([
            'cantVelocidad' => '4MB'
        ]);
        $velocidad5 = Velocidad::create([
            'cantVelocidad' => '5MB'
        ]);
        $velocidad6 = Velocidad::create([
            'cantVelocidad' => '6MB'
        ]);
        $velocidad10 = Velocidad::create([
            'cantVelocidad' => '10MB'
        ]);
        $velocidad15 = Velocidad::create([
            'cantVelocidad' => '15MB'
        ]);
        $velocidad20 = Velocidad::create([
            'cantVelocidad' => '20MB'
        ]);
        $velocidad25 = Velocidad::create([
            'cantVelocidad' => '25MB'
        ]);
        $velocidad30 = Velocidad::create([
            'cantVelocidad' => '30MB'
        ]);

        // Crea planes
        $asimetrico5 = Plan::create([
            'velocidad_id' => $velocidad5->id,
            'nombrePlan' => 'Asimetrico',
            'precio' => 499.00
        ]);
        $asimetrico10 = Plan::create([
            'velocidad_id' => $velocidad10->id,
            'nombrePlan' => 'Asimetrico',
            'precio' => 699.00
        ]);
        $asimetrico15 = Plan::create([
            'velocidad_id' => $velocidad15->id,
            'nombrePlan' => 'Asimetrico',
            'precio' => 799.00
        ]);
        $asimetrico20 = Plan::create([
            'velocidad_id' => $velocidad20->id,
            'nombrePlan' => 'Asimetrico',
            'precio' => 899.00
        ]);
        $asimetrico25 = Plan::create([
            'velocidad_id' => $velocidad25->id,
            'nombrePlan' => 'Asimetrico',
            'precio' => 999.00
        ]);
        $asimetrico30 = Plan::create([
            'velocidad_id' => $velocidad30->id,
            'nombrePlan' => 'Asimetrico',
            'precio' => 1099.00
        ]);
        $simetrico3 = Plan::create([
            'velocidad_id' => $velocidad3->id,
            'nombrePlan' => 'Simetrico',
            'precio' => 660.00
        ]);
        $simetrico4 = Plan::create([
            'velocidad_id' => $velocidad4->id,
            'nombrePlan' => 'Simetrico',
            'precio' => 760.00
        ]);
        $simetrico5 = Plan::create([
            'velocidad_id' => $velocidad5->id,
            'nombrePlan' => 'Simetrico',
            'precio' => 860.00
        ]);
        $simetrico6 = Plan::create([
            'velocidad_id' => $velocidad6->id,
            'nombrePlan' => 'Simetrico',
            'precio' => 960.00
        ]);
    }
}
