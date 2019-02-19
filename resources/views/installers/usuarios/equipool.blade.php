@extends('layouts.admin.default')

@section('title', 'CoinCoin | Detalles Usuarios/Equipos')

@section('breadcrum')
  <div class="col-md-5 align-self-center">
    <h4 class="w3-text-black font-bold">Equipos - Pool</h4>
  </div>
                        
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{route('instalador')}}" class="text-warning font-bold">Inicio</a>
      </li>
      
      <li class="breadcrumb-item">
        <a href="{{route('usu.equipos')}}" class="text-warning font-bold">Usuarios/Equipos</a>
      </li>

      <li class="breadcrumb-item w3-text-black active">Equipos - Pool</li>
    </ol>
  </div>
@stop

@section('scripts')
	<script src="{{asset('assets/plugins/footable/js/footable.all.min.js')}}"></script>
  <script src="{{asset('assets/js/footable-init.js')}}"></script>
  <link href="{{asset('assets/plugins/footable/css/footable.core.css')}}">
    <div class="w3-hide">
    <img id="mineroactivo" class="{{asset('assets/images/minero_100_operativo.gif')}}">
    <img id="minerodañado" class="{{asset('assets/images/minero_dañado.png')}}">
    <img id="minerobajo" class="{{asset('assets/images/minero_bajo_rendimiento.gif')}}">
	</div>
	
	<span id="url" value="{{url('/')}}"></span>
	
	<script type="text/javascript">
		function mismineros(puid) {
			var uri=$("#url").attr('value');
      var yuri=uri+'/user/pool/miner/'+puid;
      var rojo=0; var amarillo=0; var hash_promedio=0; var cant=0;
      var minerodañado,mineroactivo, minerobajo; var hash=0; var _mascad='';
      
      minerodañado=$("#minerodañado").attr('class');
      mineroactivo=$("#mineroactivo").attr('class');
      minerobajo=$("#minerobajo").attr('class');
      
      $.get( yuri, function(datos){
        $.each(datos.masdatos, function(ind,masd){
          var all=masd.mineros_total;
          var activos=masd.mineros_activos;
          $("#all").html(all);
          $("#activos").html(activos);
        });

        $.each(datos.datos, function(indice1,variable){
          _cad = '';
          $.each(variable, function(subindice,minero){
            estatus ='';
            if( minero.hash_1m==0 && minero.hash_15m==0 ){
              rojo=rojo+1;
              estatus = '<img style="width:32px;" class="w3-round" src="'+minerodañado+'">';
            }
            else if(minero.hash_15m < 6 && minero.hash_1m < 6 ){
              amarillo=amarillo+1;
              estatus = '<img style="width:32px;" class="w3-round" src="'+minerobajo+'">';
            }
            else if(minero.hash_15m > 6)
            {
              estatus = '<img style="width:32px;" class="w3-round" src="'+mineroactivo+'">';
            }
            cant=cant+1;
            hash= (hash) + parseFloat(minero.hash_15m);
            _cad +=`<tr>
                    <td id="minr"> ${minero.mineros_id} </td>
                    <td> ${minero.mineros_nombre} </td>
                    <td> ${minero.hash_1m} ${minero.unidad_fuerza}h/s </td>
                    <td> ${minero.hash_15m} ${minero.unidad_fuerza}h/s </td>
                    <td> ${estatus} </span>
            </tr>`;
          });
        });
        
        $("#miners").html(_cad);
        //$("#cant_mineros").html(canti);
        $("#red").html(rojo);
        $("#yellow").html(amarillo);
        
        if(cant > 0){
          hash_promedio = ( (hash)/(cant) ).toFixed(2);
          $("#hash_promedio").html(hash_promedio);
        }
      });
		}
		mismineros('{{$user[0]->puid}}');
		setInterval(function(){
			mismineros('{{$user[0]->puid}}');
		},60000)
	</script>
@endsection

@section('content')
	<section class="w3-col">
		<content class="w3-row" style="display: block;">
			<div class="card">
				<div class="card-body">
					<center class="w3-xlarge w3-text-orange">
						<i class="ti ti-user"></i>
						<span class="w3-text-black"> : {{$user[0]->username }}</span>
					</center>
					
					<content class="w3-container" style="display: block;" id="">
						<div style="margin: 60px 4% 50px 4%;" class="col-md-3 pull-left w3-border w3-border-orange w3-center w3-card-2">
							<div style="margin-bottom: 16px;">
                <img style="width: 30px;margin-top: 8px;border-radius: 10%;" src="{{asset('assets/images/minero_100_operativo.png')}}"><br><br>
							   Activos:<span class="w3-large" id="activos"></span>&nbsp;&nbsp;&nbsp;
                  Total:<span class="w3-large" id="all"></span>
              </div>
						</div>

						<div style="margin: 60px 4% 50px 4%;" class="col-md-3 pull-left w3-border w3-border-orange w3-center w3-card-2">
							Alertas<br>
							<span class="w3-half">
								<img style="width:55px; margin: 10px 0px 20px 0px;" class="w3-round" src="{{asset('assets/images/minero_dañado.png')}}"> &nbsp;
								<span class="w3-large w3-text-red" id="red"></span>
							</span>
							

							<span class="w3-half">
								<img style="width:55px; margin: 10px 2px 20px 2px;" class="w3-round" src="{{asset('assets/images/minero_bajo_rendimiento.gif')}}"> &nbsp;
								<span class="w3-large w3-text-yellow" id="yellow"></span>
							</span>
						</div>

						<div style="margin: 60px 4% 50px 4%;" class="col-md-3 pull-left w3-border w3-border-orange w3-center w3-card-2">
							Hash Promedio<br>
							<i style="margin: 10px 2px 20px 2px;" class="w3-xxxlarge w3-text-orange mdi mdi-cube-send"></i> &nbsp;
							<span class="w3-large" id="hash_promedio"></span> <span id="force">Th/s</span>
						</div>


						<table id="demo-foo-addrow2" style="margin-top: 50px" class="w3-table-all w3-centered w3-hoverable w3-border w3-border-orange" data-page-size="20">
							<thead>
								<tr class="w3-orange">
									<td>Minero id</td>
									<td>Minero Nombre</td>
									<td>Hash 1m</td>
									<td>Hash 15m</td>
									<td>Estatus</td>
								</tr>
							</thead>
							<tbody id="miners"></tbody>
              
              <tfoot style="border-top: 1px solid orange; border-bottom: 1px solid orange;">
                <tr>
                  <td colspan="5">
                    <ul class="pagination">
                      <li class="footable-page-arrow disabled">
                        <a data-page="first" href="#first">«</a>
                      </li>
                      <li class="footable-page-arrow disabled">
                        <a data-page="prev" href="#prev">‹</a>
                      </li>
                      <li class="footable-page active">
                        <a data-page="0" href="#">1</a>
                      </li>
                      <li class="footable-page">
                        <a data-page="1" href="#">2</a>
                      </li>
                      <li class="footable-page-arrow">
                        <a data-page="next" href="#next">›</a>
                      </li>
                      <li class="footable-page-arrow">
                        <a data-page="last" href="#last">»</a>
                      </li>
                    </ul>
                  </td>
                </tr>
              </tfoot>
						</table>
					</content>
				</div>
			</div>
		</content>
	</section>
@stop