<div id="edit{{$persona->id}}" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border: solid 1px orange;">
      <div class="modal-header" style="border-bottom: solid 1px orange; ">
        <i class="w3-left w3-large w3-text-orange fa fa-edit"></i>
        <h4 class="modal-title">Editar Registro</h4>
        <button class="w3-btn w3-hover-text-red w3-right" data-dismiss="modal" aria-hidden="true">x</button>
      </div>
                                                
      <form class="form-material" action="{{url('Admin/{$persona->id}')}}" method="PUT">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$persona->id}}">
        <div class="modal-body">
          <div class="form-group">
            <div class="w3-left col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input type="number" class="form-control form-control-sm" placeholder="CÉDULA" name="cedula" min="100" autocomplete="off" required="required" value="{{$persona->cedula}}">
                <div class="input-group-addon">
                  <i class="fa fa-barcode w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-right col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="NOMBRE Y APELLIDO" name="nombres" autocomplete="off" required="required" value="{{$persona->nombres}}">
                <div class="input-group-addon">
                  <i class="mdi mdi-account w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-left col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input type="number" class="form-control form-control-sm" placeholder="TELÉFONO" min="100" name="telefono" autocomplete="off" required="required" value="{{$persona->telefono}}">
                <div class="input-group-addon">
                  <i class="mdi mdi-phone-log w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-right col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <select class="form-control form-control-sm" name="group_id" id="dep{{$persona->id}}">
                <option selected="selected" disabled="disabled" value=""> Departamentos </option>
                @foreach($deps as $dep)
                <option class="{{$dep->id}}" value="{{$dep->id}}">{{$dep->departamento}}</option>
                @endforeach
              </select>
                <div class="input-group-addon">
                  <i class="mdi mdi-home-modern w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-left col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input required="required" type="text" class="form-control form-control-sm" id="username" placeholder="USUARIO" name="username" autocomplete="off" value="{{$persona->user->username}}">
                <div class="input-group-addon">
                  <i class="ti ti-user w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-right col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input required="required" type="email" class="form-control form-control-sm" id="email" placeholder="CORREO | EMAIL" name="email" autocomplete="off" value="{{$persona->user->email}}">
                <div class="input-group-addon">
                  <i class="ti ti-email w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-left col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input required="required" type="password" class="form-control form-control-sm" id="pass" placeholder="CLAVE" oninput="comparar(this.value)" name="password" autocomplete="off" value="{{'123456'}}" disabled="disabled">
                <div class="input-group-addon">
                  <i class="ti ti-lock w3-small"></i>
                </div>
              </div>
            </div>

            {{-- <div class="w3-left col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <select name="roles_id" class="form-control form-control-sm">
                  <option selected="selected" disabled="disabled" value=""> Elije el Rol de este Usuario</option>
                  @foreach($roles as $role)
                    <option value="{{$role->id}}"> {{$role->display_name}} </option>
                  @endforeach
                </select>
                <div class="input-group-addon">
                  <i class="ti ti-list w3-small"></i>
                </div>
              </div>
            </div> --}}
          </div>
        </div>

        <div class="modal-footer" style="border-top: solid 1px orange;">
          <button type="submit" class="btn btn-info waves-effect">Editar</button>
          <button type="button" class="btn btn-sm btn-default waves-effect" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript">
    function select_departament(id,dep_id) {
      $('#dep'+id).find('.'+dep_id).prop('selected', true);
    }

    $(document).ready(function() {
      select_departament('{{$persona->id}}', '{{$persona->user->group_id}}');
    });
  </script>
</div>