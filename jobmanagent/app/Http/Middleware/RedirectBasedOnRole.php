<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
public function handle($request, Closure $next, ...$roles)
{
    if (auth()->check() && auth()->user()->hasRole($roles)) {
        switch ($roles[0]) {
            case 'employee':
                return redirect('/employee/dashboard');
            case 'finance':
                return redirect('/finance/dashboard');
            case 'admin':
                return redirect('/admin/dashboard');
            case 'production':
                return redirect('/production/dashboard');
            // Add more roles as needed
            default:
                abort(403, 'Unauthorized action.');
        }
    }

    return $next($request);
}

}
