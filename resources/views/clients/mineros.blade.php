@extends('layouts/default')

{{-- Page title --}}
@section('title')
  Bienvenido a la plataforma
  @parent
@endsection

@section('content')
  <div class="row">
      <div class="col-lg-2">
          <!-- Column -->
            <div class="card">
                <div class="card-body text-center">
                  <div class="text-center">
                    <div class="col-md-12 p-b-5">
                       <img src="{{ asset('assets/images/icono_minero.png') }}">
                    </div>
                    <h5 class="card-title font-bold text-center">MINEROS</h5>
                    <hr>
                      <h6 class="card-title font-14">Adquiridos</h6>
                      <h2 id="workers_total">0</h2>
                      <h6 class="card-title font-14">Activos</h6>
                      <h2 id="workers_activos" class="text-info">0</h2>
                      <h6 class="card-title font-14">Inactivos</h6>
                      <h2 id="workers_inactivos" class="p-b-5 text-danger">0</h2>
                    <hr>
                  </div>
                </div>
            </div>
          <!-- Column -->
          <div class="card">
                <div class="card-body text-center">
                  <div class="text-center">
                    <div class="col-md-12 p-b-5">
                       <img src="{{ asset('assets/images/icono_btc_earnings.png') }}">
                    </div>
                    <h5 class="card-title font-bold text-center">TOTAL</h5>
                    <hr>
                      <h6 class="card-title font-14">Tiempo Real</h6>
                      <h2 id="_total">0</h2>
                    <hr>
                  </div>
                </div>
          </div>
      </div>

      <!-- Column -->
      <div class="col-lg-10">
        <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Minadores del usuario</h4>
                        <hr>
                        <div class="row p-l-10 p-r-10 ">
                            <div class=" table-responsive m-t-20 col-12">
                                <table id="_mineria" class="display nowrap table table-hover table-striped  table-b color-bordered-table  
                                primary-bordered-coin " cellspacing="0" width="100%">
                                    <thead class="head-table-c text-white font-12">
                                        <tr>
                                            <th>Equipo</th>
                                            <th class="text-right">Hash Rate</th>
                                            <th class="text-right">Diario</th>
                                            <th>Aceptado</th>
                                            <th>% Rechazo</th>
                                            <th>Ultimo </th>
                                            <th>Estatus </th>
                                        </tr>

                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <th id="_real" class="text-right">Total</th>
                                            <th id="_diario" class="text-right">Total</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="_cuerpo_minero">
                                        <tr>
                                            <td>Equipo</td>
                                            <td class="text-right">Tiempo Real</td>
                                            <td  class="text-right">Diario</td>
                                            <td>Aceptado</td>
                                            <td>Rechazado</td>
                                            <td>Ultimo </td>
                                            <td>Estatus </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                  </div>

              </div>
        </div>
      </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
