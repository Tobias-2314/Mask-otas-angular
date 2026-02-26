<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('min_price') && $request->min_price != null) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != null) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();
        return view('shop.index', compact('products'));
    }

    public function stock()
    {
        $stocks = Product::select('id', 'stock')->get();
        return response()->json($stocks);
    }
}
