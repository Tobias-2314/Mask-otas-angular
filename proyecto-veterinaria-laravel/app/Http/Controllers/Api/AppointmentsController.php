<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;

class AppointmentsController extends Controller
{
    public function index()
    {
        // For now return all, in real app maybe only for logged user or admin
        return response()->json(Appointment::orderBy('date', 'asc')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string|max:50',
            'service_type' => 'required|string|max:50',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Add user_id if authenticated
        $data = $request->all();
        if ($request->user()) {
            $data['user_id'] = $request->user()->id;
        }

        $appointment = Appointment::create(array_merge(
            $data,
            ['status' => 'pending']
        ));

        return response()->json($appointment, 201);
    }

    public function getTimeSlots(Request $request)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        
        if (!$startDate || !$endDate) {
             return response()->json(['error' => 'startDate and endDate are required'], 400);
        }

        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        
        $days = [];
        $current = clone $start;

        while ($current <= $end) {
            $dateStr = $current->format('Y-m-d');
            $slots = [];
            
            // Generate some mock slots (9:00 to 17:00)
            $times = ['09:00', '10:00', '11:00', '12:00', '14:00', '15:00', '16:00', '17:00'];
            foreach ($times as $index => $time) {
                // Random availability for demo purposes, or check DB for conflicts
                $isBooked = Appointment::where('preferred_date', $dateStr)
                                       ->where('preferred_time', $time)
                                       ->exists();
                
                $slots[] = [
                    'id' => $dateStr . '-' . $index,
                    'time' => $time,
                    'available' => !$isBooked,
                    'doctorName' => 'Dr. Smith'
                ];
            }

            $days[] = [
                'date' => $dateStr,
                'slots' => $slots
            ];
            
            $current->modify('+1 day');
        }

        return response()->json(['days' => $days]);
    }
}
