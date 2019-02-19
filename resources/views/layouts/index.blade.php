@extends('layouts/default')

{{-- Page title --}}
@section('title')
   Bienvenido a la plataforma
   @parent
@endsection

@section('content')
   <div class="row">
      <div class="col-lg-12">
       <!-- mineros -->
         <div class="row">
            <!--Mineros -->
            <div class="col-lg-4">
               <div class="card card-inverse">
                  <div class="card-body text-default">
                     <div class="d-flex">
                        <div class="col-md-12 m-r-20 text-left">
                           <img src="{{ asset('assets/images/icono_minero.png') }}">
                           <span class="m-l-20 font-bold">MINEROS</span>
                        </div>
                     </div>
                     <hr>
                     <div class="row  text-default">
                           <div class="col-4 p-t-0 p-b-20 align-self-center  text-center">
                              <h5 class="font-light  font-14">Totales</h5>
                           </div>
                           <div class="col-4 p-t-0 p-b-20 align-self-center  text-center">
                              <h5 class="font-light  font-14">Activos</h5>
                           </div>
                           <div class="col-4 p-t-0 p-b-20 align-self-center  text-center">
                              <h5 class="font-light  font-14">Inactivos</h5>
                           </div>

                           <div class="col-4 p-b-10  align-self-center  text-center">
                              <h1 class="font-light  " id="workers_t">0</h1>
                           </div>
                           <div class="col-4 p-b-10  align-self-center  text-center">
                              <h1 class="font-light text-info" id="workers_a">0</h1>
                           </div>
                           <div class="col-4 p-b-10  align-self-center  text-center">
                              <h1 class="font-light text-danger" id="workers_i">0</h1>
                           </div>
                           <div class="col-12 p-b-0 font-12 text-right">
                              <h6 class="font-light text-danger" id=""><a href="#">Equipos Adquiridos</a></h6>
                           </div>
                     </div>
                     <hr>
                  </div>
               </div>
            </div>

            <!-- Ganancias -->
            <div class="col-lg-4">
               <div class="card card-inverse">
                  <div class="card-body text-center text-default">
                     <div class="d-flex ">
                        <div class="col-md-12 m-r-20 text-left">
                           <img src="{{ asset('assets/images/icono_btc_earnings.png') }}">
                           <span class="m-l-20 font-bold">BTC Ganancias</span>
                        </div>
                     </div>
                     <hr>
                     <div class="table-responsive">
                        <table class="table-sm ">
                            <tbody>
                                 <tr>
                                    <td class="text-left">
                                       <h6 class="font-light font-12">Total Minado</h6>
                                    </td>
                                    <td class="text-right p-l-20">
                                       <h6 class="font-12 font-bold text-info" id="_total_minado">1.08686829 B / 1000.0000,00$</h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="text-left">
                                       <h6 class="font-light font-12">Estimado Hoy</h6>
                                    </td>
                                    <td class="text-right">
                                       <h6 class="font-12 font-bold text-warning" id="_ganancia_hoy">0.08686829 BTC / 1.000,00 $</h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td  class="text-left">
                                       <h6 class="font-light font-12">7 días</h6>
                                    </td>
                                    <td class="text-right">
                                       <h6 class="font-12 font-bold" id="_ganancia_semana">0.08686829 BTC / 1.000,00 $</h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="text-left">
                                       <h6 class="font-light font-12">30 días</h6>
                                    </td>
                                    <td class="text-right">
                                      <h6 class="font-12 font-bold" id="_ganancia_mes">0.08686829 BTC / 1.000,00 $</h6>
                                    </td>
                                 </tr>
                            </tbody>
                        </table>
                     </div>
          
                     <hr>
                  </div>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="card card-inverse">
                  <div class="card-body text-center text-default">
                     <div class="d-flex ">
                        <div class="col-md-12 m-r-20 text-left">
                           <img src="{{ asset('assets/images/icono_btc_earnings.png') }}">
                           <span class="m-l-20 font-bold">INGRESOS</span>
                        </div>
                     </div>
                     <hr>
                     <div class="table-responsive">
                        <table class="table-sm text-right p-l-20">
                            <tbody>
                                 <tr>
                                    <td class="text-left">
                                       <h6 class="font-light font-12">Balance</h6>
                                    </td>
                                    <td class="text-right p-l-20">
                                       <h6 class="font-12 font-bold text-info" id="_balance">0.08686829 BTC</h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="text-left">
                                       <h6 class="font-light font-12">Total Pagado</h6>
                                    </td>
                                    <td class="text-right">
                                       <h6 class="font-12 font-bold text-warning" id="total_pagado">0.08686829 BTC</h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td  class="text-left">
                                       <h6 class="font-light font-12">Último pago</h6>
                                    </td>
                                    <td class="text-right">
                                       <h6 class="font-12 font-bold" id="_ultimo_pago">0.08686829 BTC</h6>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="text-left">
                                       <h6 class="font-light font-12">Pendiente</h6>
                                    </td>
                                    <td class="text-right">
                                      <h6 class="font-12 font-bold" id="_pago_pendiente">0.08686829 BTC</h6>
                                    </td>
                                 </tr>
                            </tbody>
                        </table>
                     </div>
          
                     <hr>
                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <!--tiempo real -->
            <div class="col-lg-4">
               <div class="card card-inverse">
                  <div class="card-body text-center text-default">
                     <div class="d-flex ">
                        <div class="col-md-12 m-r-20 text-left">
                           <img src="{{ asset('assets/images/icono_btc_hasha_rates.png') }}">
                           <span class="m-l-20 font-bold">BTC Hash Rate</span>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-6 p-t-10 align-self-center">
                           <h2 class="font-light  font-16 p-b-20">Tiempo Real</h2>
                           <h2 class="font-light " id="_real_time">6.30 TH/s</h2>
                        </div>
                        <div class="col-6 p-t-10 align-self-center">
                           <h2 class="font-light  font-16 p-b-20">24 H</h2>
                           <h2 class="font-light" id="_hashrate_hoy">5.94 TH/s</h2>
                        </div>
                     </div> 
                     <hr>
                  </div> 

               </div>
              
            </div>

            <!-- Network -->
            <div class="col-lg-4">
               <div class="card card-inverse">
                  <div class="card-body text-center text-default">
                     <div class="d-flex ">
                        <div class="col-md-12 m-r-20 text-left">
                           <img src="{{ asset('assets/images/icono_btc_hasha_rates.png') }}">
                           <span class="m-l-20 font-bold">Estado de la Red</span>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <h2 class="col-6  font-light text-left font-16">Pool Hashrate </h2>
                        <h2 class="col-6  text-right font-16 font-bold" id="_pool">0.08
                           <span>EH/s</span>
                        </h2>
                        <div class="col-12">
                           <div class="progress ">
                              <div id="_bar_pool" class="progress-bar bg-info" role="progressbar"
                                   style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                   aria-valuemax="100"></div>
                           </div>

                        </div>
                     </div>
                     <div class="row p-t-20">
                        <h2 class="col-6  font-light text-left font-16">Pool de la Red</h2>
                        <h2 class="col-6  text-right font-16 font-bold" id="_pool_red">0.08
                           <span>EH/s</span>
                        </h2>
                        <div class="col-12">
                           <div class="progress ">
                              <div id="_bar_red" class="progress-bar bg-warning" role="progressbar"
                                   style="width: 95%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                   aria-valuemax="100"></div>
                           </div>
                        </div>
                      </div>
                     <hr>
                  </div> 

               </div>
              
            </div>

            <!-- Dificulta y otros -->
            <div class="col-lg-4">
               <div class="card card-inverse">
                  <div class="card-body text-center text-default">
                     <div class="d-flex ">
                        <div class="col-md-12 m-r-20 text-left">
                           <img src="{{ asset('assets/images/icono_btc_hasha_rates.png') }}">
                           <span class="m-l-20 font-bold">Dificultad</span>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-6 text-left p-t-20 ">
                           <h2 class="font-light  font-16 ">Actual</h2>
                           <h2 class="font-light  font-16 ">Dificultad 24 H</h2>
                           
                        </div>
                        <div class="col-6 text-right p-t-20 p-b-10">
                           <h2 class="font-light font-16" id="_dificultad_hoy">5.94 TH/s</h2>
                           <h2 class="font-light font-16" id="_dificultad_real_time">6.30 TH/s</h2>
                        </div>
                     </div> 
                     <hr>
                  </div> 

               </div>
              
            </div>
           

         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-lg-12">
         <!-- Column -->
         <div class="card">
            <div class="card-body">
               <!-- Row -->
               <div class="row">
                  <div class="col-12">
                     <h2>Pool Hashrate </i></h2>
                     <h2 id="_grafica" class="text-primary"></h2>
                  </div>
               </div>
            </div>
         </div>
         <!-- Column -->
      </div>
   </div>

@endsection

@section('scripts')
   <!--<script src="{{ asset('assets/js/api_misa.js') }}"></script>-->
   <script src="{{ asset('assets/js/pool_api.js') }}"></script>
@endsection
