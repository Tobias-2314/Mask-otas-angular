<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    use HasFactory;

    protected $table = 'resenas';

    protected $fillable = [
        'usuario_id',
        'calificacion', // 1-5
        'comentario',
        'aprobado'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
