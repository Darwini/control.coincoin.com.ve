<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth, Redirect, Response, Session;

use App\User;
use App\Models\Sala, App\Models\Area, App\Models\Rack;
use App\Models\Ubicacion;

use Mail, DB;

class InstaladoresController extends Controller
{
	public function index()
	{
		$salas=Sala::orderBy('sala', 'asc')->get();
		$ubicaciones=Ubicacion::where('status','1')->get();
		return View('installers.index',['salas'=>$salas,'ubicaciones'=>$ubicaciones]);
	}

	public function ViewCrearInstalacion(Request $request)
	{
		return View('installers.instalacion.crear', ['salas' => Sala::orderBy('sala', 'asc')->get()]);
	}

	public function ViewUsuariosEquipos()
	{
		$clientes=User::where('roles_id','4')->where('group_id', '6')->orderBy('username', 'asc')->get();
		return View('installers.instalacion.show', [ 'clientes' => $clientes, ]);
	}

	public function HistorialInstalaciones()
	{
		$instalaciones=Ubicacion::OrderBy('created_at', 'desc')->get();
		return View('installers.instalacion.mostrar', [ 'instalaciones' => $instalaciones, ]);
	}

	public function ajaxbuscarcliente(Request $request, $cedula)
	{
		if ($request->ajax()){
			$cliente=Cliente::where('cedula', $cedula)->get();
			if ( count($cliente) > 0 ) {
				return response()->json($cliente);
			}
		}
	}

	public function ajaxbuscarusuario(Request $request, $username)
	{
		if ($request->ajax() ) {
			$usuario=User::where('username', $username)->get();
			$usuario2=User::where('username', strtolower($username) )->get();
			
			if ( count($usuario) > 0 ) {
				return response()->json('1');
			}
			elseif (count($usuario2) > 0 ) {
				return response()->json('1');
			}

		}
	}

	public function AsignarUsuarioCliente(Request $request){
		//return $request;
		$usuario=strtolower($request->username);
		$email=strtolower($request->email);
		$password=bcrypt('123456');
		
		/*DB::beginTransaction(function()
		{*/
			if ($request->cobranza=='porcentaje') {
				$porcentaje=$request->dcantidad;
				$deduccion=0;
			}
			elseif ($request->cobranza=='deduccion') {
				$deduccion=$request->dcantidad;
				$porcentaje=0;
			}

			User::create(['username' => $usuario, 'email' => $email, 'puid' => $request->puid, 'password' => $password,
				'remember_token' => $request->_token, 'roles_id' => 4, 'group_id' => 6, 'deduccion'=>$deduccion,
				'porcentaje'=>$porcentaje, 'pool'=>$request->pool, 'cobranza'=>$request->cobranza ]);
			
			if (isset($request->persona_id) and $request->persona_id!='') {
				Cliente::find($request->persona_id)->update(['user_id' => $user->id]);
			}
		/*});*/
		Session::flash('message-success', 'Registro Creado Correctamente');
		return redirect()->route('usuarios.pool');
	}

	public function ViewUPool()
	{
		$usr=User::where('roles_id','4')->where('group_id', '6')->orderBy('username','asc')->get();
		return View('installers.usuarios.mostrar', [ 'users'=>$usr ]);
	}

	public function EditarUPool(Request $request)
	{
		//return $request;
		$usuario=strtolower($request->username);
		$email=strtolower($request->email);
		if (!empty($request->password)) {
			$password=bcrypt($request->password);
		}
		
		/*DB::beginTransaction(function()
		{*/
			if(isset($request->cobranza)){
				if ($request->cobranza=='porcentaje') {
					$porcentaje=$request->dcantidad;
					$deduccion=0;
				}
				elseif ($request->cobranza=='deduccion') {
					$deduccion=$request->dcantidad;
					$porcentaje=0;
				}

				if (!empty($password)) {
					User::findOrFail($request->id)->update([ 'username' => $usuario, 'email' => $email, 'puid' => $request->puid, 'password' => $password, 'roles_id' => 4, 'group_id' => 6,'deduccion'=>$deduccion, 'porcentaje'=>$porcentaje, 'pool'=>$request->pool,'cobranza'=>$request->cobranza,'url_pool'=>$request->url_pool ]);
				}else{
					User::findOrFail($request->id)->update([ 'username' => $usuario, 'email' => $email, 'puid' => $request->puid, 'roles_id' => 4, 'group_id' => 6,'deduccion'=>$deduccion, 'porcentaje'=>$porcentaje, 'pool'=>$request->pool,'cobranza'=>$request->cobranza, 'url_pool'=>$request->url_pool ]);
				}
			}
			else{
				return back()->withInput();
			}
			if (isset($request->persona_id) and $request->persona_id!='') {
				Cliente::find($request->persona_id)->update(['user_id' => $user->id]);
			}
		/*});*/
		
		Session::flash('message-success', 'Datos Actualizados');
		return redirect()->route('usuarios.pool');
	}
	
	public function ViewZonas()
	{
		return View('installers.zonas.mostrar', [ 'racks'=>Rack::orderBy('rack', 'asc')->get(), 'areas'=>Area::orderBy('area', 'asc')->get(), 'salas'=>Sala::orderBy('sala', 'asc')->get() ]);
	}

