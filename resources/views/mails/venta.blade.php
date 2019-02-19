<?php

use App\Models\FacturAlquiler as Factura;
use App\Models\Factura_Alquiler_Detalle as FDetalles;

$datos=Factura::latest('created_at')->first();
$dat=FDetalles::where('created_at', $datos->created_at)->where('factura_alquiler_id',$datos->id)->get();

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="{{asset('css/w3.css')}}">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<title>Detalles de Venta</title>
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
					Venta Nueva, existe una nueva venta, sus detalles son: 
				</div>
			</b>

			<div style="margin:5px;content:"";display:table;clear:both;width:100%;padding:16px">
            	<div style="content:"";display:table;clear:both;width:100%;padding:16px;">
                    <span style="float:left;width:49%">
						Cliente : {{strtoupper($datos->cliente->nombre)}} {{strtoupper($datos->cliente->apellido)}}<br>
                        Cedula : {{$datos->cliente->cedula}}<br>
                    </span>
                    <span style="float:left;width:49%">
                    Vendedor : 
                    @if(isset($datos->vendedoruser->personaluser->nombre) )
                        {{strtoupper($datos->vendedoruser->personaluser->nombre)}} {{strtoupper($datos->vendedoruser->personaluser->apellido)}}
                    @else
                        {{strtoupper($datos->vendedoruser->username)}}
                    @endif<br>
                    Fecha : {{$datos->created_at}}
                    </span>
                </div>
            </div>
		
            <div style="display:block;overflow-x:auto; margin-top:10%; margin-bottom:50px;width:99.99999%;margin-left: 1%;">
                <table border="0" style="border-collapse:collapse;border-spacing:0;width:90%;display:table;text-align:center;border:1px solid #ccc;font-size:13px!important;">
                    <thead>
                        <tr style="text-align:center; color:#000!important;background-color:#ff9800!important;border-bottom:1px solid #ddd;">
                            <th {{$i=1}} style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Nro</th>
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Categoría</th>
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">PVP</th>
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Cantidad</th>
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody {{$total=0}} {{$i=1}}>
                        @foreach($datos->detalles as $datoz)
                        <tr style="text-align:center;border-bottom:1px solid #ddd;">
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$i++}}</td>
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$datoz->producto[0]->nombre}}</td>
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$datoz->producto[0]->pvp}} $</td>
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">
                                {{$datoz->cantidad_solicitud}}
                                @if($datoz->cantidad_solicitud < 2)
                                    Unidad 
                                @else 
                                    Unidades 
                                @endif
                            </td>
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">
                                    {{$datoz->producto[0]->pvp * $datoz->cantidad_solicitud}} $
                            </td>
                        </tr>
                        <i style="display: none;">
                            {{$total=$total + ($datoz->producto[0]->pvp * $datoz->cantidad_solicitud)}}
                        </i>
                        @endforeach
                    </tbody>
                    <tfoot style="border-top: 1px solid orange;">
                        <tr>
                            <td colspan="5" style="text-align:left;padding:8px 8px;display:table-cell;vertical-align:top;">
                                <div style="float: right; text-align: left;">
                                    Total : {{$total}} $
                                </div>
                            </td>       
                        </tr>
                    </tfoot>
                </table>
            </div>
		</div>
		<footer style="margin-top: 2%;width: 100%; text-align: center; font-size: 9px;">&copy; Copyright 2018 CoinCoin - <a href="www.coincoin.com.ve">www.coincoin.com.ve</a> </footer>
	</body>
</html>
