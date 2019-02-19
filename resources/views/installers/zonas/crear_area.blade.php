<!-- Modal Area -->
<div class="modal fade" id="modalarea" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content" style="border: 1px solid orange">
      <div class="modal-header" style="border-bottom: 1px solid orange">
        <i class="w3-large w3-text-orange mdi mdi-domain"></i>
        <h5 class="modal-title">Crear Nueva Área</h5>
        <button type="button" class="close w3-hover-text-red" data-dismiss="modal">&times;</button>
      </div>

      <form method="POST" action="{{route('crear.area')}}">
        {{csrf_field()}}
        <div class="modal-body">
          <label class="form-group" style="width: 100%;"> Nombre del Área :<br>
            <input autocomplete="off" type="text" required="required" name="area" class="form-control form-control-sm" placeholder="Distintivo del Área" value="{{old('area')}}">
          </label><br>
                                    
          <label class="form-group" style="width: 100%;"> Descripción : <br>
            <input class="form-control form-control-sm" autocomplete="off" type="text" name="descripcion" value="{{old('descripcion')}}">
          </label>

          <label class="form-group" style="width: 100%;"> Ubicación : <br>
            <select class="selectpicker" name="sala_id" required="required" data-live-search="true" style="width: 100%;">
              <option value="" selected="selected" disabled="disabled">Sala </option>
              @if($salas)
                @foreach($salas as $sala)
                  <option value="{{$sala->id}}">{{$sala->sala}} </option>
                @endforeach
                @else
                <option> Aun no hay Registros </option>
              @endif
            </select>
          </label>
        </div>

        <div class="modal-footer" style="border-top: 1px solid orange">
          <button class="btn btn-info">Crear</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fin Modal -->