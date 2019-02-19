<!-- The Modal -->
  <div class="modal fade" id="eliminar{{$misequipos->minero_id}}">
    <div class="modal-dialog {{-- modal-lg --}}">
      <div class="modal-content" style="border:1px solid red;">
        <!-- Modal Header -->
        <div class="modal-header w3-small w3-center">
          <p class="w3-text-red">
            <i class="fa fa-trash-o fa-2x"></i>
            <h4 class="modal-title"> Minero {{$misequipos->minero_nombre}}</h4>
          </p>
        </div>
        
        <!-- Modal body -->
        <form method="POST" action="{{route('delete.miner')}}">
          {{csrf_field()}}
          <input type="hidden" name="id" value="{{$misequipos->id}}">
          <div class="modal-body">
            <ul class="w3-container" style="text-transform: none;text-align: justify;">
              Esta por eliminar los datos de este minero.
              <li style="text-transform: lowercase;"> <span style="text-transform: uppercase;">L</span>os seriales de equipo y de fuente se conservarán. Si quiere eliminarlos indiquelo.</li>
              <li>La Posición en el Rack se desocupará.</li>
              <center><h4 style="color: black;">¿Desea Continuar?</h4></center>
            </ul>
            
            <ul class="w3-ul w3-card-2 w3-round w3-center w3-border w3-padding">
              <li>
                ID: {{$misequipos->minero_id}}
                <input type="hidden" name="miner_id" value="{{$misequipos->minero_id}}">
              </li>
              
              <li class="">
                <input type="checkbox" onclick="$(this).parent('li').toggleClass('w3-text-red')" autocomplete="off" autosave="off" name="borrarserialequipo"> Equipo: {{$misequipos->serial_equipo}}
              </li>
              
              <li class="">
                <input type="checkbox" onclick="$(this).parent('li').toggleClass('w3-text-red')" autocomplete="off" autosave="off" name="borrarserialfuente"> Fuente: {{$misequipos->serial_fuente}}
              </li>
              
              <li>Ubicación: {{$misequipos->rack->rack}} Posición {{$misequipos->posicion}}</li>
            </ul>
          </div>
        
          <!-- Modal footer -->
          <div class="w3-container" style="margin: 20px 5px 20px 5px;">
            <button type="submit" class="w3-small w3-left btn btn-success">Si, Eliminar</button>
            <button type="button" class="w3-small w3-right btn btn-danger" data-dismiss="modal">No, Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<!--Fin Modal -->