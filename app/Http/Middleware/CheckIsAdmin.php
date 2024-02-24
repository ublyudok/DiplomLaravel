<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{

    public function handle($request, Closure $next)
    {

        if(!Auth::user()->isAdmin()){
            return redirect()->route('users');
        }

        return $next($request);
    }
}