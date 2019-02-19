<div id="new" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border: solid 1px orange;">
      <div class="modal-header" style="border-bottom: solid 1px orange;">
        <i class="w3-left w3-xxlarge w3-text-orange mdi mdi-account-card-details"></i>
        <h4 class="modal-title">Agregar Nuevo Registro</h4>
        <span class="w3-btn w3-hover-text-red w3-right" data-dismiss="modal">&times;</span>
      </div>                                          
      <form class="form-material" action="{{route('Admin.store')}}" method="POST">
        {{csrf_field()}}
        <div class="modal-body">
          <div class="form-group">
            <div class="w3-left col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input type="number" class="form-control form-control-sm" placeholder="CÉDULA" name="cedula" min="100" autocomplete="off" required="required">
                <div class="input-group-addon">
                  <i class="fa fa-barcode w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-right col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="NOMBRE Y APELLIDO" name="nombres" autocomplete="off" required="required">
                <div class="input-group-addon">
                  <i class="mdi mdi-account w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-left col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input type="number" class="form-control form-control-sm" placeholder="TELÉFONO" min="100" name="telefono" autocomplete="off" required="required">
                <div class="input-group-addon">
                  <i class="mdi mdi-phone-log w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-right col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <select class="form-control form-control-sm" name="group_id">
                  <option selected="selected" disabled="disabled" value="">Elije un Departamento</option>
                  {{-- <option value="3">Técnico Instalador</option> --}}
                  @foreach($deps as $dep)
                  <option value="{{$dep->id}}">
                    {{$dep->departamento}}
                  </option>
                  @endforeach
                </select>
                <div class="input-group-addon">
                  <i class="mdi mdi-home-modern w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-left col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input required="required" type="text" class="form-control form-control-sm" id="username" placeholder="USUARIO" name="username" autocomplete="off">
                <div class="input-group-addon">
                  <i class="ti ti-user w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-right col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input required="required" type="email" class="form-control form-control-sm" id="email" placeholder="CORREO | EMAIL" name="email" autocomplete="off">
                <div class="input-group-addon">
                  <i class="ti ti-email w3-small"></i>
                </div>
              </div>
            </div>

            <div class="w3-left col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input required="required" type="password" class="form-control form-control-sm" id="pass" placeholder="CLAVE" oninput="comparar(this.value)" name="password" autocomplete="off">
                <div class="input-group-addon">
                  <i class="ti ti-lock w3-small"></i>
                </div>
              </div>
              <div style="display: none;" class="w3-text-red nocoinciden">Las Claves No Conciden
              </div>
            </div>

            <div class="w3-right col-md-5 m-t-10 m-b-10">
              <div class="input-group">
                <input required="required" type="password" class="form-control form-control-sm" id="repass" oninput="comparar(this.value)" placeholder="REPETIR CLAVE" autocomplete="off">
                <div class="input-group-addon">
                  <i class="ti ti-lock w3-small"></i>
                </div>
              </div>
              <div style="display: none;" class="w3-text-red nocoinciden">Las Claves No Conciden
              </div>
            </div>

            <div class="w3-left col-md-5 m-t-10 m-b-10">
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
            </div>
          </div>
        </div>

        <div class="modal-footer col-md-12" style="border-top: solid 1px orange;">
          <button type="button" class="w3-left col-md-2 btn btn-danger w3-hover-text-black waves-effect" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn w3-blue col-md-2 w3-right" id="botonaceptar" style="display: none;">Registrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
