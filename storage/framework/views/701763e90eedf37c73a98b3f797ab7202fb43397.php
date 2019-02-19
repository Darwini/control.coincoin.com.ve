<?php $__env->startSection('title', 'CoinCoin | Equipos por Usuarios'); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/footable/js/footable.all.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/footable-init.js')); ?>"></script>
  <link href="<?php echo e(asset('assets/plugins/footable/css/footable.core.css')); ?>">
  <style type="text/css">
    low{ text-transform: lowercase; }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrum'); ?>
  <div class="col-md-5 align-self-center">
    <h4 class="w3-text-black font-bold">Equipos <low>por</low> Usuarios</h4>
  </div>
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo e(route('instalador')); ?>" class="text-warning font-bold">Inicio</a>
      </li>
      <li class="breadcrumb-item w3-text-black active">Equipos <low>por</low> Usuarios</li>
    </ol>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="w3-container">
		<div class="col-lg-12 col-md-12">
			<div class="card w3-border w3-round-xxlarge">
				<div class="card-body w3-responsive">
					<input type="hidden" id="asset" value="<?php echo e(asset('')); ?>">
					<input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
          <div class="w3-left">
            <div class="form-group">
              <input id="demo-input-search2" placeholder="Buscar" autocomplete="off" type="text">
            </div>
          </div>

          <?php if(isset($clientes) && count($clientes) > 0 ): ?>
            <table id="demo-foo-addrow2" class="footable w3-hoverable w3-table w3-centered color-bordered-table warning-bordered-table" style="border-bottom: 1px solid orange;" data-page-size="20">
              <thead>
                <tr>
                  <th class="footable-sortable" data="<?php echo e($i=1); ?>" >#</th>
                  
                  <th class="footable-sortable">Usuario</th>
                  <th class="footable-sortable">Correo</th>
                  <th class="footable-sortable">Pool</th>
                  <th class="footable-sortable">Servidor</th>
                  <th>Opciones</th>
                </tr>
              </thead>

              <tbody>
                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($i++); ?></td>
                  
                  <td><?php echo e(isset($usuario->username) ? $usuario->username : '---'); ?></td>
                  <td><?php echo e(isset($usuario->email) ? $usuario->email : '---'); ?></td>
                  <td><?php echo e(isset($usuario->pool) ? $usuario->pool : '---'); ?></td>
                  <td><?php echo e(isset($usuario->url_pool) ? $usuario->url_pool : '---'); ?></td>
                  <td>
                    <form action="<?php echo e(route('detalles.mineros.pool')); ?>" method="POST" class="" style="display: inline;">
                      <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="id" value="<?php echo e($usuario->id); ?>">
                      <button style="display: inline;" type="submit" title="Detalles" class="w3-ripple w3-hover-blue w3-border w3-circle w3-light-grey btn btn-sm">
                        <i class="mdi mdi-eye"></i>
                      </button>
                    </form>
                    &nbsp;
                    <form action="<?php echo e(route('ubicar.pool.local')); ?>" method="POST" class="" style="display: inline;">
                      <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="id" value="<?php echo e($usuario->id); ?>">
                      <button style="display: inline;" type="submit" title="Ubicar" class="w3-ripple w3-hover-orange w3-border w3-circle w3-light-grey btn btn-sm">
                        <i class="mdi mdi-map-marker"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>

              <?php if(isset($clientes) && count($clientes) > 0 ): ?>
              <tfoot style="border-top: 1px solid orange;margin-top: 20px;">
                <tr>
                  <td colspan="5">
                    <div class="text-right">
                      <ul class="pagination">
                      </ul>
                    </div>
                  </td>
                </tr>
              </tfoot>
              <?php endif; ?>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>