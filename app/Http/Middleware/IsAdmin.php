<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;

use Closure;
use Auth;
use Session;
use Redirect;

class IsAdmin
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
        if ($departamento <> 'todos') {
            //Session::flash( 'message-danger' , 'Accesso Denegado');
            return redirect()->route($departamento);
            //Auth::logout();
            //if ($request->ajax()) {
            //    return response('NO ESTA AUTORIZADO.', 401);
            //} else {
            //    return redirect()->to('/login');
            //}
        }

        return $next($request);
    }
}