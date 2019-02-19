


<?php $__env->startSection('title', 'Bienvenido a la plataforma'); ?> 

<?php $__env->startSection('content'); ?>
<section style="margin-bottom: 50px;">
	<center>
		<img src="<?php echo e(asset('assets/images/emblema_coincoin_control.png')); ?>" height="30%" width="30%">
		<h4>Bienvenido a La Plataforma</h4>
	</center>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>