<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class undermaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next){              
        
        
        if(site_setting()->undermaintance == 1){ 
            return response()->view('employee.under_maintenance', [], 404);        
        }       
        return $next($request); 
    }
}
