<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerificarDispocisionTecnicosDia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);

        // Verificar si existe el dato en la tabla
        $existe = DB::table('tecnicosdias')->where('fecha', Carbon::now()->toDateString())->exists();
        if ($existe)
        {
            // Si el dato existe, continuar con la ruta
            return $next($request);
        }
        // Si el dato no existe, redirigir a otra ruta
        return redirect()->route('page.mantenimiento');
    }
}
