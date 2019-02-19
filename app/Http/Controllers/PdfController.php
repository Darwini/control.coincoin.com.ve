<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Ingreso;
use App\Models\Instalaciones;
use App\Models\Ubicacion;
use App\Models\FacturAlquiler;

use App\User;

use App\Models\Pdf\FPDF;
use App\Models\dompdf\src\Dompdf;
use DB;

class PdfController extends Controller
{

	public function Personall()
	{
		$personals=Worker::all();
    	return View('personal.pdf',['personals'=>$personals]);
	}

	public function Ingresos(Request $request)
	{
		if ($request->tipo=='todos') {
			$ingresos=DB::table('ingreso as i')->join('proveedores as p', 'i.proveedor_id', '=', 'p.id')->join('ingreso_detalles as di', 'i.id', '=', 'di.ingreso_id')->select('i.id', 'i.created_at', 'p.nombre', 'i.tipo_comprobacion', 'i.serial_comprobacion', 'i.numero_comprobacion', 'i.impuesto', 'i.status', DB::raw('sum(di.cantidad*precio_compra) as total'))->orderBy('i.id', 'desc')->groupBy('i.id', 'i.created_at', 'p.nombre', 'i.tipo_comprobacion', 'i.serial_comprobacion', 'i.tipo_comprobacion', 'i.impuesto', 'i.status')->get();
			return View('almacen.ingreso.pdf.todos', ['ingresos'=>$ingresos]);
		}
		else{
			$ingreso=Ingreso::where('id', $request->id)->get();
			if ($ingreso[0]->status==1) {
				return View('almacen.ingreso.pdf.especifico',['ingreso'=>$ingreso]);
			}
			else{
				Session::flash('message-warning', 'Los Detalles de ese Ingreso están Desactivados');
				return redirect()->route('ingresos');
			}
		}
	}

	public function Instalaciones(Request $request)
	{
		if ($request->tipo=='todos') {
			//$instalaciones=Instalaciones::OrderBy('created_at', 'asc')->get();
			$instalaciones=Ubicacion::OrderBy('created_at', 'asc')->get();
			return View('installers.install.pdf.todos', ['instalaciones'=>$instalaciones]);
		}
	}

	public function UsuariosPool(Request $request)
	{
		if ($request->tipo=='todos') {
			$users=User::where('roles_id','4')->where('group_id', '6')->get();
			return View('installers.usuarios.pdf.todos', ['users'=>$users]);
		}
	}

	public function FacturasVentas(Request $request)
	{
		if ($request->tipo=='todos') {
			$facturas=FacturAlquiler::all();
			return View('ventas.alquiler.pdf.facturas', ['facturas'=>$facturas]);
		}
		elseif(isset($request->id)) {
			$factura=FacturAlquiler::where('id', $request->id)->get();
			return View('ventas.alquiler.pdf.detalles_factura', ['factura'=>$factura]);
		}
	}
}
