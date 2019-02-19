<?php $__env->startSection('title', 'CoinCoin | Historial'); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/plugins/footable/js/footable.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/footable-init.js')); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/footable/css/footable.core.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrum'); ?>
    <div class="col-md-5 align-self-center">
        <h3 class="w3-text-black font-bold">Historial</h3>
    </div>

    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('instalador')); ?>" class="text-warning font-bold">Inicio</a>
            </li>
            <li class="breadcrumb-item w3-text-black font-bold active">Historial</li>
        </ol>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="w3-container">
		<div class="card">
			<div class="card-body">
                <div class="m-t-15">
                    <div class="form-group">
                        <input id="demo-input-search2" placeholder="Buscar" autocomplete="off" type="text">
                    </div>

                    <div class="w3-right m-b-20 m-r-10">
                        <form action="<?php echo e(route('instalaciones.pdf')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="tipo" value="todos">
                            <button type="submit" class="w3-circle w3-border w3-btn">
                                <i class="w3-text-red w3-large mdi mdi-file-pdf"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <table id="demo-foo-addrow2" class="w3-hoverable w3-table w3-centered w3-small color-bordered-table warning-bordered-table" data-page-size="20">
                    <thead>
                        <tr>
                            <th <?php echo e($i=1); ?> >#</th>
                            <th>Cliente</th>
                            <th>Modelo</th>
                            <th>Serial Equipo</th>
                            <th>Serial Fuente</th>
                            <th colspan="4">Ubicación</th>
                            <th>Instalador</th>
                            <th>Fecha Instalación</th>
                            <!-- <th> Opciones </th> -->
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $instalaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instalados): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i++); ?></td>
                                <td>
                                    <?php echo e(isset($instalados->userclient->username) ? $instalados->userclient->username : ''); ?>

                                </td>
                                <td><?php echo e($instalados->modelo); ?></td>
                                <td><?php echo e(isset($instalados->serial_equipo) ? $instalados->serial_equipo : ''); ?></td>
                                <td><?php echo e(isset($instalados->serial_fuente) ? $instalados->serial_fuente : ''); ?></td>
                                <td colspan="4">
                                    <?php echo e(isset($instalados->rack->area->sala->sala) ? $instalados->rack->area->sala->sala : ''); ?>

                                    <?php echo e(isset($instalados->rack->area->area) ? $instalados->rack->area->area : ''); ?>

                                    <?php echo e(isset($instalados->rack->rack) ? $instalados->rack->rack : ''); ?>

                                    <?php echo e($instalados->posicion); ?>

                                </td>
                                <td><?php echo e($instalados->installer->username); ?></td>
                                <td><?php echo e($instalados->created_at); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                    <tfoot style="border-bottom: 1px solid orange;">
                        <tr>
                            <td colspan="10">
                                <div class="text-right" style="margin-top: 8px;">
                                    <ul class="pagination">
                                        <li class="footable-page-arrow disabled">
                                            <a data-page="first" href="#first">«</a>
                                        </li>
                                        <li class="footable-page-arrow disabled">
                                            <a data-page="prev" href="#prev">‹</a>
                                        </li>
                                        <li class="footable-page active">
                                            <a data-page="0" href="#">1</a>
                                        </li>
                                        <li class="footable-page">
                                            <a data-page="1" href="#">2</a>
                                        </li>
                                        <li class="footable-page-arrow">
                                            <a data-page="next" href="#next">›</a>
                                        </li>
                                        <li class="footable-page-arrow">
                                            <a data-page="last" href="#last">»</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>