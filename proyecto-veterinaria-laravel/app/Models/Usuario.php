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
        'role',
        'foto_perfil',
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
        ];
    }
    
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    // Relaciones
    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'usuario_id');
    }

    // Helpers de Rol
    public function esAdmin()
    {
        return $this->role === 'admin';
    }

    public function esVeterinario()
    {
        return $this->role === 'veterinario';
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'usuario_id');
    }
}
