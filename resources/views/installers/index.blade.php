@extends('layouts.admin.default')
@section('title', 'CoinCoin | Inicio')

@include('installers.install.modal_alert')

@section('breadcrum')
  <div class="col-md-5 align-self-center">
    <h3 class="w3-text-black font-bold">Instaladores</h3>
  </div>

  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{route('instalador')}}" class="text-warning font-bold">Inicio</a>
      </li>
      <li class="breadcrumb-item w3-text-black active">Instaladores</li>
    </ol>
  </div>
@stop

@section('status_miners')
  <span class="w3-text-yellow" id="amarillo"></span>
  <div class="col-md-6 dropdown dropleft w3-ripple" style="display: inline;">
    <img class="w3-round dropdown-toggle waves-effect" data-toggle="dropdown" style="width: 35px; display: inline;" src="{{asset('assets/images/minero_bajo_rendimiento.gif')}}">
    <div style="" class="dropdown-menu w3-border w3-border-yellow w3-tiny m-t-10" id="alertamarilla">
      <a class="dropdown-item" id="downhash">Hasheo Bajo</a>
    </div>
  </div>&nbsp; &nbsp;
  <div class="col-md-6 dropdown dropright w3-ripple" style="display: inline;">
    <img class="w3-round dropdown-toggle" data-toggle="dropdown" style="width: 35px; display: inline;" src="{{asset('assets/images/minero_dañado.png')}}">
    <div class="dropdown-menu w3-border w3-border-red w3-tiny m-t-10" id="alertroja">
      <a class="dropdown-item" id="nullhash">Hasheo Nulo</a>
    </div>
  </div>
  <span class="w3-text-red" id="rojo"></span>
@stop

@section('content')
  <div class="w3-hide" style="overflow: hidden;">
    <img id="mineroactivo" class="{{asset('assets/images/minero_100_operativo.gif')}}">
    <img id="minerodañado" class="{{asset('assets/images/minero_dañado.png')}}">
    <img id="minerobajo" class="{{asset('assets/images/minero_bajo_rendimiento.gif')}}">
    <span id="url" value="{{url('')}}"></span>
  </div>
  <style>
    tbody, td{ border: 1px solid blue; }
  </style>
    
  @foreach($ubicaciones as $ubicados)
    @include('installers.install.modal_detalle')
  @endforeach

  <div class="w3-container">
    <div class="card w3-border w3-round-xxlarge">
      <div class="card-body">
        <div class="w3-row" id="charts_tank"></div>
        <div class="w3-text-black w3-panel w3-center w3-large" id="vacio"></div>
          
          @if(isset($salas) && count($salas)>0)
            @foreach($salas as $sala)
              <div class="" id="Sala{{$sala->id}}">
                @foreach($sala->areas as $area)
                  <div id="Area{{$area->id}}">
                    @foreach($area->racks as $rack)
                      <div class="mySlides w3-responsive" id="Rack{{$rack->id}}">
                        <div class="w3-left w3-small" style="vertical-align: middle;">
                          <i class="fa fa-arrow-circle-left fa-3x w3-hover-text-orange" onclick="plusDivs(-1)"> </i>
                        </div>
                        <div class="w3-right w3-small" style="vertical-align: middle;">
                          <i class="fa fa-arrow-circle-right fa-3x w3-hover-text-orange" onclick="plusDivs(1)"> </i>
                        </div>
                        <table class="w3-table w3-centered w3-tiny" border="1" style="margin: 10px 0px 10px 0px; border: 1px solid;">
                          <thead>
                            <tr class="w3-orange" style="color: #fff;">
                              <th class="w3-xlarge font-bold" colspan="{{$rack->columnas}}">
                                {{$sala->sala}} : {{$area->area}} : {{$rack->rack}}
                              </th>
                            </tr {{$k=1}}>
                          </thead>
                          <tbody>
                            @for($i=0; $i < $rack->filas; $i++)
                              <tr id="rack{{$rack->id}}">
                                @for($j=0; $j < $rack->columnas; $j++)
                                  <td id="posicion{{$k}}" class="w3-card w3-btn">
                                    <img src="{{asset('assets/images/minero_disponible.png')}}" style="width: 32px;" class="w3-round"> &nbsp; {{$k++}}
                                    <div style="display: block; font-size:10px;">
                                      Disponible
                                    </div>
                                  </td>
                                @endfor
                              </tr>
                            @endfor
                          </tbody>
                        </table>
                      </div>
                    @endforeach
                  </div>
                @endforeach
              </div>
            @endforeach
          @endif
          <div class="w3-center w3-small">
            <div class="w3-section">
              <button class="w3-border w3-button w3-round w3-hover-blue-grey" onclick="plusDivs(-1)"> ❮ <b> Anterior </b>
              </button>&nbsp;
              <button class="w3-border w3-button w3-round w3-hover-blue-grey" onclick="plusDivs(1)"> <b> Siguiente </b> ❯
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <ul style="list-style-type: none;display: none;">
    @foreach($ubicaciones as $ubicados)
      <li id="{{$ubicados->minero_id}}" class="{{$ubicados->rack->rack}}" posicion="Posición : {{$ubicados->posicion}}" minero="{{$ubicados->minero_id}}" rackid="{{$ubicados->rack_id}}"></li>
    @endforeach
  </ul>
