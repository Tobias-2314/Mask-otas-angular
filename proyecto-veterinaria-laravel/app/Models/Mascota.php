<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Assuming HasFactory is needed
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Assuming HasUuids is needed

class Mascota extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'usuario_id',
        'nombre',
        'tipo',
        'raza',
        'edad',
        'peso',
        'genero',
        'notas_medicas',
    ];

    public function dueno()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function historial()
    {
        return $this->hasMany(HistorialMedico::class);
    }
}
