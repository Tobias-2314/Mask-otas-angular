<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Controller
{
    public function index()
    {
        // Return approved/visible reviews, ordered by creation date desc
        $reviews = Review::where('is_visible', true)
                         ->where('is_approved', true) // Assuming automated approval for now based on previous logic, or strict check
                         ->orderBy('created_at', 'desc')
                         ->get();
        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'pet_name' => 'nullable|string|max:255',
            'service_type' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $review = Review::create(array_merge(
            $request->all(),
            ['is_approved' => true, 'is_visible' => true] // Auto-approve for demo purposes as per previous behavior
        ));

        return response()->json($review, 201);
    }

    public function stats()
    {
        $average = Review::where('is_visible', true)->avg('rating');
        $total = Review::where('is_visible', true)->count();

        return response()->json([
            'average' => round($average, 1),
            'total' => $total,
        ]);
    }
}