@stop

@section('scripts')
  <script src="{{asset('assets/plugins/footable/js/footable.all.min.js')}}"></script>
  <script src="{{asset('assets/js/footable-init.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/footable/css/footable.core.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
  <script src="{{ asset('js/highcharts.js')}}"></script>
  {{-- <script src="{{ asset('js/canvasjs.min.js')}}"></script> --}}
  {{-- <script src="{{ asset('js/highcharts-more.js')}}"></script> --}}
  {{-- <script src="{{ asset('js/series-label.js')}}"></script> --}}
  <script src="{{ asset('js/exporting.js')}}"></script>
  <script src="{{ asset('js/export-data.js')}}"></script>
  <style>
    .dropdown-content{display:none; z-index:1; position:relative; width: 96px; padding: 3px; margin: auto;}
    .disp{display: block;}
    .highcharts-credits { display: none; }
  </style>

  <script type="text/javascript">
    $(document).ready(function(){
      <?php foreach($ubicaciones as $ubicados) { ?>
        ubicaciones('{{$ubicados->rack_id}}', '{{$ubicados->posicion}}', '{{$ubicados->userclient->username}}', '{{$ubicados->modelo}}', '{{$ubicados->minero_id}}', '{{$ubicados->minero_nombre}}', '{{$ubicados->serial_fuente}}', '{{$ubicados->serial_equipo}}', '{{$ubicados->rack->rack}}');
      <?php } ?>
    });

    function ubicaciones(rack, posicion, username, modelo, minero_id, minero_nombre, fuente, equipo, rackname){
      var img=$('#mineroactivo').attr('class');
      $('#rack'+rack+' #posicion'+posicion).empty().append(`
        <center class="w3-tiny" style="display:inline;">
          <div id="rakk${rack}${posicion}" class="w3-hide" onclick="detalles('${rack}','${posicion}');">
            Hash <span id="hash_15m${minero_id}"></span> T<span style="text-transform:lowercase;">h/s</span><br>
            <span id="hash_1m${minero_id}"></span><br>
            <span id="hash_1d${minero_id}"></span>
          </div>
          <div class="w3-dropdown-click w3-hoverable w3-tiny" onclick="modaldt('${minero_id}','${rack}','${posicion}');">
            <span id="minero${rack}${posicion}">
              <span id="min${minero_id}">
                <i class="fa fa-plug"></i> &nbsp; <img src="${img}" style="width:32px;" class="img${minero_id} w3-round">
              </span>
            </span> &nbsp; ${posicion}
            <div style="margin-top:9px;font-size:10px;text-transform:capitalize;">${username}</div>
          </div>
        </center>`);
    }

    function modaldt(minero,rack,posicion) {
      $("#"+minero+rack+posicion).modal({backdrop: 'static'});
    }

    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) { showDivs(slideIndex += n); }

    function currentDiv(n) {
      $(".mySlides").hide();
      $('.mySlides#'+n).show();
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");

      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}

      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      x[slideIndex-1].style.display = "block";
    }

    function mineroz(){
      var uri=$("#url").attr('value');
      var cool=uri+'/Mineroz';
      $.get(cool, function(datos){
        var minerodañado, mineroactivo, minerobajo, amarillo=0, rojo=0;
        minerodañado=$("#minerodañado").attr('class');
        mineroactivo=$("#mineroactivo").attr('class');
        minerobajo  =$("#minerobajo").attr('class');
        _cad = ''; var alert_amarillo=""; var alert_rojo=""; var modalred=''; var modalyellow='';

        var alerts = [], graficas=[];
        $.each(datos.datos, function(indice, dats){
          $.each(dats, function(subindice, minero){
            estatus ='';
            var sub=$("li#"+minero.mineros_id).attr('id');
            if (sub==minero.mineros_id) {
              var rack=$("li#"+minero.mineros_id).attr('class');
              var posicion=$("li#"+minero.mineros_id).attr('posicion');
              var rackid=$("li#"+minero.mineros_id).attr('rackid');
            }else{
              var rack='No se encuentra en';
              var posicion='la matriz de ubicaciones';
              var rackid='NoestaUbicado';
            }
            
            if(parseFloat(minero.hash_1m) < 1 && parseFloat(minero.hash_15m) < 1){
              alert_store(minero.mineros_id, minero.mineros_nombre, minero.hash_1m, minero.hash_15m, minero.hash_1d);
              
              estatus = `<i class="fa fa-plug w3-text-red"></i> &nbsp; <img style="width:32px;" class="img${minero.mineros_id} w3-round" src="${minerodañado}">`;
              
              rojo=rojo+1;
              
              /*alert_rojo +=`<a class="dropdown-item w3-tiny tablink" onclick="currentDiv('Rack${rackid}');openChart(${minero.mineros_id});">
              <span style="font:bold; font-weight: bold;"> ${minero.mineros_nombre} </span></a>`;*/
              alert_rojo +=`<a class="hoverable dropdown-item w3-tiny tablink">
              <span style="font:bold; font-weight: bold;" onclick="openChart('${minero.mineros_id}');"> ${minero.mineros_nombre} </span></a>`;
            
            }else if(parseFloat(minero.hash_1m) < 6 && parseFloat(minero.hash_15m) < 6 ){
              
              alert_store(minero.mineros_id, minero.mineros_nombre, minero.hash_1m, minero.hash_15m, minero.hash_1d);
              
              estatus = `<i class="fa fa-plug w3-text-yellow"></i> &nbsp; <img style="width:32px;" class="img${minero.mineros_id} w3-round" src="${minerobajo}" >`;
                  
              amarillo=amarillo+1;
                  
              alert_amarillo +=`<a class="hoverable dropdown-item w3-tiny tablink">
              <span style="font:bold;font-weight: bold;" onclick="openChart('${minero.mineros_id}');"> ${minero.mineros_nombre} </span></a>`;
              
            }else{
              estatus = `<i class="fa fa-plug w3-text-green"></i> &nbsp; <img style="width:32px;" class="img${minero.mineros_id} w3-round" src="${mineroactivo}">`;
            }

            $("#min"+minero.mineros_id).html(estatus);
            $(".hash_1m"+minero.mineros_id).html(parseFloat(minero.hash_1m)+''+minero.unidad_fuerza+'h/s');
            $("#hash_1m"+minero.mineros_id).html(parseFloat(minero.hash_1m)+''+minero.unidad_fuerza+'h/s');
            $("#hash_15m"+minero.mineros_id).html(parseFloat(minero.hash_15m)+''+minero.unidad_fuerza+'h/s');
            $(".hash_15m"+minero.mineros_id).html(parseFloat(minero.hash_15m)+''+minero.unidad_fuerza+'h/s');
            $(".hash_1d"+minero.mineros_id).html(parseFloat(minero.hash_1d)+''+minero.unidad_fuerza+'h/s');
            $("#hash_1d"+minero.mineros_id).html(parseFloat(minero.hash_1d)+''+minero.unidad_fuerza+'h/s');
          });
            $("#alertamarilla").html(alert_amarillo);
            $("#alertroja").html(alert_rojo);
            $("#rojo").html(rojo);
            $("#amarillo").html(amarillo);
        });
      });
    }

    mineroz();
    function load(){ plusDivs(1); }        
    setInterval(load, 120000/*300000*/);
    setInterval(mineroz, 60000/*30000 30s*/);

    function alert_store(id, nombre, hash_1m, hash_15m, hash_1d){
      var url=$("#url").attr('value');
      var route = url+'/Alerts';
      var xhr = $.post(route,
        {
          _token : '{{csrf_token()}}',
          minero_id : id,
          minero_nombre : nombre,
          hash_1m : hash_1m,
          hash_15m : hash_15m,
          hash_1d : hash_1d,
        }
      );

      xhr.done(function(data){        
        var success = 'Si, operacion exitosa';
      });
    }

    function graph(id, miner_name, xs, ys, size){
      // console.log(id, miner_name, xs, ys, size);
      Highcharts.chart({
        chart: {
          renderTo: `chart_alert${id}`,
          type: 'spline',
          animation: Highcharts.svg,
          marginRight: 16,
          width: 900,
          events: {
            load: function () {
              var series = this.series[0];
              for(var i=0; i < size; i++){
                series.addPoint([xs[i], ys[i]], true, true);
              }
            }
          }
        },
        time: {
          useUTC: false
        },

        title: {
          text: ''
        },
        xAxis: {
          type: 'datetime'
        },
        yAxis: {
          title: {
            text: 'Hash (TH/s)'
          },
          plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
          }]
        },
        tooltip: {
          headerFormat: '<b>{series.name}</b><br/>',
          pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
        },
        legend: {
          enabled: true
        },
        exporting: {
          enabled: false
        },
        series: [{
          name: miner_name,
          data: (function () {
            var data = [];
            for (var i = 0; i < size; i++) {
              data.push({ x: xs[i] * 1000, y: ys[i] });
            }
            return data;
          }())
        }]
      }); // end var options
    }

    function alert_show(id){
      var x = [], y = [], route, url, xhr;
      url = $("#url").attr('value');
      route = url+"/Alerts/"+id;
      xhr = $.get(route, { _token : '{{csrf_token()}}', id : id });

      xhr.done(function(data){
        $.each(data.alerts, function(ind, dat){
          $.each(dat, function(i, dt){
            x.push(dt.data_x);
            y.push(parseFloat(dt.data_y));
            x.sort(function(a, b){return a - b});
          });
          graph(id, ind, x, y, dat.length);
        });
      });
    }

    allert();
    setInterval(allert, 300000 );
    
    function allert(){
      var x = [], y = [], route, url, xhr;
      url = $("#url").attr('value');
      route = url+"/Alerts";
      xhr = $.get(route);
      xhr.done(function(data){
        $.each(data.ids, function(ind, dat){
          create_charts(ind);
          alert =`<a class="hoverable dropdown-item w3-tiny tablink">
              <span style="font:bold; font-weight: bold;" onclick="openChart('${ind}');"> ${ind} </span></a>`;
          $("#alertamarilla").append(alert);
        });
      });
    }

    function create_charts(id){
      var graficas=`
      <div id="${id}" class="w3-container w3-border alerts_miners w3-animate-bottom" style="display:none;">
        <span onclick="this.parentElement.style.display='none'" class="w3-right w3-closebtn">X</span>
        <span id="chart_alert${id}"></span>
      </div>`;
      $("#charts_tank").append(graficas);
      alert_show(id);
    }

    function openChart(miner_id) {
      var i, x;
      x = document.getElementsByClassName("alerts_miners");

      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      
      $("#"+miner_id).show();
    }
  </script>
@stop
