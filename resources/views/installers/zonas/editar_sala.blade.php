<!-- Modal Sala -->
<div class="modal fade" id="modaleditarS{{$sala->id}}" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content" style="border: 1px solid orange">
      <div class="modal-header" style="border-bottom: 1px solid orange">
        <i class="w3-large w3-text-orange mdi mdi-city"></i>
        <h5 class="modal-title">Editar Sala</h5>
        <button type="button" class="close w3-hover-text-red" data-dismiss="modal">&times;</button>
      </div>

      <form method="POST" action="{{route('editar.sala')}}">
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="id" value="{{$sala->id}}">
          <label class="form-group" style="width: 100%;"> Nombre de la Sala :<br>
            <input autocomplete="off" type="text" required="required" name="sala" class="form-control w3-input form-control-sm" placeholder="Nombre de Referencia" value="{{$sala->sala}}">
          </label><br>
                                    
          <label class="form-group" style="width: 100%;"> Descripción : <br>
            <input class="w3-input form-control-sm form-control" autocomplete="off" type="text" name="descripcion" placeholder="Punto de Referencia, Ubicación o Algún Detalle Extra" value="{{$sala->descripcion}}">
          </label>
        </div>

        <div class="modal-footer" style="border-top: 1px solid orange">
          <button class="btn btn-info"> Editar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fin Modal -->