@extends('layouts.admin.default')

@section('title', 'ControlCoin | Personal')

@section('scripts')
  <script src="{{asset('assets/plugins/footable/js/footable.all.min.js')}}"></script>
  <script src="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
  <script src="{{asset('assets/js/footable-init.js')}}"></script>
  <link  href="{{asset('assets/plugins/footable/css/footable.core.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')}}">
  <script type="text/javascript">
    function comparar(){
      var pass=$("#pass").val();
      var repass=$("#repass").val();
      if( pass !== repass ){
        $(`.nocoinciden`).show();
        $(`#botonaceptar`).hide();
      }
      else{
        $(`.nocoinciden`).hide();
        $(`#botonaceptar`).show();  
      }
    }

    function newuser() {
      $(`#new`).modal({backdrop:`static`});
    }

    function editarpersonal(id) {
      $(`#edit${id}`).modal({backdrop:`static`});
    }
  </script>
@stop

@section('breadcrum')
  <div class="col-md-5 align-self-center">
    <h3 class="text-default font-bold">Personal</h3>
  </div>
                        
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{url('/')}}" class="text-warning font-bold">Inicio</a>
      </li>
      <li class="breadcrumb-item font-bold active">Personal</li>
    </ol>
  </div>
@stop

@section('content')
  @include('personal.create')
  <section>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="w3-right">
              <span class="w3-right w3-border w3-text-blue w3-btn m-l-10 m-r-10" onclick="newuser()">
                <i class="fa fa-plus"></i> 
              </span>
              <a href="{{route('personal.pdf')}}" target="_blank" class="w3-left m-l-10 m-r-10">
                <span class="w3-btn w3-border">
                  <i class="w3-small w3-text-red mdi mdi-file-pdf"></i>
                </span>
              </a>
            </div>
            <div class="w3-left">
              <input class="form-group form-group-sm" id="demo-input-search2" placeholder="Buscar" autocomplete="off" type="text">
            </div>

            @if(isset($personal))
            <div class="table-responsive">
              <table id="demo-foo-addrow2" class="w3-table w3-centered m-t-5 w3-hoverable color-bordered-table warning-bordered-table w3-small" data-page-size="10">
                <thead>
                  <tr>
                    <th {{$i=1}}> # </th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Depart.</th>
                    <th>Estatus</th>
                    <th>Opc.</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($personal as $persona)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$persona->user->username}}</td>
                      <td>{{$persona->user->email}}</td>
                      <td>{{$persona->user->departamento->departamento}}</td>
                      <td>
                        @if($persona->status == 1)
                          <span class="label label-success">Activo</span>
                        @elseif($persona->status == 0)
                          <span class="label label-danger">Desactivado</span>
                        @endif
                      </td>
                      <td>
                        <span class="w3-btn w3-small w3-round w3-blue" onclick="editarpersonal('{{$persona->id}}')">
                          <i class="fa fa-edit"></i>
                        </span>
                      </td>
                    </tr>
                    @include('personal.edit')
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
          </div>
        </div>
        <!-- Column -->
      </div>
    </div>
  </section>
@stop
