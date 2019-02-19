<!-- Modal Rack -->
<div class="modal fade" id="modaleditarR<?php echo e($rackz->id); ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content" style="border: 1px solid orange">
            <div class="modal-header" style="border-bottom: 1px solid orange">
                <i class="w3-large w3-text-orange mdi mdi-grid"></i>
                <h5 class="modal-title">Editar : <?php echo e($rackz->rack); ?></h5>
                <button type="button" class="close w3-hover-text-red" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" action="<?php echo e(route('editar.rack')); ?>">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($rackz->id); ?>">
                <div class="modal-body w3-container m-b-5">
                    <div class="w3-half" style="padding: 3px; border-right: 1px dotted blue;">
                    <label class="form-group" style="width: 90%;" for="identificador"> Identificador :<br>
                        <input type="text" required="required" name="rack" class="form-control form-control-sm" placeholder="Nombre" autocomplete="off" value="<?php echo e($rackz->rack); ?>">
                    </label><br>
                                    
                    <label class="form-group" style="width: 100%;" for="ubicacion"> Ubicación :<br>
                        <select class="w3-select" name="area_id" required="required" id="_areas<?php echo e($rackz->id); ?>">
                            <?php if($areas): ?>
                                <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option class="<?php echo e($area->id); ?>" value="<?php echo e($area->id); ?>"><?php echo e($area->area); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </label>
                    </div>

                    <div class="w3-half" style="padding: 3px;">
                        <label class="form-group w3-half">
                            Filas : <br>
                            <input class="form-control form-control-sm" type="number" id="filas<?php echo e($rackz->id); ?>" name="filas" oninput="paintrack(<?php echo e($rackz->id); ?>)" min="1" max="20" required="required" value="<?php echo e($rackz->filas); ?>">
                        </label>

                        <label class="form-group w3-half">
                            Columnas : <br>
                            <input class="form-control form-control-sm" type="number" id="columnas<?php echo e($rackz->id); ?>" name="columnas" oninput="paintrack(<?php echo e($rackz->id); ?>)" min="1" max="20" required="required" value="<?php echo e($rackz->columnas); ?>">
                        </label>

                        <table style="width: 100%" class="w3-border-blue w3-table-all w3-hoverable m-t-5" border="1" id="paintrack<?php echo e($rackz->id); ?>">
                            
                        </table>
                    </div>
                </div>

                <div class="modal-footer w3-container" style="border-top: 1px solid orange; padding: 5px 5px 5px 0px;">
                    <button class="btn btn-info"> Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Modal -->

<script type="text/javascript">
    function cargararea(clase, id){
        $("#_areas"+id+" option."+clase).prop('selected', true);
    }
    cargararea(<?php echo e($rackz->area->id); ?>, <?php echo e($rackz->id); ?>);


    function paintrack(parametro) {
            $("#paintrack"+parametro).empty();
            var filas = $('#filas'+parametro).val();
            var columnas = $('#columnas'+parametro).val();  //console.log(filas, columnas);
            if (filas > 20 || columnas > 20 ) {
                alert('Esas Dimensiones No Estan Permitidas');
                $('#filas').val('');
                $('#columnas').val('');
            }
            else{
                for(i=1; i <= filas; i++){
                    $("#paintrack"+parametro).append('<tr id="'+i+'"> </tr>');
                    for(j=1; j <= columnas; j++){
                        $('#paintrack'+parametro+' tr#'+i).append('<td></td>');
                    }
                }
            }
        }
</script>