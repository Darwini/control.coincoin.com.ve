<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker; 
use App\Models\Departamento;
use App\Role, App\User;
use DB;
class AdminController extends Controller
{
    // Display a listing of the resource.
    // Método GET | URL : Admin
    public function index()
    {
      $worker = Worker::orderBy('id','asc')->paginate(20);
      $roles = Role::where('id', '<>', 1)->where('id', '<>', 2)->where('id', '<>', 4)->orderBy('id','asc')->get();
      $deps = Departamento::where('id', '<>', 1)->where('id', '<>', 6)->orderBy('id','asc')->get();

      return View('personal/index', ['personal' => $worker, 'roles' => $roles, 'deps' => $deps ]);
    }

    // Show the form for creating a new resource.
    // Método GET | URL : Admin/create
    public function create()
    {
        //
    }

    // Store a newly created resource in storage.
    // Método POST | URL : Admin
    public function store(Request $request)
    {
        // return $request;
      $usuario=strtolower($request->username);
      $email=strtolower($request->email);
      $password=bcrypt($request->password);
      try {
        DB::beginTransaction();
        $cuser = User::create(['username' => $usuario, 'email' => $email, 'password' => $password, 'remember_token' => $request->_token, 'roles_id' => $request->roles_id, 'group_id' => $request->group_id ]);
        if($cuser){
          Worker::create(['cedula'=>$request->cedula,'nombres'=>$request->nombres,'telefono'=>$request->telefono,'user_id' => $cuser->id ]);
        }
        DB::commit();
        return redirect('Admin')->withSuccess('Registro Creado Correctamente');
      }
      catch (Exception $e) {
          DB::rollback();
          return back()->withInputs();
      }
    }

    // Display the specified resource.
    // Método GET | URL : Admin/{id}
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Método GET | URL : Admin/{id}/edit
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Método : PUT | URL : Admin/{id} | Ruta : Admin.update
    public function update(Request $request, $id)
    {
        return 'hola';
    }

    // Remove the specified resource from storage.
    // Método Delete | URL : Admin/{id}
    public function destroy($id)
    {
        //
    }
}
