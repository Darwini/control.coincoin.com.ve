<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Notifications\MyResetPassword;
use Session;
use Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      return redirect()->route('todos');
    }

    public function showChangePasswordForm(){
        return view('auth.passwords.cambiarclave');
    }
    
    public function changePassword(Request $request){
       /* if ($request->get('email') != Auth::user()->email) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }*/
        
 
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        //Change Password
        //$user = User::where('email','=', $request->get('email'));
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));

        if ($user->save()){
            Session::flash('message-success', 'Tu password ha sido cambiado');
            return redirect('/');
     
        }
    }
   
}
