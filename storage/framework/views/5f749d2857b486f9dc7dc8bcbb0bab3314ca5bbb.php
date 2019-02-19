<!-- Modal Sala -->
<div class="modal fade" id="modalsala" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content" style="border: 1px solid orange">
      <div class="modal-header" style="border-bottom: 1px solid orange">
        <i class="w3-large w3-text-orange mdi mdi-city"></i>
        <h5 class="modal-title">Crear Nueva Sala</h5>
        <button type="button" class="close w3-hover-text-red" data-dismiss="modal">&times;</button>
      </div>

      <form method="POST" action="<?php echo e(route('crear.sala')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="modal-body">
          <label class="form-group" style="width: 100%;"> Nombre de la Sala :<br>
            <input autocomplete="off" type="text" required="required" name="sala" class="form-control w3-input form-control-sm" placeholder="Nombre de Referencia" value="<?php echo e(old('sala')); ?>">
          </label><br>
                                    
          <label class="form-group" style="width: 100%;"> Descripción : <br>
            <input class="w3-input form-control-sm form-control" autocomplete="off" type="text" name="descripcion" placeholder="Punto de Referencia, Ubicación o Algún Detalle Extra" value="<?php echo e(old('descripcion')); ?>">
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