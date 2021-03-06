<?php
use App\Models\dompdf\src\Dompdf;
$mipdf = new DOMPDF();
$mipdf->set_paper("A4", "portrait");
ob_start();
?>
<!DOCTYPE html>
<html>
  <head>
	<link rel="stylesheet" type="text/css" href="{{asset('css/w3.css')}}">
	<title>Personal</title>
  </head>
	
  <body class="w3-row">
	<div class="w3-container" style="margin: 10px 0px 20px 0px;">
	  <div class="w3-third">
		<img src="./assets/images/logo_inicio_tope.png" style="width: 70%;">
	  </div>

	  <div class="w3-small w3-third" style="text-align:center;">
		República Bolivariana de Venezuela<br>
		Zona Industrial San Vicente II<br>
		CoinCoin
	  </div>

	  <small class="w3-third w3-tiny" style="text-align: right;">{{date('d/m/y h:i:s')}}</small>
	</div>

	<div class="w3-row" style="margin: 35px 0px 35px 0px;">
	  <div class="w3-center w3-large" style="margin: 20px 0px 20px 0px;">
		<b>Personal Con Acceso al Sistema</b>
	  </div>

	  @if(isset($personals) and count($personals) > 0)
		<table class="w3-table-all w3-tiny w3-centered w3-border w3-border-orange" style="margin: 30px 0px 30px 0px;">
		  <thead>
			<tr class="w3-orange" >
			  <th {{$i=1}}>#</th>
			  <th>Cédula</th>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Departamento</th>
              <th>Usuario</th>
              <th>Correo</th>
              <th>Estatus</th>
			</tr>
		  </thead>

		  <tbody>
			@foreach($personals as $persona)
			  <tr>
				<td>{{$i++}}</td>
				<td>{{$persona->cedula}}</td>
				<td>{{$persona->nombres}}</td>
                <td>{{$persona->telefono}}</td>
                <td>{{$persona->user->departamento->departamento}} </td>
                <td>{{$persona->user->username}}</td>
                <td>{{$persona->user->email}}</td>
                <td>
                  @if($persona->status == 1)
                    <span class="w3-text-green">Activo</span>
                  @elseif($persona->status == 0)
                    <span class="w3-text-red">Desactivado</span>
                  @endif
                </td>
              </tr>
			@endforeach
		  </tbody>
		</table>
	  @endif
	</div>
  </body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
//$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

$mipdf->load_html($html, 'UTF-8');
$mipdf->render();

$canvas = $mipdf->get_canvas(); 
$canvas->page_text(525, 16, "Pág. {PAGE_NUM}/{PAGE_COUNT}", 'times', 6, array(0,0,0));
$canvas->page_text(235, 792, "Copyright © 2018 - CoinCoin - www.coincoin.com.ve", 'times', 6, array(0,0,0));

$mipdf->stream('Personal.pdf');