	public function CrearZonaR(Request $request)
	{
		Rack::create(['rack'=>$request->rack, 'area_id'=>$request->area_id, 'filas'=>$request->filas, 'columnas'=>$request->columnas]);
		Session::flash('message-success', 'Registro Creado Correctamente');
		return redirect()->route('zonas.espacios');
	}
	
	public function EditarZonaR(Request $request)
	{
		Rack::findOrFail($request->id)->update(['rack'=>$request->rack, 'area_id'=>$request->area_id, 'filas'=>$request->filas, 'columnas'=>$request->columnas]);
		Session::flash('message-success', 'Edición Realizada Correctamente');
		return redirect()->route('zonas.espacios');
	}

	public function CrearZonaA(Request $request)
	{
		Area::create(['area'=>$request->area, 'sala_id'=>$request->sala_id, 'descripcion'=>$request->descripcion]);
		Session::flash('message-success', 'Registro Creado Correctamente');
		return redirect()->route('zonas.espacios');
	}

	public function EditarZonaA(Request $request)
	{
		Area::findOrFail($request->id)->update(['area'=>$request->area, 'sala_id'=>$request->sala_id, 'descripcion'=>$request->descripcion]);
		Session::flash('message-success', 'Registro Editado Correctamente');
		return redirect()->route('zonas.espacios');
	}

	public function CrearZonaS(Request $request)
	{
		Sala::create(['sala'=>$request->sala, 'descripcion'=>$request->descripcion]);
		Session::flash('message-success', 'Registro Creado Correctamente');
		return redirect()->route('zonas.espacios');
	}

	public function EditarZonaS(Request $request)
	{
		Sala::findOrFail($request->id)->update(['sala'=>$request->sala, 'descripcion'=>$request->descripcion]);
		Session::flash('message-success', 'Se Ha Editado un Registro Correctamente');
		return redirect()->route('zonas.espacios');
	}

	public function ViewMinerosPool(Request $request)
	{
		$user=User::where('id', $request->id)->get();
		return View('installers.usuarios.equipool', ['user' => $user]);
	}

	public function ViewMinersClient(Request $request)
	{
		$user=User::where('id', $request->id)->get();
		$salas=Sala::orderBy('sala', 'asc')->get();
		$ubicaciones=Ubicacion::where('status','1')->orderBy('rack_id')->get();

		$misequiposubicados=Ubicacion::where('cliente_user_id', $request->id)->where('status','1')->orderBy('rack_id', 'asc')->get();
		return View('installers.poolminers.mostrar', ['user'=>$user, 'salas'=>$salas, 'ubicaciones'=>$ubicaciones, 'mios'=>$misequiposubicados ]);
	}

	public function ProcesarPool(Request $request)
	{
		//return $request;
		try {
			DB::beginTransaction();
			if (isset($request->rack_id) && count($request->rack_id)>0 ) {
				for ($i=0; $i <count($request->rack_id) ; $i++) {
					if ($request->rack_id[$i] <> '' ) {
						$actualizar=Ubicacion::where('minero_id',$request->minero_id[$i])->update(['rack_id'=>$request->rack_id[$i], 'posicion'=>$request->posicion[$i] ]);
					}					
/*$actualizar=new Ubicacion();$actualizar->findOrFail($request->id_ubicacion[$i]);$actualizar->rack_id=$request->rack_id[$i];$actualizar->posicion=$request->posicion[$i];*/
				}
			}
			if (isset($request->newrack_id) && count($request->newrack_id)>0 ) {
				for($i=0; $i<count($request->newrack_id); $i++){
					$ubicar=new Ubicacion();
					$ubicar->cliente_user_id = $request->cliente_user_id;
					$ubicar->instalador_user_id = $request->instalador_user_id;
					$ubicar->minero_id = $request->newminero_id[$i];
					$ubicar->minero_nombre = $request->newminero_nombre[$i];
					if ($request->newserial_equipo) {
						$ubicar->serial_equipo = $request->newserial_equipo[$i];
					}
					if ($request->newserial_fuente) {
						$ubicar->serial_fuente = $request->newserial_fuente[$i];
					}
					if (isset($request->newrack_id)) {
						$ubicar->rack_id = $request->newrack_id[$i];
						$ubicar->posicion = $request->newposicion[$i];
					}
					$ubicar->status = '1';
					if (isset($request->newmodelo)) {
						$ubicar->modelo = $request->newmodelo[$i];
					}
					$ubicar->save();
				}
			}
			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Session::flash('message-danger', 'Operación Cancelada');
			return redirect()->route('usu.equipos');
		}
		Session::flash('message-success', 'Operación Realizada con Éxito');
		/* //return redirect()->route('mail.instalacion'); */
		return redirect()->route('usu.equipos');
	}

	public function DeleteMiner(Request $request)
	{
		//return $request;
		$minero=Ubicacion::where('id', $request->id)->where('minero_id', $request->miner_id)->update(['status' => 0]);
		
		if (isset($borrarserialequipo)) {
			EquipoDetalles::where('serial', $minero->serial_equipo)->update(['serial_status'=>0]);
		}

		if (isset($borrarserialfuente)) {
			EquipoDetalles::where('serial', $minero->serial_fuente)->update(['serial_status'=>0]);
		}
		
		Session::flash('message-success','Los Datos del Minero han sido Suprimidos');
		return redirect()->route('usu.equipos');
	}
}