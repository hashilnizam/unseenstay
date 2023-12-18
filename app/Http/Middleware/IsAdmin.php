<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $userType = Auth::user()->user_type;
        if ($userType === 'admin'){ 
            return $next($request);
        }else{
            return redirect()->route('unseen.index')->with('error', "You don't have admin access.");
        }           
    }
}
