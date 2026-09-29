<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kagua kama user amelogin
        // 2. Kagua kama user ana sifa ya is_admin (thibitisha jina la column kwenye database yako)
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Kama siyo admin, mrudishe home na ujumbe wa kosa
        return redirect('/')->with('error', 'Huna ruhusa ya kuingia katika eneo hili la viongozi.');
    }
}