<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$level)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $userLevel = Auth::user()->level;

            // Check if the user's level matches the allowed levels
            if (!in_array($userLevel, $level)) {
                // Redirect to the appropriate dashboard based on their role
                switch ($userLevel) {
                    case 'admin':
                        return redirect('/admin');
                    case 'karyawan':
                        return redirect('/karyawan');
                    case 'pemilik':
                        return redirect('/pemilik');
                    case 'apoteker':
                        return redirect('/apoteker');
                    case 'kasir':
                        return redirect('/kasir');
                }
            }
        }

        return $next($request);
    }
}
