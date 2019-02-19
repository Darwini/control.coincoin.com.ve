<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use Closure;
use Auth;
use Session;

class IsInstaller
{
    protected $auth;

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
        $departamento=strtolower(Auth::user()->departamento->departamento);
        if ( $departamento <> 'todos') {
            if ( $departamento <> 'instalador') {
                Session::flash( 'message-danger' , 'Sin Autorizacion');
                return redirect()->route($departamento);
                /*$this->auth->logout();
                if ($request->ajax()) {
                    return response('NO ESTA AUTORIZADO.', 401);
                } else {
                    return redirect()->to('/login');
                }*/
            }    
        }
        
        return $next($request);
    }
}