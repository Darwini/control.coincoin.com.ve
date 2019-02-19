<!-- MODAL USER POOL -->
    <div class="modal fade" id="usuario_pool<?php echo e($user->id); ?>" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content w3-small" style="border:solid 1px orange;">
                <div class="modal-header" style="border-bottom: solid 1px orange;">
                    <i class="w3-large mdi mdi-account-network w3-text-orange"></i>
                    <h6 class="modal-title">Actualizar Datos</h6>
                    <button type="button" class="close w3-small w3-hover-text-red" data-dismiss="modal">&times;</button>
                </div>
                                        
                <form method="post" action="<?php echo e(route('editar.user.pool')); ?>" class="w3-small">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                    <div class="modal-body w3-small">
                        <div class="form-group col-md-5 pull-left">
                            <label for="username" class="control-label">Nombre de Usuario:</label>    
                            <div class="input-group">
                                <input required="required" class="form-control form-control-sm" placeholder="Username" type="text" name="username" value="<?php echo e($user->username); ?>">
                                <div class="input-group-addon w3-text-orange">
                                    <i class="ti-user"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-5 pull-right">
                            <label for="pass" class="control-label">Contraseña:</label>
                            <div class="input-group">
                                <input required="required" id="pass<?php echo e($user->id); ?>" type="password" class="form-control form-control-sm" name="password" placeholder="Password" value="123456" disabled="disabled">
                                <div class="input-group-addon w3-text-orange" title="Cambiar Clave">
                                    <i class="ti-lock" onclick="cambio_clave('<?php echo e($user->id); ?>');"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-5 pull-left">
                            <label for="email" class="control-label">Correo Electrónico:</label>
                            <div class="input-group">
                                <input required="required" class="form-control form-control-sm" placeholder="Email" type="email" name="email" value="<?php echo e($user->email); ?>" style="text-transform: lowercase;">
                                <div class="input-group-addon w3-text-orange">
                                    <i class="ti-email"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-5 pull-right" style="visibility: hidden;overflow: hidden;">
                            <label class="control-label">Nombre del Cliente:</label>
                            <div class="input-group">
                                
                                <div class="input-group-addon w3-text-orange">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-5 pull-right">
                            <label class="control-label">POOL :</label>
                            <div class="input-group">
                                <select name="pool" required="required" id="pool<?php echo e($user->id); ?>" style="width: 100%;">
                                    <option value="" selected="selected" disabled="disabled">Elije el Pool</option>
                                    <option class="pbtc" value="BTC">BTC</option>
                                    <option class="pbch" value="BCH">BCH</option>
                                    <option class="pluxor" value="LUXOR">LUXOR</option>
                                    <option class="psia" value="DCR">SIA</option>
                                </select>
                                
                                
                                <div class="input-group-addon w3-text-orange">
                                    <i class="mdi mdi-currency-btc"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-5 pull-left">
                            <label class="control-label">Servidor :</label>
                            <div class="input-group">
                                <select name="url_pool" required="required" id="servidor<?php echo e($user->id); ?>" style="width: 100%;">
                                    <option value="" selected="selected" disabled="disabled">Servidor</option>
                                    <option class="susa" value="USA">Usa</option>
                                    <option class="seu" value="EU">Europa</option>
                                    <option class="sch" value="CH">China</option>
                                </select>
                                <div class="input-group-addon w3-text-orange">
                                    <i class="mdi mdi-web"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-5 pull-right">
                            <label class="control-label">Método de Cobranza</label>
                            <div class="">
                                <?php if($user->porcentaje > 0): ?>
                                    Porcentaje :
                                        <input type="radio" name="cobranza" value="
                                        porcentaje" checked="checked">
                                    &nbsp; &nbsp;
                                    Deducción :
                                        <input type="radio" name="cobranza" value="deduccion">
                                <?php elseif($user->deduccion > 0): ?>
                                    Porcentaje :
                                        <input type="radio" name="cobranza" value="
                                        porcentaje">
                                    &nbsp; &nbsp;
                                    Deducción :
                                        <input type="radio" name="cobranza" value="deduccion" checked="checked">
                                <?php else: ?>
                                    Porcentaje :
                                        <input type="radio" name="cobranza" value="
                                        porcentaje" checked="checked">
                                    &nbsp; &nbsp;
                                    Deducción :
                                        <input type="radio" name="cobranza" value="deduccion">
                                <?php endif; ?>

                                <br>
                                <div class="input-group">
                                <?php if($user->porcentaje !=0 || $user->deduccion!=0): ?>
                                    <input required="required" class="form-control form-control-sm" placeholder="%" type="number" min="0" name="dcantidad" value="<?php echo e(isset($user->porcentaje) ? $user->porcentaje : $user->deduccion); ?>">
                                <?php else: ?>
                                    <input required="required" class="form-control form-control-sm" placeholder="%" type="number" min="0" name="dcantidad" value="">
                                <?php endif; ?>
                                    <div class="input-group-addon w3-text-orange">
                                        <i class="mdi mdi-currency-btc"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-5 pull-left">
                            <label class="control-label">Dirección PUID : </label>    
                            <div class="input-group">
                                <input required="required" class="form-control-sm form-control" placeholder="PUID O ADDRESS" type="text" min="0" name="puid" value="<?php echo e($user->puid); ?>">
                                <div class="input-group-addon w3-text-orange">
                                    <i class="ti ti-key"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="border-top: 1px solid orange;">
                        <button class="btn btn-info" type="submit">Aceptar</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- FIN USER POOL -->

<script type="text/javascript">
    function cargarpool(id, pool){
        $('#pool'+id+" .p"+pool).prop('selected', true);
    }
    cargarpool('<?php echo e($user->id); ?>','<?php echo e(strtolower($user->pool)); ?>');

    function cargarservidor(id, pais){
        $('#servidor'+id+' .s'+pais).prop('selected', true);
    }
    cargarservidor('<?php echo e($user->id); ?>','<?php echo e(strtolower($user->url_pool)); ?>');

    function cambio_clave(id){
        $("#pass"+id).removeAttr('disabled');
    }
    
</script>