<?php
use App\Models\Instalaciones;

$datos=Instalaciones::latest('created_at')->first();
$dat=Instalaciones::where('created_at', $datos->created_at)->where('cliente_id',$datos->cliente_id)->get();

$dato=['nombre'=>$datos->installclient->nombre, 'instalador'=>$datos->installer->username,'fecha'=>$datos->created_at, 'apellido'=>$datos->installclient->apellido, 'cedula'=>$datos->installclient->cedula, 'datoz'=>$dat]
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="{{asset('css/w3.css')}}">
		<title>Detalles de Instalación</title>
	</head>
	
	<body style="width:96%; margin:2% 40% 2% 2%; padding: 2% 5% 2% 2%; content:"";display:table;clear:both; box-shadow:0 4px 10px 0 rgba(0,0,0,0.2),0 4px 20px 0 rgba(0,0,0,0.19);">
		<div style="">
			<img src="{{asset('assets/images/logo_inicio_tope.png')}}" style="width: 20%;">
		</div>
		
		<div>
			<br>
			<div style="display:block;margin-bottom:40px;font-size: 16px; font-weight: bolder;color: black;">
                Nueva Instalación registrada, los detalles son : 
			</div>

			<div style="width:100%; margin-bottom: 25px; color: black;">
            	<div style="width: 100%;">
                    <span style="float: left;">
                        Cliente : {{$datos->installclient->nombre}}<br>
                        Cedula  : {{$datos->installclient->cedula}}<br>
                    </span>
                    
                    <span style="float: right;">
                        Instalador : {{$datos->installer->username}}<br>
                        Fecha : {{$datos->created_at}}<br>
                    </span>
                </div>
            </div>
		
            <div style="width: 100%; overflow-x: auto; margin-top: 14%;">
            	<table class="w3-table w3-centered" border="1" style="font-size: 13px;border: solid 1px #ff9800;">
            		<thead>
                        <tr style="background: #ff9800; color:black;">
                            <th {{$i=1}}>Nro</th>
                            <th>Modelo</th>
                            <th>Serial Equipo</th>
                            <th>Serial Fuente</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($dat as $datoz)
                        <tr>
                            <td>{{$datoz->id}}</td>
                            <td>{{$datoz->modelo}}</td>
                            <td>{{$datoz->serial_equipo}}</td>
                            <td>{{$datoz->serial_fuente}}</td>
                            <td>{{$datoz->rack->rack}} Posición :{{$datoz->posicion}}</td>
                        </tr>
                        @endforeach
                    </tbody>
				</table>
			</div>
		</div>
        <footer style="margin-top: 6%;width: 100%; text-align: center; font-size: 9px;">&copy; Copyright 2018 CoinCoin - <a href="www.coincoin.com.ve">www.coincoin.com.ve</a> </footer>
	</body>
</html>