<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;


class AsesorMiddleware
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
        if($this->auth->user()->tuser == 'Asesor' || 
            $this->auth->user()->tuser == 'Master'){
            return $next($request);
        }else{
            return redirect()->to('home');
        }
   
    }
}
