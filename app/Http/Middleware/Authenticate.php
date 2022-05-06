<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate 
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('LoggedUser')) {
            session()->put('loginfail',  __('auth.nologin'));
            return redirect('/');
        }
        return $next($request);
    }
}
