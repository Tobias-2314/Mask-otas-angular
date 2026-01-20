<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar que el usuario esté autenticado
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        // Verificar que el usuario sea admin (es_admin = 1)
        if (!auth()->user()->es_admin) {
            abort(403, 'No tienes permisos para acceder a esta área');
        }

        return $next($request);
    }
}
