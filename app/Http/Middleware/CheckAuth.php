<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        
        $uri = $request->segment(1);


        
        
        if($uri != '' && $uri != 'about-us'  && $uri != 'training-course'  && $uri != 'contact' && $uri != 'web-development' && $uri != 'software-development' && $uri != 'mobile-app-development' && $uri != 'digital-marketing'  && $uri != 'cybersecurity' && $uri != 'software-development' && $uri != 'BraveSparkLogin' && $uri != 'login' && $uri != 'excel'){ 
            if(Session::get('hruser_id') == ''){
                return redirect('/');
            }
            return $next($request);
        }else{
            return $next($request);
        }
       
    
    }
}
