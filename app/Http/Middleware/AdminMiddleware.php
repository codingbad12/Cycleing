<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Require authentication
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Check admin role via is_admin flag
        if (!Auth::user()->is_admin) {
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'You do not have admin privileges.']);
        }

        return $next($request);
    }
}