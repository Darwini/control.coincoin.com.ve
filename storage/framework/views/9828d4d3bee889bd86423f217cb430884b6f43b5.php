<?php $__env->startSection('title', 'CoinCoin | Zonas y Espacios'); ?>

<?php $__env->startSection('breadcrum'); ?>
    <div class="col-md-5 align-self-center">
        <h3 class="text-default font-bold">Zonas y Espacios</h3>
    </div>
                        
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('instalador')); ?>" class="text-warning font-bold">Inicio</a>
            </li>
            <li class="breadcrumb-item font-bold active">Zonas y Espacios</li>
        </ol>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/plugins/footable/js/footable.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/footable-init.js')); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/footable/css/footable.core.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')); ?>">
    <script src="<?php echo e(asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
    
    <script type="text/javascript">
        function dibujarack() {
            $(`#paintrack`).empty();
            var filas = $(`#filas`).val();
            var columnas = $(`#columnas`).val();
            if (filas > 20 || columnas > 20 ) {
                alert(`Esas Dimensiones No Estan Permitidas`);
                $(`#filas`).val(``);
                $(`#columnas`).val(``);
            }
            else{
                for(i=1; i <= filas; i++){
                    $(`#paintrack`).append(`<tr id="${i}"> </tr>`);
                    for(j=1; j <= columnas; j++){
                        $('#paintrack tr#'+i).append(`<td></td>`);
                    }
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('installers.zonas.crear_sala', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('installers.zonas.crear_area', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('installers.zonas.crear_rack', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section class="w3-container">      
        <div class="card w3-border w3-round-xxlarge">
            <div class="card-body">
                <h4 class="card-title">Gestión de Zonas</h4>
                <div class="w3-container p-5">
                	<div class="w3-third w3-center">
                		<button class="w3-large w3-border w3-hover-grey w3-btn w3-round mdi mdi-tab" onclick="launchmodal('modalsala')"> Nueva Sala
                		</button>
                	</div>
                	
                	<div class="w3-third w3-center">
                		<button class="w3-large w3-border w3-hover-blue w3-btn w3-round mdi mdi-view-module" onclick="launchmodal('modalarea')"> Nueva Área
                		</button>
                	</div>
                	
                	<div class="w3-third w3-center">
                		<button class="w3-large w3-border w3-hover-blue-grey w3-btn w3-round mdi mdi-grid" onclick="launchmodal('modalrack')"> Nuevo Rack
                		</button>
                	</div>
                </div>
                	
                <div class="row w3-col p-3">
               		<?php $__currentLoopData = $salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sala): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                	<div <?php if(count($salas)==1 ): ?> class="col-md-12" <?php elseif(count($salas)==2): ?> class="col-md-6" <?php elseif(count($salas)==3): ?> class="col-md-4" <?php elseif(3<count($salas) ): ?> class="col-md-3 m-b-20" <?php endif; ?> id="sala" style="margin: 25px 0 25px 0 ;" >
	                		<div class="w3-border w3-border-light-blue w3-center w3-light-grey w3-card-4">
                                <span class="w3-container w3-left" ><h3><b class="w3-border w3-btn w3-grey" onclick="launchmodal('modaleditarS<?php echo e($sala->id); ?>')"><?php echo e($sala->sala); ?>

                            </b></h3></span>
	                		<?php $__currentLoopData = $sala->areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $areaz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                		<section class="w3-container" id="area" style="margin:5px 3px 5px 3px;">
		                			<h5><span class="w3-border w3-blue w3-btn" onclick="launchmodal('modaleditarA<?php echo e($areaz->id); ?>')"><?php echo e($areaz->area); ?> </span>
		                			</h5>
		                			<?php $__currentLoopData = $areaz->racks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rackz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                			<div class="w3-half" id="rack">
		                				<span class="w3-border w3-blue-grey w3-slim w3-tiny btn btn-sm w3-hover-black" onclick="launchmodal('modaleditarR<?php echo e($rackz->id); ?>')" style="width: 100%;">
                                            <?php echo e($rackz->rack); ?>

                                        </span>
		                			</div>
		                			<?php echo $__env->make('installers.zonas.editar_rack', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		                			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                		</section><br>
		                		<?php echo $__env->make('installers.zonas.editar_area', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		                	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                	</div>
		                </div>
		                <?php echo $__env->make('installers.zonas.editar_sala', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               	</div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>