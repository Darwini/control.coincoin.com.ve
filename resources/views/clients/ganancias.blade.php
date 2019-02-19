@extends('layouts/default')

{{-- Page title --}}
@section('title')
  Bienvenido a la plataforma
  @parent
@endsection

@section('content')
  <div class="row">
      <div class="col-lg-2 col-md-12">
          <!-- Column -->
          <div class="card">
              <div class="card-body text-center">
                <div class="text-center">
                  <div class="col-md-12 p-b-5">
                     <img src="{{ asset('assets/images/icono_ingresos.png') }}">
                  </div>
                  <h6 class="card-title font-bold text-center">Ganancias <span class="font-12 font-light">(BTC)</span></h6>
                  <hr>
                    <h6 class="card-title font-14">Total Pagado</h6>
                    <h6 id="_total_pagado" class="font-bold">0.00002547</h6>
                    <h6 class="card-title font-14 p-t-10">Balance</h6>
                    <h6 id="_balance" class="font-bold">0.00002547</h6>
                  <hr>
                </div>
              </div>
          </div>

          <div class="card">
              <div class="card-body text-center">
                <div class="text-center">
                  <div class="col-md-12 p-b-5">
                     <img src="{{ asset('assets/images/icono_btc_earnings.png') }}">
                  </div>
                  <h6 class="card-title font-bold text-center">Estimado <span class="font-12 font-light">(BTC)</span></h6>
                  <hr>
                    <h6 class="card-title font-14">Hoy</h6>
                    <h6 id="_total_hoy" class="font-bold p-b-10">0.00002547</h6>
                    <h6 class="card-title font-14">7 dias</h6>
                    <h6 id="_total_semana" class="font-bold p-b-10">0.00002547</h6>
                    <h6 class="card-title font-14">30 dias</h6>
                    <h6 id="_total_mes" class="font-bold">0.00002547</h6>
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
                                <h4 class="card-title">Ganancias del usuario</h4>
                                <hr>
                                <div class="demo-radio-button col-8">
                                    <input name="_filtro" type="radio" id="_diario" class="with-gap radio-col-deep-orange" checked />
                                    <label class="col-3" for="_diario">Diario</label>
                                    <input name="_filtro" type="radio" id="_mensual" class="with-gap radio-col-deep-orange" />
                                    <label  class="col-3" for="_mensual">Mensual</label>
                                </div>
                                <div class="col-12 center">
                                  <div id="table_dia" class="table-responsive justify-content-center">
                                      <table id="_ganancia" class="display nowrap table table-hover table-striped table-bordered
                                       color-bordered-table  primary-bordered-coin  text-center" cellspacing="0" width="100%" style="font-size:14px;">
                                          <thead class="bg-info text-white">
                                              <tr>
                                                  <th>Fecha</th>
                                                  <th>Dificultad</th>
                                                  <th>Ganancia</th>
                                                  <th>Hora de Pago</th>
                                                  <th>Address</th>
                                                  <th>Estatus </th>
                                              </tr>

                                          </thead>

                                          <tbody classs="font-12  font-light " id="_cuerpo_ganacia">
                                              <tr>
                                                  <th>Tiempo</th>
                                                  <th>Dificultad</th>
                                                  <th>Ganancia</th>
                                                  <th>Hora de Pago</th>
                                                  <th>Address</th>
                                                  <th>Estatus </th>
                                              </tr>

                                          </tbody>
                                      </table>
                                  </div>

                                  <div id="table_mes" class="table-responsive m-t-0" style="display:none">
                                    <table id="_ganancia_mes" class="display nowrap table table-hover table-striped table-bordered
                                     color-bordered-table  primary-bordered-coin  text-center" cellspacing="0" width="100%" style="font-size:14px;">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Dificultad</th>
                                                <th>Ganancia</th>
                                                <th>Hora de Pago</th>
                                                <th>Address</th>
                                                <th>Estatus </th>
                                            </tr>

                                        </thead>

                                        <tbody classs="font-11  font-light " id="_cuerpo_mes">
                                            <tr>
                                                <th>Tiempo</th>
                                                <th>Dificultad</th>
                                                <th>Ganancia</th>
                                                <th>Hora de Pago</th>
                                                <th>Address</th>
                                                <th>Estatus </th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
      <!-- Column -->
      </div>
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
$("#_url_pagina").text('Ganancias');
$("#_titulo").text('Ganancias');

