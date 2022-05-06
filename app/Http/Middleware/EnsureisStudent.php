<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;

class EnsureisStudent
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('LoggedUser')) {
            $value = session()->get('LoggedUser');
            if($value->role != 0){
                return redirect('/');
            }
        }
        return $next($request);
    }
}
