<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilterIpMiddleware
{
    /**
     * Manejar la petición entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $key = 'requests_per_minute_' . $ip;

        $limit = 10;   // máximo
        $decay = 60;  // segundos

        // Crear la clave si no existe (con valor 0 y expira en $decay segundos)
        Cache::add($key, 0, $decay);

        // Incrementar contador
        $requests = Cache::increment($key);

        if ($requests > $limit) {
            return response()->json([
                'message' => 'Has superado el límite de 10 peticiones por minuto desde tu IP.'
            ], 429);
        }

        return $next($request);
    }

}
