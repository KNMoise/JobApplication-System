<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        // Check the user's role and redirect accordingly
        if ($user->hasRole('admin')) {
            return redirect()->route('/admin/dashboard');
        } elseif ($user->hasRole('employee')) {
            return redirect()->route('/employee/dashboard');
        } elseif ($user->hasRole('finance')) {
            return redirect()->route('/finance/dashboard');
        } elseif ($user->hasRole('production')) {
            return redirect()->route('/production/dashboard');
        } elseif ($user->hasRole('stock')) {
            return redirect()->route('/stock/dashboard');
        } else {
            // Default redirection for other roles or cases
            return redirect()->route('home');
        }
    }
}
