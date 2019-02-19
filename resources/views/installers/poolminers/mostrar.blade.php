@extends('layouts.admin.default')

@section('title', 'CoinCoin | Ubicar Minadores')

@section('breadcrum')
    <div class="col-md-5 align-self-center">
        <h3 class=" w3-text-black font-bold">Ubicar Mineros</h3>
    </div>

    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('instalador')}}" class="text-warning font-bold">Inicio</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('usu.equipos')}}" class="text-warning font-bold">Usuarios/Equipos</a>
            </li>
            
            <li class="breadcrumb-item w3-text-black active">Ubicar Mineros</li>
        </ol>
    </div>
@stop

@section('scripts')
    <span id="url" value="{{url('')}}"></span>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select1/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/footable/css/footable.core.css')}}">
    <script src="{{ asset('assets/plugins/footable/js/footable.all.min.js')}}"></script>
    <script src="{{ asset('assets/js/footable-init.js')}}"></script>
    <script src="{{ asset('assets/plugins/select1/select2.full.min.js') }}"></script>
    
    <script type="text/javascript">
        function minerospool(puid) {
            var uri=$("#url").attr('value');
            var url=uri+'/user/pool/miner/'+puid;
            var bd=[]; var pool=[];
            $.get( url, function(datos){
                $.each(datos.datos, function(indice1,variable){
                    _cad = '';
                    $.each(variable, function(subindice,minero){
                        $("#_total, #_activos").html(subindice+1);
                        
                        var lid=$("li#"+minero.mineros_id).attr('id');
                        
                        if (lid==minero.mineros_id) {
                            $("#ico"+minero.mineros_id).removeClass("w3-text-red").addClass("w3-text-green");
                        }

                        if (lid==minero.mineros_id) { _cad+='<tr></tr>'; }
                        else{
                            _cad+=`<tr>
                                    <td><i class="fa fa-circle w3-text-green"></i></td>
                                    <td> ${minero.mineros_id} </td>
                                    <input type="hidden" value="${minero.mineros_id}" name="newminero_id[]">
                                    
                                    <td> ${minero.mineros_nombre} </td>
                                    <input type="hidden" value="${minero.mineros_nombre}" name="newminero_nombre[]">

                                    <td>
                                        <input type="text" name="newserial_equipo[]" id="serialequipo" value="" class="form-control form-control-sm w3-center" placeholder="Serial Minero" required="required">
                                    </td>
                                
                                    <td>
                                        <input type="text" name="newserial_fuente[]" id="serialfuente" value="" class="form-control form-control-sm w3-center" placeholder="Serial Fuente" required="required">
                                    </td>

                                    <td>
                                        <input type="text" name="newmodelo[]" class="form-control form-control-sm" value="" placeholder="Indique el Modelo" style="text-align:center;" required="required">
                                    </td>
                                
                                    <td>
                                        <div class="form-group">
                                        <div class="input-group" onclick="modalrack('${minero.mineros_id}');" oninput="modalrack('${minero.mineros_id}');">
                                            <input class="form-control form-control-sm w3-center w3-small" id="enter${minero.mineros_id}" placeholder="Ubicación" type="text" required="required" readonly="readonly">
                                            <input type="hidden" name="newrack_id[]" id="inputrack${minero.mineros_id}" value="">
                                            <input type="hidden" name="newposicion[]" id="inputposicion${minero.mineros_id}" value="">
                                        </div>
                                    </div>
                                    </td>
                                    
                                    <td>
                                        <i onclick="modalrack('${minero.mineros_id}');" oninput="modalrack('${minero.mineros_id}');" title="Ubicar" class="w3-text-orange fa fa-map-marker fa-2x">
                                        </i>
                                    </td>
                            </tr>`;
                        }
                    });
                });
                $("#minerz").append(_cad);
            }).fail( function( jqXHR, textStatus, errorThrown ) {
                if (jqXHR.status==500) {
                    minerospool(puid);
                }
            });
        }
