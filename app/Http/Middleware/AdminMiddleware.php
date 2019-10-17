<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            Auth::logout();
            return redirect()->to('login');
        }; 

        if($this->auth->user()->acceso->cod_acceso == 'adm' ||
            $this->auth->user()->acceso->cod_acceso == 'master'){
            return $next($request);
        }else{
            return redirect()->to('home');
        }
/*
        if($this->auth->user()->acceso->cod_acceso != 'adm' ){
            return redirect()->to('home');
        }
        return $next($request);
*/        
    }
}
