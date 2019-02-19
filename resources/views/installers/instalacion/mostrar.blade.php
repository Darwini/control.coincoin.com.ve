@extends('layouts.admin.default')

@section('title', 'CoinCoin | Historial')

@section('scripts')
    <script src="{{asset('assets/plugins/footable/js/footable.all.min.js')}}"></script>
    <script src="{{asset('assets/js/footable-init.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/footable/css/footable.core.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')}}">
@stop

@section('breadcrum')
    <div class="col-md-5 align-self-center">
        <h3 class="w3-text-black font-bold">Historial</h3>
    </div>

    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('instalador')}}" class="text-warning font-bold">Inicio</a>
            </li>
            <li class="breadcrumb-item w3-text-black font-bold active">Historial</li>
        </ol>
    </div>
@stop

@section('content')
	<div class="w3-container">
		<div class="card">
			<div class="card-body">
                <div class="m-t-15">
                    <div class="form-group">
                        <input id="demo-input-search2" placeholder="Buscar" autocomplete="off" type="text">
                    </div>

                    <div class="w3-right m-b-20 m-r-10">
                        <form action="{{route('instalaciones.pdf')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="tipo" value="todos">
                            <button type="submit" class="w3-circle w3-border w3-btn">
                                <i class="w3-text-red w3-large mdi mdi-file-pdf"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <table id="demo-foo-addrow2" class="w3-hoverable w3-table w3-centered w3-small color-bordered-table warning-bordered-table" data-page-size="20">
                    <thead>
                        <tr>
                            <th {{$i=1}} >#</th>
                            <th>Cliente</th>
                            <th>Modelo</th>
                            <th>Serial Equipo</th>
                            <th>Serial Fuente</th>
                            <th colspan="4">Ubicación</th>
                            <th>Instalador</th>
                            <th>Fecha Instalación</th>
                            <!-- <th> Opciones </th> -->
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($instalaciones as $instalados)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    {{$instalados->userclient->username or ''}}
                                </td>
                                <td>{{$instalados->modelo}}</td>
                                <td>{{$instalados->serial_equipo or ''}}</td>
                                <td>{{$instalados->serial_fuente or ''}}</td>
                                <td colspan="4">
                                    {{$instalados->rack->area->sala->sala or ''}}
                                    {{$instalados->rack->area->area or ''}}
                                    {{$instalados->rack->rack or ''}}
                                    {{$instalados->posicion}}
                                </td>
                                <td>{{$instalados->installer->username}}</td>
                                <td>{{$instalados->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot style="border-bottom: 1px solid orange;">
                        <tr>
                            <td colspan="10">
                                <div class="text-right" style="margin-top: 8px;">
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
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
			</div>
		</div>
	</div>
@stop