$("#_url_pagina").text('Mineros');
$(".text-themecolor").text('Mineros');
$("#_titulo").text('Mineros');
//const url = $("meta[name=base_url]").attr('content');
var res;

      function datos_tabla(){
        _cad = ''; 
        $.ajax({
            async: false,
            url: url+'/datosMineros',
            type: 'get',
            dataType: "json",
            //data:{},
            success: function(data) {

              if(data.datos !=''){

                $.each(data.datos, function(i,v){
                  _diario = 0;
                  _real = 0;
                  $.each(v, function(j,minero){
                  estatus ='';
  

                    if(minero.estatus=='ACTIVE')
                      estatus = `<span class="label label-info">ACTIVO</span>`;
                    else
                      estatus = `<span class="label label-danger">INACTIVO</span>`;

                      _cad +=`<tr><td>${minero.equipo}</td>
                              <td class="text-right">${minero.tiempo_real} TH/s</td>
                              <td class="text-right">${minero.diario} TH/s</td>
                              <td>${minero.aceptado}</td>
                              <td>${minero.rechazado}</td>
                              <td>${minero.ultima_conexion.slice(0, -3)}</td>
                              <td class='font-10'>${estatus}</td></tr>`;
                      _diario =(parseFloat(_diario)+parseFloat(minero.diario));
                      _real   =(parseFloat(_real)+parseFloat(minero.tiempo_real));
                  });
                });
                $("#_cuerpo_minero").html(_cad);
                var num = (_diario+_real);
                $("#_total").html(num.toFixed(2)+' TH/s');
                $("#_diario").html(_diario.toFixed(2)+' TH/s');
                $("#_real").html(_real.toFixed(2)+' TH/s');
              }
            }
        });

     }

     function datos_tabla_nueva(){
        _cad = ''; 
        $.ajax({
            async: false,
            url: url+'/datosMineros1',
            type: 'get',
            dataType: "json",
            //data:{},
            success: function(data) {

              if(data.datos !=''){

                $.each(data.datos, function(i,v){
                  _diario = 0;
                  _real = 0;
                  $.each(v, function(j,minero){
                  estatus ='';
  
                    if(minero.estatus=='ACTIVE')
                      estatus = `<span class="label label-info">ACTIVO</span>`;
                    else
                      estatus = `<span class="label label-danger">INACTIVO</span>`;

                      _cad +=`<tr><td>${minero.equipo}</td>
                              <td class="text-right">${minero.tiempo_real} TH/s</td>
                              <td class="text-right">${minero.diario} TH/s</td>
                              <td>${minero.aceptado}</td>
                              <td>${minero.rechazado}</td>
                              <td>${minero.ultima_conexion.slice(0, -3)}</td>
                              <td>${estatus}</td></tr>`;
                      _diario =(parseFloat(_diario)+parseFloat(minero.diario));
                      _real   =(parseFloat(_real)+parseFloat(minero.tiempo_real));
                  });
                });
                $("#_cuerpo_minero").html(_cad);
                var num = (_diario+_real);
                $("#_total").html(num.toFixed(2)+' TH/s');
                $("#_diario").html(_diario.toFixed(2)+' TH/s');
                $("#_real").html(_real.toFixed(2)+' TH/s');
              }
            }
        });

        $('#_mineria').DataTable( {
            "language": {
                    "decimal":        "",
                    "emptyTable":     "No hay datos disponibles en la tabla",
                    "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered":   "(filtrado de _MAX_ total registros)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search":         "Buscar:",
                    "searchPlaceholder": "Equipo /  Tiempo Real / Diario / Aceptado /  Estatus",
                    "zeroRecords":    "No se encontraron registros coincidentes",
                    "paginate": {
                        "first":      "Primeo",
                        "last":       "Ultimo",
                        "next":       "Proximo",
                        "previous":   "Anterior"

                    },
                    "aria": {
                        "sortAscending":  ": activar para ordenar la columna ascendente",
                        "sortDescending": ": activar para ordenar la columna descendente"
                    }
                },
                "pageLength": 10
        });
     }


 datos_tabla_nueva();
 mineros_nueva();


     
        $(document).ready(function () {             
            $('.dataTables_filter input[type="search"]').css(
               {'width':'400px', 'font-size':'14px'}
            );
        });

/*$(".paginate_button.current").css("background-color", "#ce761d");
 $(".paginate_button.current").css("border", " 1px solid #ce761d");
*/

 //mineros
 function mineros(){
    $.ajax({
        url: url+'/mineros',
        type: 'get',
        dataType: "json",
        //data:{},
        success: function(data) {
            $("#workers_activos").html(data.datos.workers_active); //activos
            $("#workers_inactivos").html(data.datos.workers_inactive); //inactivos
            $("#workers_total").html(data.datos.workers_total); //total
        }
    });
 };

function mineros_nueva(){
    $.ajax({
        url: url+'/mineros1',
        type: 'get',
        dataType: "json",
        //data:{},
        success: function(data) {
            $("#workers_activos").html(data.datos.workers_active); //activos
            $("#workers_inactivos").html(data.datos.workers_inactive); //inactivos
            $("#workers_total").html(data.datos.workers_total); //total
        }
    });
 }   
 

 function _load(){
   datos_tabla_nueva();
   mineros_nueva();
 }
 
 setInterval(_load, 100000/*300000*/); 

</script>
@endsection
