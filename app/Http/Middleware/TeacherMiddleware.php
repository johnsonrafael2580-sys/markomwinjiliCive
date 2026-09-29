<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kama ameingia na ni mwalimu au admin, mruhusu apite
        if (Auth::check() && (Auth::user()->role === 'teacher' || Auth::user()->is_admin)) {
            return $next($request);
        }

        // Kama sivyo, mpe kosa la kuzuiliwa
        abort(403, 'Huna mamlaka ya kuingia ukurasa wa walimu.');
    }
}