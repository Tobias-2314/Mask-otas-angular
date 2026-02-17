<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'guest_name',
        'guest_email',
        'total',
        'status',
        'items',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'items' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}
