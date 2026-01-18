<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'usuario_id',
        'nombre_dueno',
        'email',
        'telefono',
        'nombre_mascota',
        'tipo_mascota',
        'tipo_servicio',
        'fecha_preferida',
        'hora_preferida',
        'notas',
        'estado' // pendiente, confirmado, completado
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
