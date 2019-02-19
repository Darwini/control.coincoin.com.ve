<?php $__env->startSection('title', 'CoinCoin | Usuarios Pool'); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/plugins/footable/js/footable.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/footable-init.js')); ?>"></script>
    <link href="<?php echo e(asset('assets/plugins/footable/css/footable.core.css')); ?>">

    <script type="text/javascript">
        function edit_user_pool(id){
            $("#usuario_pool"+id).modal({backdrop:'static'});
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrum'); ?>
    <div class="col-md-5 align-self-center">
        <h3 class="w3-text-black font-bold">Usuarios Pool</h3>
    </div>
                        
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('instalador')); ?>" class="text-warning font-bold">Inicio</a>
            </li>
            <li class="breadcrumb-item font-bold w3-text-black active">Usuarios Pool</li>
        </ol>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('installers.usuarios.usuario_pool', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="w3-container">
        <div class="col-lg-12 col-md-12">
            <div class="card w3-border w3-round-xxlarge">
                <div class="card-body">
                    <input autocomplete="off" type="hidden" id="asset" value="<?php echo e(asset('/')); ?>">
                    <input autocomplete="off" type="hidden" id="url" value="<?php echo e(url('/')); ?>">

                    <div class="w3-left">
                        <div class="form-group">
                            <input autocomplete="off" id="demo-input-search2" placeholder="Buscar" autocomplete="off" type="text">
                        </div>
                    </div>

                    <div class="btn-group w3-right">
                        <form action="<?php echo e(route('usuarios.pool.pdf')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="tipo" value="todos">
                            <button class="w3-btn w3-round m-r-20 w3-border">
                                <span class="w3-large w3-text-red mdi mdi-file-pdf"></span>
                            </button>
                        </form>

                        <button class="w3-border w3-text-blue w3-button w3-large w3-round" style="margin: 0px 25px 0px 25px;" type="submit" onclick="usuario_pool();"><i class="fa fa-plus"></i>&nbsp;<i class="ti ti-user w3-large"></i> </button>
                    </div>

                    <?php if(isset($users) && count($users) > 0 ): ?>
                    <table id="demo-foo-addrow2" class="w3-hoverable w3-table w3-centered color-bordered-table warning-bordered-table" data-page-size="20">
                        <thead>
                            <tr>
                                <th <?php echo e($i=1); ?> >#</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Pool</th>
                                <th>Servidor</th>
                                <th>Permiso de Conexión</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e($user->username); ?></td>
                                <td style="text-transform: lowercase;"><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->pool); ?></td>
                                <td><?php echo e($user->url_pool); ?></td>
                                <td><?php echo e($user->puid); ?></td>
                                <td>
                                    <span class="btn w3-circle w3-border w3-text-blue" onclick="edit_user_pool('<?php echo e($user->id); ?>')">
                                        <i class="mdi mdi-lead-pencil"></i>
                                    </span>
                                </td>
                            </tr>
                            <?php echo $__env->make('installers.usuarios.editar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        
                        <?php if(isset($users) && count($users) > 10 ): ?>
                        <tfoot style="border-top: 1px solid orange; border-top: 1px solid orange;">
                            <tr>
                                <td colspan="6">
                                    <div class="w3-right" style="margin-top: 8px;">
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
                        <?php endif; ?>
                    </table>
                            
                    <script>
                        function usuario_pool(){
                            $("#modal_usuario_pool").modal({backdrop:'static'});
                        }
                    </script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>