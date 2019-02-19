<!-- Modal Area -->
<div class="modal fade" id="modaleditarA{{$areaz->id}}" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content" style="border: 1px solid orange">
      <div class="modal-header" style="border-bottom: 1px solid orange">
        <i class="w3-large w3-text-orange mdi mdi-domain"></i>
        <h5 class="modal-title">Editar Área</h5>
        <button type="button" class="close w3-hover-text-red" data-dismiss="modal">&times;</button>
      </div>

      <form method="POST" action="{{route('editar.area')}}">
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="id" value="{{$areaz->id}}">
          <label class="form-group" style="width: 100%;"> Nombre del Área :<br>
            <input autocomplete="off" type="text" required="required" name="area" class="form-control form-control-sm" placeholder="Distintivo del Área" value="{{$areaz->area}}">
          </label><br>
                                    
          <label class="form-group" style="width: 100%;"> Descripción : <br>
            <input class="form-control form-control-sm" autocomplete="off" type="text" name="descripcion" value="{{$areaz->descripcion}}">
          </label>

          <label class="form-group" style="width: 100%;"> Ubicación : <br>
            <select id="slas{{$areaz->id}}" name="sala_id" required="required" style="width: 100%;">
              @if($salas)
                @foreach($salas as $sala)
                  <option class="{{$sala->id}}" value="{{$sala->id}}" > {{$sala->sala}} </option>
                @endforeach
                @else
                <option> Aun no hay Registros </option>
              @endif
            </select>
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

<script type="text/javascript">
  
  function cargarsala(clase, id){
    $("#slas"+id+" option."+clase).prop('selected', true);
  }
  
  cargarsala( {{$areaz->sala->id}},{{$areaz->id}} );
</script>