<div id="{{$ubicados->minero_id}}{{$ubicados->rack_id}}{{$ubicados->posicion}}" class="modal">
  <div style="margin-top: 10px;" class="w3-modal-content w3-animate-zoom w3-card-8 modal-lg">
    <header class="w3-blue-grey w3-container">
      <button data-dismiss="modal" class="w3-button w3-right w3-hover-text-red w3-hover-blue-grey" type="button">&times;</button>
      <i class="w3-left mdi mdi-google-photos w3-text-green fa-2x"></i>
      <center>
        <h2 style="font-weight: bolder;color: white;" id="titulo">
          {{$ubicados->modelo}}
        </h2>
      </center>
    </header>
    
    <div class="w3-container w3-black">
      <div class="w3-center" style="margin-top: 2%;">
        <i class="fa fa-user-circle fa-3x w3-text-orange"></i>
        <h3 style="color: white;" id="username">{{$ubicados->userclient->username}}</h3>
        <div>{{date('d-m-Y')}}</div>
      </div>
      <div class="w3-container">
        <ul class="w3-half w3-ul" style="padding: 25px;font-weight: bold;color: white;">
          Hash 1m : 
          <li style="border-bottom: solid 1px orange;text-align: center;" class="hash_1m{{$ubicados->minero_id}}">
            <i class="fa fa-sun-o fa-spin"></i>
          </li>
          Hash 15m : 
          <li style="border-bottom: solid 1px orange;text-align: center;" class="hash_15m{{$ubicados->minero_id}}">
            <i class="fa fa-sun-o fa-spin"></i>
          </li>
          Hash 1d : 
          <li style="border-bottom: 1px solid orange;text-align: center;" class="hash_1d{{$ubicados->minero_id}}">
            <i class="fa fa-sun-o fa-spin"></i>
          </li>
        </ul>
        <ul class="w3-ul w3-half" style="font-weight: bolder;padding: 25px;">
          Minero ID : <li style="border-bottom: solid 1px orange;text-align: center;" id="dato1">{{$ubicados->minero_id}}</li>
          Minero Nombre : <li style="border-bottom: solid 1px orange;text-align: center;" id="dato2">{{$ubicados->minero_nombre}}</li>
          Serial - Fuente de Poder : <li style="border-bottom: solid 1px orange;text-align: center;" id="dato3">{{$ubicados->serial_fuente}}</li>
          Serial - Equipo : <li style="border-bottom: solid 1px orange;text-align: center;" id="dato4">{{$ubicados->serial_equipo}}</li>
        </ul>
      </div>
    </div>
    
    <footer class="w3-center w3-padding-small w3-blue-grey">
      <p class="w3-large" style="font-weight: bold;" id="pie">{{$ubicados->rack->rack}} Posición : {{$ubicados->posicion}}</p>
    </footer>
  </div>
</div>