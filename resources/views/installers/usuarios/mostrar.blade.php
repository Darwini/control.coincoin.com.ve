@extends('layouts.admin.default')

@section('title', 'CoinCoin | Usuarios Pool')

@section('scripts')
    <script src="{{asset('assets/plugins/footable/js/footable.all.min.js')}}"></script>
    <script src="{{asset('assets/js/footable-init.js')}}"></script>
    <link href="{{asset('assets/plugins/footable/css/footable.core.css')}}">

    <script type="text/javascript">
        function edit_user_pool(id){
            $("#usuario_pool"+id).modal({backdrop:'static'});
        }
    </script>
@stop

@section('breadcrum')
    <div class="col-md-5 align-self-center">
        <h3 class="w3-text-black font-bold">Usuarios Pool</h3>
    </div>
                        
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('instalador')}}" class="text-warning font-bold">Inicio</a>
            </li>
            <li class="breadcrumb-item font-bold w3-text-black active">Usuarios Pool</li>
        </ol>
    </div>
@stop

@section('content')
    @include('installers.usuarios.usuario_pool')
    <div class="w3-container">
        <div class="col-lg-12 col-md-12">
            <div class="card w3-border w3-round-xxlarge">
                <div class="card-body">
                    <input autocomplete="off" type="hidden" id="asset" value="{{asset('/')}}">
                    <input autocomplete="off" type="hidden" id="url" value="{{url('/')}}">

                    <div class="w3-left">
                        <div class="form-group">
                            <input autocomplete="off" id="demo-input-search2" placeholder="Buscar" autocomplete="off" type="text">
                        </div>
                    </div>

                    <div class="btn-group w3-right">
                        <form action="{{route('usuarios.pool.pdf')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="tipo" value="todos">
                            <button class="w3-btn w3-round m-r-20 w3-border">
                                <span class="w3-large w3-text-red mdi mdi-file-pdf"></span>
                            </button>
                        </form>

                        <button class="w3-border w3-text-blue w3-button w3-large w3-round" style="margin: 0px 25px 0px 25px;" type="submit" onclick="usuario_pool();"><i class="fa fa-plus"></i>&nbsp;<i class="ti ti-user w3-large"></i> </button>
                    </div>

                    @if(isset($users) && count($users) > 0 )
                    <table id="demo-foo-addrow2" class="w3-hoverable w3-table w3-centered color-bordered-table warning-bordered-table" data-page-size="20">
                        <thead>
                            <tr>
                                <th {{$i=1}} >#</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Pool</th>
                                <th>Servidor</th>
                                <th>Permiso de Conexión</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->username}}</td>
                                <td style="text-transform: lowercase;">{{$user->email}}</td>
                                <td>{{$user->pool}}</td>
                                <td>{{$user->url_pool}}</td>
                                <td>{{$user->puid}}</td>
                                <td>
                                    <span class="btn w3-circle w3-border w3-text-blue" onclick="edit_user_pool('{{$user->id}}')">
                                        <i class="mdi mdi-lead-pencil"></i>
                                    </span>
                                </td>
                            </tr>
                            @include('installers.usuarios.editar')
                            @endforeach
                        </tbody>
                        
                        @if(isset($users) && count($users) > 10 )
                        <tfoot style="border-top: 1px solid orange; border-top: 1px solid orange;">
                            <tr>
                                <td colspan="6">
                                    <div class="w3-right" style="margin-top: 8px;">
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
                        @endif
                    </table>
                            
                    <script>
                        function usuario_pool(){
                            $("#modal_usuario_pool").modal({backdrop:'static'});
                        }
                    </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
