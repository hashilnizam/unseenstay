<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IsAdmin{

    
public function handle(Request $request, Closure $next)
    {   
        if(Auth::check()){
            $userType = auth()->user()->user_type;
            if ($userType === 'admin'){
                return $next($request);
            }else{
                Auth::logout();
                return redirect()->route('index_login')->with('error', "You don't have admin access.");
            }           
        }else{

        //dd("hhhuh");
                return redirect()->route('index_login')->with('error', "You don't have admin access.");
        }
    }
}
