<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DepartmentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$departments)
    {
        $userDepartment = auth()->user()->department;

        if (in_array($userDepartment, $departments)) {
            return $next($request);
        }

        return abort(403, 'Unauthorized action.');
    }
}
