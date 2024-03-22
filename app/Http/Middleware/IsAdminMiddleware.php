<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        // Check if the user is authenticated and not an admin
        if (auth()->check() && ( auth()->user()->role_id == 1 OR auth()->user()->role_id == 5 ) ) {
            return $next($request);
        }
        abort(403 , 'Unauthorized ! This is only for admin'  );
    }    
}
