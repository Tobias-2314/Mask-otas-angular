<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $fillable = [
        'mascota_id',
        'usuario_id',
        'tipo',
        'descripcion',
        'fecha'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
