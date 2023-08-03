<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        if (!Auth::check())
            throw new AuthException(message: 'Unauth', status: 401);

        $user = Auth::user();

        foreach($roles as $role) {
            if($user->hasRole($role))
                return $next($request);
        }
        throw new AuthException(message: 'You dont have permissions.', status: 401);
    }
}
