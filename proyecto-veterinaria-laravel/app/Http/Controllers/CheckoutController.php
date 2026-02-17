<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Muestra la página de checkout simula
    public function create()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('checkout', compact('cart', 'total'));
    }

    // Procesa el pago simulado y guarda la orden
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'card_number' => 'required|numeric|digits:16', 
            'card_expiry' => 'required',
            'card_cvc' => 'required|numeric|digits:3',
            'items' => 'required|json', // Esperamos los items como JSON string desde el frontend
            'total' => 'required|numeric',
        ]);

        $user = Auth::user();

        // Crear la orden
        $order = Order::create([
            'user_id' => $user ? $user->id : null,
            'guest_name' => $user ? $user->nombre : 'Invitado', // O pedirlo en el form si no está logueado
            'guest_email' => $user ? $user->email : 'invitado@example.com', // O pedirlo en el form
            'total' => $request->total,
            'status' => 'completed',
            'items' => json_decode($request->items, true),
        ]);

        if ($request->wantsJson()) {
            // Limpiar carrito de la sesión
            session()->forget('cart');
            
            return response()->json([
                'success' => true,
                'message' => '¡Pedido realizado con éxito!',
                'redirect_url' => route('inicio'),
                'order_id' => $order->id
            ]);
        }

        return redirect()->route('inicio')->with('exito', '¡Pedido realizado con éxito! ID: ' . $order->id);
    }

    // Historial de pedidos del usuario
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('user.orders.index', compact('orders'));
    }
}