/*
    function serialezequipos(minero_id) { $("#modalserialezequipos").modal({'backdrop' : 'static'}); }
    function serialezfuentes(minero_id){ $("#modalserialezfuentes").modal({'backdrop' : 'static'}); }
*/
        var datos=[];
        function modalrack(ind){
            $("#modalrack").modal({'backdrop' : 'static'});
            datos[0]=ind;
        }

        function possi(coordenada,tdid, rackid) {
            datos[1]=coordenada;
            $("#posicionar").attr("onclick", "dp("+rackid+")");
            $('#rk .'+datos[0]+' i').removeClass('w3-text-red').addClass('w3-text-blue');
            $('#rk .'+datos[0]).removeClass(datos[0]).find('img').toggle();
            $('#'+tdid).addClass(datos[0]);
        }
        function dp(rackid) {
            $("#enter"+datos[0]).val(datos[1]);
            $("#enter"+datos[0]).show();
            var splitt=datos[1].split('-');
            var posicion=splitt[3];
            $("#inputrack"+datos[0]).val(rackid);
            $("#inputposicion"+datos[0]).val(posicion);
            $("#aceptar").show();
            // console.log(rackid,posicion);
        }
        
        //function closemodalr(){ $("#modalrack").modal('hide'); }

        var slideIndex = 1;
        showDivs(slideIndex);
                        
        function plusDivs(n) { showDivs(slideIndex += n); }
        function currentDiv(n) { showDivs(slideIndex = n); }

        function showDivs(n) {
            var i; var x = document.getElementsByClassName("mySlides");
            if (n > x.length) { slideIndex = 1; }
            if (n < 1) { slideIndex = x.length; }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex-1].style.display = "block"; //setTimeout(showDivs, 10000);
        }

        function ubicardatos(rack, posicion, cliente_username, minero_id){
            var disponible="{{asset('assets/images/minero_disponible.png')}}";
            $('#rack'+rack+'posicion'+posicion).html('<i class="w3-text-red w3-large mdi mdi-block-helper"></i>&nbsp;'+posicion+'<div style="font-size:10px;text-transform:capitalize;">'+cliente_username+'</div></div>');
            $('#rack'+rack+'posicion'+posicion).attr('onclick', '');
            $('#rack'+rack+'posicion'+posicion).addClass(minero_id);
        }
        
        function meliminar(id){
            $("#eliminar"+id).modal({'backdrop' : 'false'});
        }

        $(document).ready(function() {
            $('#serialequipos, #serialfuentes').select2();
            minerospool('{{$user[0]->puid}}');
            
            <?php  foreach($ubicaciones as $ubicados){ ?>
                ubicardatos('{{$ubicados->rack_id}}','{{$ubicados->posicion}}','{{$ubicados->userclient->username}}','{{$ubicados->minero_id}}');
            <?php } ?>
        });
    </script>
@stop

