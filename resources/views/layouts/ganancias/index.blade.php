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
                                <div class="row  col-12">
                                  <div class="table-responsive m-t-20 ">
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
      function datos_tabla(){
        _cad = ''; 
        $.ajax({
            async: false,
            url: url+'/historialGanancias',
            type: 'get',
            dataType: "json",
            //data:{},
            success: function(data) {

              if(data.datos !=''){

                $.each(data.datos, function(i,ganancia){
                  _status ='';
                  _date_pay = '';
                  if(ganancia.stats=='PENDING_NOT_ENOUGH' || ganancia.address =='')
                      _status = `<span class="label label-warning font-10">Pendiente</span>`;
                  else if(ganancia.earnings =='0' || ganancia.payment_time == null  || ganancia.payment_time=='')
                      _status = `<span class="label label-danger font-10">Inactivo</span>`;
                  else
                      _status = `<span class="label label-info font-10">Pagado</span>`;

                  if(ganancia.payment_time == null  || ganancia.payment_time=='')
                    _date_pay = '';
                  else
                    _date_pay = ganancia.payment_time;
                  
                    var num_diff = ganancia.diff.substr(0, 3);
                    num_diff = (parseInt(num_diff)/100);

                    //<td >${ganancia.earnings} ${ganancia.current_coin} / ${ganancia.earnings_dolar} $</td>
                    _cad +=`<tr class="font-12"><td>${ganancia.date}</td>
                              <td class="text-center">${num_diff}</td>
                              <td >${ganancia.earnings} BTC</td>
                              <td>${_date_pay}</td>
                              <td>${ganancia.address}</td>
                              <td>${_status}</td></tr>`;
                     

                });
                $("#_cuerpo_ganacia").html(_cad);
              }
            }
        });

     }

    //Funcion segun los multipool
    function datos_tabla_nueva(){
        _cad = ''; 
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

                  if(ganancia.stats=='PENDING_NOT_ENOUGH' || ganancia.address =='')
                      _status = `<span class="label label-warning font-10">Pendiente</span>`;
                  else if(ganancia.earnings =='0' || ganancia.payment_time == null  || ganancia.payment_time=='')
                      _status = `<span class="label label-danger font-10">Inactivo</span>`;
                  else
                      _status = `<span class="label label-info font-10">Pagado</span>`;

                  if(ganancia.payment_time == null  || ganancia.payment_time=='')
                    _date_pay = '';
                  else
                    _date_pay = ganancia.payment_time;
                  
                    var num_diff = ganancia.diff.substr(0, 3);
                    num_diff = (parseInt(num_diff)/100);

                    //<td >${ganancia.earnings} ${ganancia.current_coin} / ${ganancia.earnings_dolar} $</td>
                    _cad +=`<tr class="font-12"><td>${ganancia.date}</td>
                              <td class="text-center">${num_diff}</td>
                              <td>${ganancia.earnings} ${ganancia.current_coin} / ${ganancia.earnings_dolar} $ </td>
                              <td>${_date_pay}</td>
                              <td>${ganancia.address}</td>
                              <td>${_status}</td></tr>`;
                     

                });
                $("#_cuerpo_ganacia").html(_cad);
              }
            }
        });

     }

   datos_tabla_nueva();

          $('#_ganancia').DataTable( {
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
 

function gananciasHoyNuevo(){
    $.ajax({
        url: url+'/ganancias',
        type: 'get',
        dataType: "json",
        //data:{},
        success: function(data) {
            $("#_total_hoy").html(data.datos.earnings_today+' '+data.dato.current_coin); //estimado hoy 
            
            $("#_total_semana").html(data.datos.estimado_7d+' '+data.dato.current_coin); //estimado hoy 

            $("#_total_mes").html(data.datos.estimado_30d+' '+data.dato.current_coin); //estimado hoy 

            $("#_balance").html(data.datos.unpaid+' '+data.datos.current_coin);
            $("#_total_pagado").html(data.datos.total_paid +' '+data.dato.current_coin); 
        }
    });
}      

gananciasHoyNuevo();

</script>
@endsection
