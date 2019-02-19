<?php $__env->startSection('title', 'ControlCoin | Personal'); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(asset('assets/plugins/footable/js/footable.all.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/footable-init.js')); ?>"></script>
  <link  href="<?php echo e(asset('assets/plugins/footable/css/footable.core.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')); ?>">
  <script type="text/javascript">
    function comparar(){
      var pass=$("#pass").val();
      var repass=$("#repass").val();
      if( pass !== repass ){
        $(`.nocoinciden`).show();
        $(`#botonaceptar`).hide();
      }
      else{
        $(`.nocoinciden`).hide();
        $(`#botonaceptar`).show();  
      }
    }

    function newuser() {
      $(`#new`).modal({backdrop:`static`});
    }

    function editarpersonal(id) {
      $(`#edit${id}`).modal({backdrop:`static`});
    }
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrum'); ?>
  <div class="col-md-5 align-self-center">
    <h3 class="text-default font-bold">Personal</h3>
  </div>
                        
  <div class="col-md-7 align-self-center">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo e(url('/')); ?>" class="text-warning font-bold">Inicio</a>
      </li>
      <li class="breadcrumb-item font-bold active">Personal</li>
    </ol>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('personal.create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <section>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="w3-right">
              <span class="w3-right w3-border w3-text-blue w3-btn m-l-10 m-r-10" onclick="newuser()">
                <i class="fa fa-plus"></i> 
              </span>
              <a href="<?php echo e(route('personal.pdf')); ?>" target="_blank" class="w3-left m-l-10 m-r-10">
                <span class="w3-btn w3-border">
                  <i class="w3-small w3-text-red mdi mdi-file-pdf"></i>
                </span>
              </a>
            </div>
            <div class="w3-left">
              <input class="form-group form-group-sm" id="demo-input-search2" placeholder="Buscar" autocomplete="off" type="text">
            </div>

            <?php if(isset($personal)): ?>
            <div class="table-responsive">
              <table id="demo-foo-addrow2" class="w3-table w3-centered m-t-5 w3-hoverable color-bordered-table warning-bordered-table w3-small" data-page-size="10">
                <thead>
                  <tr>
                    <th <?php echo e($i=1); ?>> # </th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Depart.</th>
                    <th>Estatus</th>
                    <th>Opc.</th>
                  </tr>
                </thead>

                <tbody>
                  <?php $__currentLoopData = $personal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($i++); ?></td>
                      <td><?php echo e($persona->user->username); ?></td>
                      <td><?php echo e($persona->user->email); ?></td>
                      <td><?php echo e($persona->user->departamento->departamento); ?></td>
                      <td>
                        <?php if($persona->status == 1): ?>
                          <span class="label label-success">Activo</span>
                        <?php elseif($persona->status == 0): ?>
                          <span class="label label-danger">Desactivado</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <span class="w3-btn w3-small w3-round w3-blue" onclick="editarpersonal('<?php echo e($persona->id); ?>')">
                          <i class="fa fa-edit"></i>
                        </span>
                      </td>
                    </tr>
                    <?php echo $__env->make('personal.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <!-- Column -->
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>