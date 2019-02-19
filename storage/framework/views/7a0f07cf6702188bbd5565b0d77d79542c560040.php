<?php $__env->startSection('title', 'Historico de Alertas'); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrum'); ?>
    <div class="col-md-5 align-self-center">
        <h3 class=" w3-text-black font-bold"> Historico de Alertas </h3>
    </div>

    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('instalador')); ?>" class="text-warning font-bold">Inicio</a>
            </li>

            <li class="breadcrumb-item">
                <a href="<?php echo e(route('Alerts.create')); ?>" class="text-warning font-bold">Historico de Alertas</a>
            </li>
        </ol>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<table class="w3-table-all w3-hoverable">
		<thead>
			<tr class="w3-orange">
				<th>ID</th>
				<th>Minero ID</th>
				<th>Minero Nombre</th>
				<th>Hash 1D</th>
				<th>Hash 15M</th>
				<th>Hash 1M</th>
				<th>Status</th>
				<th>Created At</th>
			</tr>
		</thead>
		<tbody <?php echo e($i=1); ?>>
			<?php $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td> <?php echo e($i++); ?> </td>
					<td> <?php echo e($alert->minero_id); ?> </td>
					<td> <?php echo e($alert->minero_nombre); ?> </td>
					<td> <?php echo e($alert->hash_1d); ?> </td>
					<td> <?php echo e($alert->hash_15m); ?> </td>
					<td> <?php echo e($alert->hash_1m); ?> </td>
					<td> <?php echo e($alert->status); ?> </td>
					<td> <?php echo e($alert->created_at); ?> </td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>