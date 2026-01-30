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
        'mascota_id',
        'veterinario_id',
        'nombre_dueno',
        'email',
        'telefono',
        'nombre_mascota', // Se mantiene por legacy o si no tiene mascota registrada
        'tipo_mascota',
        'tipo_servicio',
        'fecha_preferida',
        'hora_preferida',
        'notas',
        'estado',
        'diagnostico',
        'tratamiento',
        'notas_internas'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function veterinario()
    {
        return $this->belongsTo(Usuario::class, 'veterinario_id');
    }
}
