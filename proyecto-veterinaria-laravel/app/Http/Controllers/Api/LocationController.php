<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getCountries()
    {
        // Static list for compatibility
        return response()->json([
            ['code' => 'ESP', 'name' => 'España'],
            ['code' => 'MEX', 'name' => 'México'],
            ['code' => 'ARG', 'name' => 'Argentina'],
            ['code' => 'COL', 'name' => 'Colombia'],
        ]);
    }

    public function getCities($countryCode)
    {
        // Static cities based on country
        $cities = [
            'ESP' => [
                ['id' => 1, 'name' => 'Madrid'],
                ['id' => 2, 'name' => 'Barcelona'],
                ['id' => 3, 'name' => 'Valencia'],
            ],
            'MEX' => [
                ['id' => 4, 'name' => 'Ciudad de México'],
                ['id' => 5, 'name' => 'Guadalajara'],
            ],
            // Default
            'default' => [
                ['id' => 99, 'name' => 'Ciudad Principal'],
            ]
        ];

        return response()->json($cities[$countryCode] ?? $cities['default']);
    }
}
