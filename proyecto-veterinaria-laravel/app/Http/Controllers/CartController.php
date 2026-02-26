<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Traits\CartHelper;

class CartController extends Controller
{
    use CartHelper;

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock <= 0) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Lo sentimos, este producto no tiene stock disponible.'], 422);
            }
            return redirect()->back()->with('error', 'Lo sentimos, este producto no tiene stock disponible.');
        }

        $cartKey = $this->getCartKey();
        $cart = session()->get($cartKey, []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] >= $product->stock) {
                if ($request->wantsJson()) {
                    return response()->json(['error' => 'No puedes añadir más unidades de las disponibles en stock.'], 422);
                }
                return redirect()->back()->with('error', 'No puedes añadir más unidades de las disponibles en stock.');
            }
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put($cartKey, $cart);

        if ($request->wantsJson()) {
            return response()->json(['success' => 'Producto añadido al carrito exitosamente!', 'cart_count' => count($cart)]);
        }

        return redirect()->back()->with('success', 'Producto añadido al carrito exitosamente!');
    }

    public function showCart()
    {
        $cart = session()->get($this->getCartKey(), []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('shop.cart', compact('cart', 'total'));
    }

    public function removeFromCart($id)
    {
        $cartKey = $this->getCartKey();
        $cart = session()->get($cartKey);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put($cartKey, $cart);
        }
        return redirect()->back()->with('success', 'Producto eliminado del carrito exitosamente!');
    }

    public function increment($id)
    {
        $product = Product::findOrFail($id);
        $cartKey = $this->getCartKey();
        $cart = session()->get($cartKey);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] >= $product->stock) {
                return redirect()->back()->with('error', 'No puedes añadir más unidades de las disponibles en stock.');
            }
            $cart[$id]['quantity']++;
            session()->put($cartKey, $cart);
        }
        return redirect()->back();
    }

    public function decrement($id)
    {
        $cartKey = $this->getCartKey();
        $cart = session()->get($cartKey);
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                session()->put($cartKey, $cart);
            } else {
                unset($cart[$id]);
                session()->put($cartKey, $cart);
            }
        }
        return redirect()->back();
    }
}