<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class MyAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
            $path=$request->path();
            //dd(session()->has('email'));
            // dd(Session::get('email'));
            if($path==='/' && Session::get('email')){
                return redirect('/totaluser');
            }
            if($path!=='/' && !Session::get('email')){
                return redirect('/');
            }
            return $next($request);
            // if($path!=='/' && Session::get('email')){
            //     return redirect('/activeuser');
                
            // }
            // else {
            //     if($path==='/' && !Session::get('email')){
            //         return $next($request);
            //     }
            //     // abort(401);
            //     return redirect('/activeuser');
            //     // return redirect('/');
            // }

        // if(session()->has('email')){
            
        // }
        // abort(401);
            
        
        // if(session('email')){
            
        
        // }
        // return $next($request);
        // else
         
        // return redirect('/');
    }
}
