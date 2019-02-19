<div id="<?php echo e($ubicados->minero_id); ?><?php echo e($ubicados->rack_id); ?><?php echo e($ubicados->posicion); ?>" class="modal">
  <div style="margin-top: 10px;" class="w3-modal-content w3-animate-zoom w3-card-8 modal-lg">
    <header class="w3-blue-grey w3-container">
      <button data-dismiss="modal" class="w3-button w3-right w3-hover-text-red w3-hover-blue-grey" type="button">&times;</button>
      <i class="w3-left mdi mdi-google-photos w3-text-green fa-2x"></i>
      <center>
        <h2 style="font-weight: bolder;color: white;" id="titulo">
          <?php echo e($ubicados->modelo); ?>

        </h2>
      </center>
    </header>
    
    <div class="w3-container w3-black">
      <div class="w3-center" style="margin-top: 2%;">
        <i class="fa fa-user-circle fa-3x w3-text-orange"></i>
        <h3 style="color: white;" id="username"><?php echo e($ubicados->userclient->username); ?></h3>
        <div><?php echo e(date('d-m-Y')); ?></div>
      </div>
      <div class="w3-container">
        <ul class="w3-half w3-ul" style="padding: 25px;font-weight: bold;color: white;">
          Hash 1m : 
          <li style="border-bottom: solid 1px orange;text-align: center;" class="hash_1m<?php echo e($ubicados->minero_id); ?>">
            <i class="fa fa-sun-o fa-spin"></i>
          </li>
          Hash 15m : 
          <li style="border-bottom: solid 1px orange;text-align: center;" class="hash_15m<?php echo e($ubicados->minero_id); ?>">
            <i class="fa fa-sun-o fa-spin"></i>
          </li>
          Hash 1d : 
          <li style="border-bottom: 1px solid orange;text-align: center;" class="hash_1d<?php echo e($ubicados->minero_id); ?>">
            <i class="fa fa-sun-o fa-spin"></i>
          </li>
        </ul>
        <ul class="w3-ul w3-half" style="font-weight: bolder;padding: 25px;">
          Minero ID : <li style="border-bottom: solid 1px orange;text-align: center;" id="dato1"><?php echo e($ubicados->minero_id); ?></li>
          Minero Nombre : <li style="border-bottom: solid 1px orange;text-align: center;" id="dato2"><?php echo e($ubicados->minero_nombre); ?></li>
          Serial - Fuente de Poder : <li style="border-bottom: solid 1px orange;text-align: center;" id="dato3"><?php echo e($ubicados->serial_fuente); ?></li>
          Serial - Equipo : <li style="border-bottom: solid 1px orange;text-align: center;" id="dato4"><?php echo e($ubicados->serial_equipo); ?></li>
        </ul>
      </div>
    </div>
    
    <footer class="w3-center w3-padding-small w3-blue-grey">
      <p class="w3-large" style="font-weight: bold;" id="pie"><?php echo e($ubicados->rack->rack); ?> Posición : <?php echo e($ubicados->posicion); ?></p>
    </footer>
  </div>
</div>