//const url = $("meta[name=base_url]").attr('content');
var res;
    function llenarDiario(){
        _cad = ''; 
        $("#_cuerpo_ganacia").html(_cad);
        $.ajax({
            async: false,
            url: url+'/historialGanancias1',
            type: 'get',
            dataType: "json",
            //data:{},
            success: function(data) {

              if(data.datos !=''){

                $.each(data.datos, function(i,ganancia){
                  _status ='';
                  _date_pay = '';
                  if(ganancia.status=='Pendiente' || ganancia.address =='')
                      _status = `<span class="label label-warning font-10">Pendiente</span>`;
                  else if(ganancia.status == 'Inactivo')
                      _status = `<span class="label label-danger font-10">Inactivo</span>`;
                  else
                      _status = `<span class="label label-info font-10">Pagado</span>`;

                  if(ganancia.payment_time == null  || ganancia.payment_time=='')
                    _date_pay = '';
                  else
                    _date_pay = ganancia.payment_time.substring(0, 16);

                    var num_diff = '';                  
                    if(ganancia.diff == '' || ganancia.diff == null || ganancia.diff == 'undefined' || ganancia.diff == 'null'){
                        num_diff = '';
                    }else{
                        num_diff = ganancia.diff.substr(0, 3);
                        num_diff = (parseInt(num_diff)/100);
                    }

                    if(ganancia.date =='' || ganancia.date == null || ganancia.date == 'undefined' || ganancia.date == 'null'){
                       
                    }else{
                        _cad +=`<tr class="font-11"><td>${ganancia.date}</td>
                            <td class="text-center">${num_diff}</td>
                            <td >${ganancia.earnings}  ${ganancia.current_coin }/${ganancia.earnings_dolar} $</td>
                            <td>${_date_pay}</td>
                            <td class="font-10">${ganancia.address}</td>
                            <td>${_status}</td></tr>`; 
                    }

                });
                $("#_cuerpo_ganacia").html(_cad);
              }
            }
        }); 
    }

    llenarDiario();
    var tabla_diario =    $('#_ganancia').DataTable( {
            "order": [[ 0, "desc" ]],
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
                    "searchPlaceholder": "Fecha /  Dificultad /  Hora de Pago / Estatus / Address",
                    "zeroRecords":    "No se encontraron registros coincidentes",
                    "pageLength": 10,
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
                }
        });


        var tabla_mes =  $('#_ganancia_mes').DataTable( {
            "order": [[ 0, "desc" ]],
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
                    "searchPlaceholder": "Fecha /  Dificultad /  Hora de Pago / Estatus / Address",
                    "zeroRecords":    "No se encontraron registros coincidentes",
                    "pageLength": 10,
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
                }
        });

$(document).ready(function () {             
    $('.dataTables_filter input[type="search"]').css(
        {'width':'400px', 'font-size':'14px', 'display':'inline-block'}
    );
});
 
 //mineros
function gananciasHoy(){
    $.ajax({
        url: url+'/ganancias1',
        type: 'get',
        dataType: "json",
        //data:{},
        success: function(data) {
              //Total minado
            $("#_total_hoy").html(`${data.datos.earnings_today} ${data.datos.current_coin} <br/> ${data.datos.earnings_today_dolar} $`); 

            //Estimado hoy
            $("#_total_semana").html(`${data.datos.estimado_7d} ${data.datos.current_coin} <br/> ${data.datos.estimado_7d_dolar} $`);

            //Estimado 7 dias
            $("#_total_mes").html(`${data.datos.estimado_30d} ${data.datos.current_coin}<br/> ${data.datos.estimado_30d_dolar} $`);
  
            //Balance
            $("#_balance").html(`${data.datos.unpaid} ${data.datos.current_coin} <br/> ${data.datos.unpaid_dolar} $`);

            //Total pagado
            $("#_total_pagado").html(`${data.datos.total_paid} ${data.datos.current_coin} <br/> ${data.datos.total_paid_dolar} $`);
        }
    });
}

function llenarMes(){
    _cad = ''; 
    $("#_cuerpo_mes").html(_cad);
    $.ajax({
        async: false,
        url: url+'/gananciasMes1',
        type: 'get',
        dataType: "json",
        //data:{},
        success: function(data) {
          if(data.datos !='' || data.datos != 0){
            $.each(data.datos, function(i,ganancia){
                _mes = '';
                if(ganancia.nro_mes == '01'){
                    _mes = 'Enero'
                }else if(ganancia.nro_mes == '02'){
                    _mes = 'Febrero';
                }else if(ganancia.nro_mes == '03'){
                    _mes = 'Marzo';
                }else if(ganancia.nro_mes == '04'){
                    _mes = 'Abril';
                }else if(ganancia.nro_mes == '05'){
                    _mes = 'Mayo';
                }else if(ganancia.nro_mes == '06'){
                    _mes = 'Junio';
                }else if(ganancia.nro_mes == '07'){
                    _mes = 'Julio';
                }else if(ganancia.nro_mes == '08'){
                    _mes = 'Agosto';
                }else if(ganancia.nro_mes == '09'){
                    _mes = 'Septiembre';
                }else if(ganancia.nro_mes == '10'){
                    _mes = 'Octubre';
                }else if(ganancia.nro_mes == '11'){
                    _mes = 'Noviembre';
                }else if(ganancia.nro_mes == '12'){
                    _mes = 'Diciembre';
                }
        
                if(ganancia.payment_time == null  || ganancia.payment_time=='')
                    _date_pay = '';
                else
                    _date_pay = ganancia.payment_time.substring(0, 16);

                if(ganancia.payment_time == 'H')
                _status = `<span class="label label-warning font-9">Pendiente</span>`;
                else
                _status = `<span class="label label-info font-9">Pagado</span>`
               

                _date =ganancia.anio+' '+_mes;
              _cad +=`<tr class="font-11"><td>${_date}</td>
                        <td class="text-center">${ganancia.diff}</td>
                        <td>${ganancia.earnings} ${ganancia.current_coin}/${ganancia.earnings_dolar} $</td>
                        <td>${_date_pay}</td>
                        <td class="font-10">${ganancia.address}</td>
                        <td>${_status}</td></tr>`;
            });
            $("#_cuerpo_mes").html(_cad);
          }else{
              _cad +=`<tr class="font-12"><td>
                        <td class="text-center" colspan='5'>No hay datos</td></tr>`;
              $("#_cuerpo_mes").html(_cad);
          }
        }
    });

 }

gananciasHoy();
//pagado_nueva();

$('#_diario').on('change', function () {
    $("#table_mes").hide();
    $("#table_dia").show();
    llenarDiario();
    tabla_diario.order([0,'desc']).draw();
});
$('#_mensual').on('change', function () {
    $("#table_mes").show();
    $("#table_dia").hide();
    llenarMes();
});

</script>
@endsection
