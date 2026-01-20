<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $table = 'usuarios';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'contrasena',
        'es_admin',
    ];

    /**
     * Los atributos que deben ocultarse para la serialización.
     *
     * @var list<string>
     */
    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * Obtener los atributos que deben ser casted.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'contrasena' => 'hashed',
            'es_admin' => 'boolean',
        ];
    }
    
    // Sobreescribir para usar 'contrasena' en lugar de 'password' si es necesario por Laravel Auth,
    // pero Laravel espera 'password' por defecto. Para mantenerlo simple, usaremos 'password' en la DB
    // O configuraremos el modelo.
    // Para simplificar al maximo, mantengamos los nombres estandar de laravel internamente si es posible,
    // o cambiemos todo. El usuario pidio "todo en español".
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
