<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Inventoryauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
     public function handle(Request $request, Closure $next){
        
        $uri = $request->segment(2);
        
        if($uri != '' && $uri != 'login'){ 
            if(Session::get('invuser_id') == ''){
                return redirect('/inventory');
            }
            return $next($request);
        }else{
            return $next($request);
        }
        
    
    }
}
