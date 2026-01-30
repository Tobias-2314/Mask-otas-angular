<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear Admin
        \App\Models\Usuario::create([
            'nombre' => 'Administrador',
            'email' => 'admin@maskotas.com',
            'contrasena' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Crear Veterinario
        \App\Models\Usuario::create([
            'nombre' => 'Dr. Veterinario',
            'email' => 'vet@maskotas.com',
            'contrasena' => \Illuminate\Support\Facades\Hash::make('vet123'),
            'role' => 'veterinario'
        ]);

        // Crear Cliente de Prueba
        $cliente = \App\Models\Usuario::create([
            'nombre' => 'Juan Perez',
            'email' => 'cliente@test.com',
            'contrasena' => \Illuminate\Support\Facades\Hash::make('123456'),
            'role' => 'cliente'
        ]);

        // --- PRODUCTOS ---
        \App\Models\Product::create([
            'name' => 'Collar Premium para Perro',
            'description' => 'Collar de cuero resistente y ajustable.',
            'price' => 25.00,
            'image' => 'https://via.placeholder.com/300?text=Collar'
        ]);
        \App\Models\Product::create([
            'name' => 'Juguete Mordedor',
            'description' => 'Juguete de goma ideal para cachorros.',
            'price' => 12.50,
            'image' => 'https://via.placeholder.com/300?text=Juguete'
        ]);
        \App\Models\Product::create([
            'name' => 'Cama Suave Gato',
            'description' => 'Cama acolchada muy cómoda.',
            'price' => 45.00,
            'image' => 'https://via.placeholder.com/300?text=Cama'
        ]);
        \App\Models\Product::create([
            'name' => 'Alimento Premium 5kg',
            'description' => 'Alimento balanceado alta calidad.',
            'price' => 38.90,
            'image' => 'https://via.placeholder.com/300?text=Alimento'
        ]);

        // --- MASCOTAS ---
        $mascota1 = \App\Models\Mascota::create([
            'usuario_id' => $cliente->id,
            'nombre' => 'Firulais',
            'tipo' => 'Perro',
            'raza' => 'Labrador',
            'edad' => 3,
            'peso' => 25.5,
            'genero' => 'Macho',
            'notas_medicas' => 'Vacunas al día. Alérgico al pollo.'
        ]);

        $mascota2 = \App\Models\Mascota::create([
            'usuario_id' => $cliente->id,
            'nombre' => 'Michi',
            'tipo' => 'Gato',
            'raza' => 'Siames',
            'edad' => 2,
            'peso' => 4.0,
            'genero' => 'Hembra',
            'notas_medicas' => 'Esterilizada.'
        ]);

        // --- CITAS ---
        // Cita Pendiente
        \App\Models\Cita::create([
            'usuario_id' => $cliente->id,
            'mascota_id' => $mascota1->id,
            'nombre_dueno' => $cliente->nombre,
            'email' => $cliente->email,
            'telefono' => '555-1234',
            'nombre_mascota' => $mascota1->nombre,
            'tipo_mascota' => $mascota1->tipo,
            'tipo_servicio' => 'Vacunación',
            'fecha_preferida' => now()->addDays(2), // Pasado mañana
            'hora_preferida' => '10:00',
            'estado' => 'pendiente',
            'notas' => 'Refuerzo anual.'
        ]);

        // Cita Confirmada (Para que vea el veterinario)
        \App\Models\Cita::create([
            'usuario_id' => $cliente->id,
            'mascota_id' => $mascota2->id,
            'nombre_dueno' => $cliente->nombre,
            'email' => $cliente->email,
            'telefono' => '555-1234',
            'nombre_mascota' => $mascota2->nombre,
            'tipo_mascota' => $mascota2->tipo,
            'tipo_servicio' => 'Consulta General',
            'fecha_preferida' => now()->addDays(1), // Mañana
            'hora_preferida' => '16:30',
            'estado' => 'confirmado',
            'notas' => 'Revision general.'
        ]);

        // --- RESEÑAS ---
        \App\Models\Resena::create([
            'usuario_id' => $cliente->id,
            'calificacion' => 5,
            'comentario' => 'Excelente servicio, trataron muy bien a Firulais!',
            'aprobado' => true
        ]);
    }
}
