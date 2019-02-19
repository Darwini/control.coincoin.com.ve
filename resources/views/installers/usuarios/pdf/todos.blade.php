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
		<title>Usuarios Clientes</title>
	</head>
	
	<body>
		<div class="w3-container" style="margin: 10px 0px 20px 0px;">
			<div class="w3-third">
				<img src="./assets/images/logo_inicio_tope.png" style="width: 70%;">
			</div>

			<div class="w3-small w3-third w3-center" style="text-align: center;">
				República Bolivariana de Venezuela<br>
				Zona Industrial San Vicente II<br>
				CoinCoin
			</div>
			
			<small class="w3-third w3-tiny" style="text-align: right;">{{date('d/m/y h:i:s')}}</small>
		</div>
		
		<div style="margin: 35px 0px 35px 0px;">
			<div class="w3-center w3-large" style="margin: 20px 0px 20px 0px;">
				<b>Usuarios de los Clientes</b>
			</div>
		
			@if(isset($users) && count($users) > 0 )
			<table class="w3-table-all w3-tiny w3-centered w3-border w3-border-orange" style="margin: 30px 0px 30px 0px;">
				<thead>
                    <tr class="w3-orange">
                        <th {{$i=1}} >#</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Pool</th>
                        <th>Conexion Wallets</th>
                    </tr>
                </thead>
                        
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->pool}}</td>
                            <td>{{$user->puid}}</td>
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
$mipdf->load_html($html, 'UTF-8');
$mipdf->render();
$canvas = $mipdf->get_canvas(); 
$canvas->page_text(525, 16, "Pág. {PAGE_NUM}/{PAGE_COUNT}", 'times', 6, array(0,0,0));
$canvas->page_text(235, 792, "Copyright © 2018 - CoinCoin - www.coincoin.com.ve", 'times', 6, array(0,0,0));
$mipdf->stream('Usuarios_Clientes.pdf');
