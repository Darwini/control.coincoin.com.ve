<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="{{asset('css/w3.css')}}">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<title>Detalles de Instalación</title>
	</head>
	
	<body style="width:96%; margin:2% 40% 2% 2%; padding: 2% 5% 2% 2%; content:"";display:table;clear:both; box-shadow:0 4px 10px 0 rgba(0,0,0,0.2),0 4px 20px 0 rgba(0,0,0,0.19);">
		<div style="">
			<div class="w3-third">
				<img src="{{asset('assets/images/logo_inicio_tope.png')}}" style="width: 25%;">
			</div>
		</div>
		
		<div style="padding:16px; width:100%;">
			<br>
			<b>
				<div style="text-align: center; display:block;margin-bottom:40px; font-size:16px;">
					Nueva Instalación se ha registrado, sus detalles son : 
				</div>
			</b>

			<div style="margin:5px;content:"";display:table;clear:both;width:100%;padding:16px">
            	<div style="content:"";display:table;clear:both;width:100%;padding:16px;">
                    <span style="float:left;width:49%; text-transform: capitalize;">
						Cliente : {{$nombre}} {{$apellido}}<br>
                        {{-- Cliente : {{strtoupper($nombre)}} {{strtoupper($apellido)}}<br> --}}
						Cedula : {{$cedula}}<br>
                    </span>
                    <span style="float:left;width:49%; text-transform: capitalize;" >
                    Instalador : {{strtoupper($instalador)}}<br>
                    Fecha : {{$fecha}}
                    </span>
                </div>
            </div>
		
            <div style="display:block;overflow-x:auto; margin-top:12%; margin-bottom:50px;width:97.99999%">
            	<table border="0" style="border-collapse:collapse;border-spacing:0;width:98%;display:table;text-align:center;border:1px solid #ccc;font-size:10px!important;">
            		<thead>
                        <tr style="text-align:center; color:#000!important;background-color:#ff9800!important;border-bottom:1px solid #ddd;">
                            <th {{$i=1}} style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Nro</th>
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Modelo</th>
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Serial Equipo</th>
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Serial Fuente</th>
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Ubicación</th>
                        </tr>
                    </thead>

                    <tbody {{$i=1}}>
                    	@foreach($datoz as $dat)
                        <tr style="text-align:center;border-bottom:1px solid #ddd;">
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$dat->id}}</td>
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$dat->modelo}}</td>
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$dat->serial_equipo}}</td>
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$dat->serial_fuente}}</td>
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$dat->rack->rack}} Posición {{$dat->posicion}}</td>
                        </tr>
                        @endforeach
                    </tbody>

				</table>
			</div>
		</div>
		<footer style="margin-top: 2%;width: 100%; text-align: center; font-size: 9px;">&copy; Copyright 2018 CoinCoin - <a href="www.coincoin.com.ve">www.coincoin.com.ve</a> </footer>
	</body>
</html>
