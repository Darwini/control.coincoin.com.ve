@extends('layouts.admin.default')

@section('title', 'CoinCoin | Equipos por Usuarios')

@section('scripts')
  <script src="{{asset('assets/plugins/footable/js/footable.all.min.js')}}"></script>
  <script src="{{asset('assets/js/footable-init.js')}}"></script>
  <link href="{{asset('assets/plugins/footable/css/footable.core.css')}}">
  <style type="text/css">
    low{ text-transform: lowercase; }
  </style>
@stop

@section('breadcrum')
  <div class="col-md-5 align-self-center">
    <h4 class="w3-text-black font-bold">Equipos <low>por</low> Usuarios</h4>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{route('instalador')}}" class="text-warning font-bold">Inicio</a>
      </li>
      <li class="breadcrumb-item w3-text-black active">Equipos <low>por</low> Usuarios</li>
    </ol>
  </div>
@stop

@section('content')
	<div class="w3-container">
		<div class="col-lg-12 col-md-12">
			<div class="card w3-border w3-round-xxlarge">
				<div class="card-body w3-responsive">
					<input type="hidden" id="asset" value="{{asset('')}}">
					<input type="hidden" id="url" value="{{url('/')}}">
          <div class="w3-left">
            <div class="form-group">
              <input id="demo-input-search2" placeholder="Buscar" autocomplete="off" type="text">
            </div>
          </div>

          @if(isset($clientes) && count($clientes) > 0 )
            <table id="demo-foo-addrow2" class="footable w3-hoverable w3-table w3-centered color-bordered-table warning-bordered-table" style="border-bottom: 1px solid orange;" data-page-size="20">
              <thead>
                <tr>
                  <th class="footable-sortable" data="{{$i=1}}" >#</th>
                  {{--<th>Cliente</th>--}}
                  <th class="footable-sortable">Usuario</th>
                  <th class="footable-sortable">Correo</th>
                  <th class="footable-sortable">Pool</th>
                  <th class="footable-sortable">Servidor</th>
                  <th>Opciones</th>
                </tr>
              </thead>

              <tbody>
                @foreach($clientes as $usuario)
                <tr>
                  <td>{{$i++}}</td>
                  {{--<td>
                    {{$usuario->clientes->nombre or 'Cliente '}} {{$usuario->clientes->apellido or 'Anonimo '.$i}}
                  </td>--}}
                  <td>{{$usuario->username or '---'}}</td>
                  <td>{{$usuario->email or '---'}}</td>
                  <td>{{$usuario->pool or '---'}}</td>
                  <td>{{$usuario->url_pool or '---'}}</td>
                  <td>
                    <form action="{{route('detalles.mineros.pool')}}" method="POST" class="" style="display: inline;">
                      {{csrf_field()}}
                      <input type="hidden" name="id" value="{{$usuario->id}}">
                      <button style="display: inline;" type="submit" title="Detalles" class="w3-ripple w3-hover-blue w3-border w3-circle w3-light-grey btn btn-sm">
                        <i class="mdi mdi-eye"></i>
                      </button>
                    </form>
                    &nbsp;
                    <form action="{{route('ubicar.pool.local')}}" method="POST" class="" style="display: inline;">
                      {{csrf_field()}}
                      <input type="hidden" name="id" value="{{$usuario->id}}">
                      <button style="display: inline;" type="submit" title="Ubicar" class="w3-ripple w3-hover-orange w3-border w3-circle w3-light-grey btn btn-sm">
                        <i class="mdi mdi-map-marker"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>

              @if(isset($clientes) && count($clientes) > 0 )
              <tfoot style="border-top: 1px solid orange;margin-top: 20px;">
                <tr>
                  <td colspan="5">
                    <div class="text-right">
                      <ul class="pagination">
                      </ul>
                    </div>
                  </td>
                </tr>
              </tfoot>
              @endif
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
@stop