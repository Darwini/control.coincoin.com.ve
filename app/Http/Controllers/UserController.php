<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Auth;
use Session;
use Cookie;

class UserController extends Controller
{
    
       /**
         * @var object
         */
    private $client;
    
        /**
         * DefaultController constructor.
         */
    public function __construct()
    {
       //
    } 

    public function showAdmin(){

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
      
        //return response()->json([$request->all()], 200);
        //Hash::make($request->password),
   
            if (Auth::attempt(['email' => $request->username,
                                'password' => $request->password
                               // 'is_active' => true,'is_delete'=>false
                                ]))
            {
                // The user is active, not suspended, and exists.
                //$user = Auth::user();
                //$success['token'] =  $user->createToken('MyApp')->accessToken;
                Session::put("uno", "uno");
                return view('layouts.index');

            }else{

                return view('login')->with('error','PROBLEMAS!!');
            }

    }

    public function logOut()
    {
        Auth::logout();
        Session::flush();
        Cookie::forget('laravel_session');
        return view('login')
                ->with('mensaje_error','Tu sesion ha sido cerrada.');        
    }
    
    public function showLogin()
    {
        // Verificamos que el usuario no esta autenticado
        if (Auth::check())
        {
            // Si esta autenticado lo mandamos a la rai­z donde estara el mensaje de bienvenida.
            return redirect()->route('home');
        }
        // Mostramos la vista login.blade.php (Recordemos que .blade.php se omite.)
       
        return view('login');
    }

    public function showChangePasswordForm1(string $token = null, $email){
        $datos = ["token"=>$token, "email"=>$email];
        $user = DB::table('password_resets')
                ->where('email', $email)
                ->where('token', $token)
                ->orderBy('created_at', 'desc')
                ->first();

        if( $user ){
            return view('auth.passwords.cambiarclave2', compact($datos));
        }else{
            return redirect()->route('login'); 
        }
        
        
    }
    public function recoverPassword(Request $request){
        $validatedData = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = DB::table('users')
                ->where('email', $request->get('email'))
                ->get();

        $datos["password"] = bcrypt($request->get('password'));
        
        $res = DB::table('users')
                ->where('email' , $request->get('email'))
                ->update($datos);

        if ($res){
            Session::flash('message-success', 'Tu password ha sido cambiado');
            return redirect()->route('login'); 
        }
        
    }
}
