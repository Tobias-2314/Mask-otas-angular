<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'owner_name',
        'email',
        'phone',
        'pet_name',
        'pet_type',
        'service_type',
        'preferred_date',
        'preferred_time',
        'notes',
        'status',
        'user_id',
    ];
}
