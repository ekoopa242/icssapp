<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidacionRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rol = null, $rol2 = null): Response
    {
        // dd($rol, $rol2, Auth::user()->rol);
        if(Auth::user()->rol == $rol || Auth::user()->rol == $rol2){
            return $next($request);
        }else{
            abort(403, 'No tiene el rol requerido para acceder');
        }

    }
}
