<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'customer_name',
        'rating',
        'comment',
        'pet_name',
        'service_type',
        'is_approved',
        'is_visible',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_visible' => 'boolean',
        'rating' => 'integer',
    ];
}
