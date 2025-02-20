<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use DB;

class Employeeauth
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
        
        if($uri != '' && $uri != 'students' && $uri != 'login' &&  $uri != 'logout'){ 
            if(Session::get('empuser_id') == ''){
                return redirect('/students');
            }

            if(Session::get('empuser_id') != ''){
              
                $check_user = DB::table('user_info')->where('status', 1)->where('userid',Session::get('empuser_id'))->count();

                if($check_user == 0){
                    return redirect('/employees/logout');
                }
                return $next($request);
                
            }
            return $next($request);
        }else{
            return $next($request);
        }
        
    
    }}
