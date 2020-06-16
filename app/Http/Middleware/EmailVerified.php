<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user() == null) {
            return redirect(route('login'));
        }

        $user = Auth::user();

        if (!$user->email_verified) {

            return redirect(route('login'));
        }


        return $next($request);
    }
}