@section('content')
    <section class="w3-row">
        <div class="card">
            <div class="card-body">
                <span class="w3-large w3-center">
                    <center>
                        <i class="fa fa-user w3-text-orange"> </i> : 
                        {{$user[0]->username}}<br>
                    </center>
                    
                    <content class="w3-card-2 w3-left w3-border w3-round w3-border-orange p-10" style="display:inline; width: 20%; margin:16px 2.5% 16px 2.5%;">
                        <center>Pool : {{strtoupper($user[0]->pool)}}</center>
                    </content>
                    
                    <content class="w3-card-2 w3-left w3-border w3-round w3-border-orange p-10" style="display:inline; width: 20%; margin:16px 2.5% 16px 2.5%;">
                        <center>Servidor : {{strtoupper($user[0]->url_pool)}}</center>
                    </content>

                    <content class="w3-card-2 w3-left w3-border w3-round w3-border-orange p-10" style="display:inline; width: 20%; margin:16px 2.5% 16px 2.5%;">
                        <center>Activos : <span id="_activos">{{'?'}}</span></center>
                    </content>

                    <content class="w3-card-2 w3-left w3-border w3-round w3-border-orange p-10" style="display:inline; width: 20%; margin:16px 2.5% 16px 2.5%;">
                        <center>Total : <span id="_total">{{'?'}}</span></center>
                    </content>
                </span>

                <div class="w3-responsive m-t-20 m-b-20" style="width: 100%;">
                    <form method="POST" action="{{route('procesar.ubicar.pool')}}">
                        {{csrf_field()}}
                        <table id="demo-foo-addrow" class="w3-table-all footable w3-small w3-hoverable w3-centered" data-page-size="15">
                            <thead>
                                <tr class="w3-orange">
                                    <th> <i class="fa fa-circle w3-text-white"></i> </th>
                                    <th>Minero ID</th>
                                    <th>Minero Nombre</th>
                                    <th>Serial Equipos</th>
                                    <th>Serial Fuente</th>
                                    <th>Modelo</th>
                                    <th>Ubicación Rack</th>
                                    <th>Opc.</th>
                                </tr>
                            </thead>
                        
                            <input type="hidden" name="cliente_user_id" value="{{$user[0]->id}}">
                            <input type="hidden" name="instalador_user_id" value="{{Auth::user()->id}}">
                            <tbody id="minerz">
                                @if(isset($mios))
                                    @foreach($mios as $misequipos)
                                        <ul style="display: none;">
                                            <li id="{{$misequipos->minero_id}}"></li>
                                        </ul>
                                        <input type="hidden" name="id_ubicacion[]" value="{{$misequipos->id}}">
                                        <tr>
                                            <td>
                                                <i id="ico{{$misequipos->minero_id}}" class="fa fa-circle w3-text-red"></i>
                                            </td>
                                            
                                            <td>
                                                {{$misequipos->minero_id}}
                                                <input type="hidden" value="{{$misequipos->minero_id}}" name="minero_id[]">
                                            </td>
                                            <td>{{$misequipos->minero_nombre}}</td>
                                            
                                            <td>
                                                @if( isset($misequipos->serial_equipo) )
                                                    {{$misequipos->serial_equipo}}
                                                @else
                                                <input onclick="serialezequipos('{{$misequipos->minero_id}}')" type="text" name="serial_equipo[]" id="serialequipo" value="" placeholder="Serial Minero" class="form-control form-control-sm w3-center" autocomplete="off" required="required" />
                                                @endif
                                            </td>
                                            
                                            <td>
                                                @if( isset($misequipos->serial_fuente) )
                                                    {{$misequipos->serial_fuente}}
                                                @else
                                                <input type="text" name="serial_fuente[]" id="serialfuente" value="" placeholder="Serial Fuente" class="form-control form-control-sm w3-center" autocomplete="off" required="required" />
                                                @endif
                                            </td>
                                            
                                            <td>
                                                @if( isset($misequipos->modelo) )
                                                    {{$misequipos->modelo}}
                                                @else
                                                <input type="text" name="modelo[]" class="form-control form-control-sm" value="" placeholder="Indique el Modelo" style="text-align:center;" autocomplete="off" required="required" />
                                                @endif
                                            </td>
                                            
                                            <td>
                                                @if( isset($misequipos->rack_id) )
                                                    {{$misequipos->rack->rack}} Posición {{$misequipos->posicion}}
                                                    <input class="w3-input form-control-sm w3-tiny w3-center" id="enter{{$misequipos->minero_id}}" placeholder="Mover :" type="text" required="required" readonly="readonly" style="margin: 0px;padding: 0px;display: none;">
                                                    <input type="hidden" name="rack_id[]" id="inputrack{{$misequipos->minero_id}}" value="">
                                                    <input type="hidden" name="posicion[]" id="inputposicion{{$misequipos->minero_id}}" value="">
                                                @else
                                                <div class="form-group">
                                                    <div class="input-group" onclick="modalrack('{{$misequipos->minero_id}}');">
                                                        <input class="form-control form-control-sm w3-center" oninput="modalrack('{{$misequipos->minero_id}}');" id="enter{{$misequipos->minero_id}}" placeholder="Ubicación" type="text" autocomplete="off" required="required" onkeypress="modalrack('{{$misequipos->minero_id}}');">

                                                        <input type="hidden" name="rack_id[]" id="inputrack{{$misequipos->minero_id}}" value="" required="required">
                                                        <input type="hidden" name="posicion[]" id="inputposicion{{$misequipos->minero_id}}" value="" required="required">
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                <i onclick="modalrack('{{$misequipos->minero_id}}');" class="w3-light-grey w3-circle w3-hover-text-blue fa fa-random fa-2x" title="Mover"></i>&nbsp;
                                                <i onclick="meliminar('{{$misequipos->minero_id}}');" class="w3-light-grey w3-circle w3-hover-text-red fa fa-trash-o fa-2x" title="Eliminar"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            
                            <tfoot id="miners">
                                <tr style="display: none;" id="aceptar">
                                    <td colspan="8" style="text-align:right;">
                                        <button class="w3-button w3-small w3-round w3-blue-grey w3-hover-blue">
                                            Aceptar 
                                            <i class="w3-text-white fa fa-check"></i> 
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Rack -->
        <div class="modal fade" id="modalrack" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="w3-small modal-content" style="border: 1px solid orange;">
                    <div class="modal-header" style="border-bottom: 1px solid orange;">
                        <i class="w3-text-orange w3-left w3-xlarge mdi mdi-apps"></i>
                        <h4 class="modal-title">Ubicar en Rack</h4>
                        <button data-dismiss="modal" type="button" class="close w3-right btn w3-hover-text-red">×</button>
                    </div>

                    <div class="modal-body" id="rk">                    
                        @if(isset($salas) && count($salas)>0)
                            @foreach($salas as $sala)
                            <div id="Sala{{$sala->id}}">
                                @foreach($sala->areas as $area)
                                <div id="Area{{$area->id}}">
                                    @foreach($area->racks as $rack)
                                    <div class="mySlides w3-responsive" id="Rack{{$rack->id}}">
                                        <table class="w3-table w3-centered w3-tiny" border="1" style="width: 100%; margin: 0px 0px 10px 0%; border: 1px solid;">
                                            <tr class="w3-orange">
                                                <td class="w3-large font-bold" colspan="{{$rack->columnas}}">
                                                    {{$sala->sala}} : {{$area->area}} : {{$rack->rack}}
                                                </td>
                                            </tr {{$k=1}}>
                                            @for($i=0; $i<$rack->filas; $i++)
                                            <tr id="rack{{$rack->id}}">
                                                @for($j=0; $j<$rack->columnas; $j++)
                                                <td class="w3-hover-grey" id="rack{{$rack->id}}posicion{{$k}}" posicion="{{$sala->sala}}-{{$area->area}}-{{$rack->rack}}-{{$k}}" rack="{{$rack->id}}" onclick="possi( $(this).attr('posicion'), $(this).attr('id'), $(this).attr('rack') );$(this).find('img').toggle();">
                                                    <img src="{{asset('assets/images/minero_disponible.png')}}" style="width: 30px;" class="w3-round">
                                                    <img src="{{asset('assets/images/minero_100_operativo.png')}}" style="display: none;width: 30px;" class="w3-round"> &nbsp;{{$k++}}
                                                </td>
                                                @endfor
                                            </tr>
                                            @endfor
                                        </table>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        @endif
                        <div class="w3-center w3-small">
                            <div class="w3-container">
                                <button class="w3-btn w3-round w3-hover-blue-grey w3-border w3-tiny" onclick="plusDivs(-1)">❮ Anterior</button>
                                <button class="w3-btn w3-round w3-hover-blue-grey w3-border w3-tiny" onclick="plusDivs(1)">Siguiente ❯</button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="border-top: solid 1px orange;" id="pieserial">
                        <a data-dismiss="modal" onclick="" class="w3-border w3-hover-green w3-round w3-ripple w3-button" id="posicionar">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
    <!--Fin Modal-->
    
    @if(isset($mios))
        @foreach($mios as $misequipos)
            @include('installers.poolminers.delete')
        @endforeach
    @endif
@stop