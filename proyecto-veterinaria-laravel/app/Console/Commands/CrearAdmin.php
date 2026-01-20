<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class CrearAdmin extends Command
{
    protected $signature = 'admin:crear {email} {password} {nombre}';
    protected $description = 'Crear un usuario administrador';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $nombre = $this->argument('nombre');

        // Verificar si el usuario ya existe
        $usuario = Usuario::where('email', $email)->first();

        if ($usuario) {
            // Actualizar a admin
            $usuario->es_admin = true;
            $usuario->save();
            $this->info("Usuario {$email} actualizado a administrador");
        } else {
            // Crear nuevo usuario admin
            Usuario::create([
                'nombre' => $nombre,
                'email' => $email,
                'contrasena' => Hash::make($password),
                'es_admin' => true
            ]);
            $this->info("Usuario administrador {$email} creado exitosamente");
        }

        return 0;
    }
}
