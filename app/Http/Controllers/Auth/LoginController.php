<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\User;
use Auth, Validator, Redirect, Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    /**#//protected $redirectTo = '/home';*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('Logout');
    }


    public function Login(Request $request){

        if ( Auth::attempt([ 'username' => $request->email, 'password' => $request->password, 'status'=>'1' ] , $request->has('remember') ) ) {
            $departamento=strtolower(Auth::user()->departamento->departamento);
            return redirect()->route($departamento);
        }
        elseif (Auth::attempt([ 'email' => $request->email, 'password' => $request->password, 'status' => '1', ] , $request->has('remember') ) )
        {
 
            if(Auth::user()->first_login == 0){
                $user = Auth::user();
                $user->first_login = 1;
                $user->save();
            
                return redirect()->route('changePassword');
            }else{
                $departamento=strtolower(Auth::user()->departamento->departamento);
                return redirect()->route($departamento);
            }
        }
        else{
            $rules = [ 'email' => 'required', 'password' => 'required', ];
            
            $messages = [ 'email.required' => 'Este campo es requerido', 'password.required' => 'El campo password es requerido', ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
            Session::flash( 'message-danger' , 'Coincidencias No Encontradas' );
            return redirect('/login')->withErrors($validator)->withInput();
        }
    }


    public function logout()
    {
        Auth::logout();
        Session::flash('message-info','Session Cerrada');
        return View('auth.login');
    }
}
