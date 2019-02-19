<?php
use App\Models\Ingreso;
use App\Models\IngresoDetalle as IDetalle;

$datos=Ingreso::latest('created_at')->first();
$dat=IDetalle::where('created_at', $datos->created_at)->where('ingreso_id',$datos->id)->get();
$dato=['proveedor'=>$datos->proveedor->nombre, 'cod_proveedor'=>$datos->proveedor->cod_rif,'fecha'=>$datos->created_at, 'datoz'=>$dat ];
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="{{asset('css/w3.css')}}">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<title>Detalles de Ingreso al Almacén</title>
	</head>
	
	<body style="width:96%; margin:2% 40% 2% 1%; padding: 2% 5% 2% 2%; content:"";display:table;clear:both; box-shadow:0 4px 10px 0 rgba(0,0,0,0.2),0 4px 20px 0 rgba(0,0,0,0.19);">
		<div style="">
			<div class="w3-third">
				<img src="{{asset('assets/images/logo_inicio_tope.png')}}" style="width: 25%;">
			</div>
		</div>
		
		<div style="padding:16px; width:98%;">
			<br>
			<b>
				<div style="text-align: center; display:block;margin-bottom:40px; font-size:15px;padding-right:3%;">
					Ingreso Nuevo, con el objetivo de supervisar se notifica de un nuevo ingreso al almacén, la información de este se presenta a continuación: 
				</div>
			</b>

			<div style="margin:5px;content:"";display:table;clear:both;width:100%;padding:16px">
            	<div style="content:"";display:table;clear:both;width:100%;padding:16px;">
                    <span style="float:left;width:49%">
						Proveedor : {{$proveedor}} {{$cod_proveedor}}<br>
                    </span>
                    <span style="float:left;width:49%">
                        Fecha : {{$fecha}}
                    </span>
                </div>
            </div>
		
            <div style="display:block;overflow-x:auto; margin-top:10%; margin-bottom:50px;width:96.99999%">
            	<table border="0" style="border-collapse:collapse;border-spacing:0;width:99%;display:table;text-align:center;border:1px solid #ccc;font-size:10px!important;">
            		<thead>
                        <tr style="text-align:center; color:#000!important;background-color:#ff9800!important;border-bottom:1px solid #ddd;">
                            <th {{$i=1}} style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Nro
                            </th>
                            
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Producto
                            </th>
                            
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Costo
                            </th>
                            
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">PVP
                            </th>
                            
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Cantidad
                            </th>
                            
                            <th style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">Subtotal
                            </th>
                        </tr>
                    </thead>

                    <tbody {{$total=0}} {{$i=1}}>
                    	@foreach($datos->detalles as $dat)
                        <tr style="text-align:center;border-bottom:1px solid #ddd;">
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$i++}}
                            </td>

                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$dat->productos[0]->nombre}}
                            </td>
                            
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$dat->productos[0]->costo}}</td>
                            
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">{{$dat->productos[0]->pvp}}</td>

                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">
                                {{$dat->cantidad}}
                                @if($dat->cantidad < 2)
                                    Unidad 
                                @else 
                                    Unidades 
                                @endif
                            </td>
                            
                            <td style="text-align:center;padding:8px 8px;display:table-cell;vertical-align:top;">
                                    {{$dat->productos[0]->costo * $dat->cantidad}} $
                            </td>
                        </tr>
                        <i style="display: none;">
                            {{$total=$total + ($dat->productos[0]->costo * $dat->cantidad)}}
                        </i>
                        @endforeach
                    </tbody>
                    <tfoot style="border-top: 1px solid orange;">
                        <tr>
                            <td style="text-align:left;padding:8px 8px;display:table-cell;vertical-align:top;" colspan="6">
                                <div style="float: right;">
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
