<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use Closure, Session, Auth;

class IsUser
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
        $rol=Auth::user()->roles_id;
        $d=strtolower(Auth::user()->departamento->departamento);
        if ($rol <> 4 && $d <> 'cliente' ) {
            
            Session::flash('message-danger', 'no esta autorizado');
            return redirect()->route($d);
            
            if ($request->ajax()) {
                return response('NO ESTA AUTORIZADO.', 401);
            } else {
                Session::flash('message-danger', 'no esta autorizado');
                return redirect()->to('/login');
            }
        }
        return $next($request);
    }
}