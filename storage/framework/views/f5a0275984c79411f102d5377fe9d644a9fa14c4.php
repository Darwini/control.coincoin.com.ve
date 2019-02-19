<!-- MODAL USER POOL -->
    <div class="modal fade" id="modal_usuario_pool" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content w3-small" style="border:solid 1px orange;">
                <div class="modal-header" style="border-bottom: solid 1px orange;">
                    <i class="w3-large mdi mdi-account-network w3-text-orange"></i>
                    <h5 class="modal-title">Crear Usuario</h5>
                    <button type="button" class="close w3-small w3-hover-text-red" data-dismiss="modal">&times;</button>
                </div>
                                        
                <form method="post" action="<?php echo e(route('usuario.cliente')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body w3-small">
                        <center class="w3-text-blue">La contraseña por defecto será : 123456</center>
                        <div class="form-group">
                            <label for="username" class="control-label">Nombre de Usuario:</label>
                            <div class="input-group">
                                <input required="required" class="form-control form-control-sm" placeholder="Username" type="text" name="username" oninput="nombreusuario(this.value)">
                                <div class="input-group-addon w3-text-orange">
                                    <i class="ti-user"></i>
                                </div>
                            </div>
                            <br><div id="clu" style="display: none;" class="w3-text-red"><i class="mdi mdi-block-helper"></i> Error! Ese Usuario Ya Existe <i class="mdi mdi-block-helper"></i></div>
                        </div>


                        <div class="form-group w3-hide" style="overflow: hidden;">
                            <label for="pass3" class="control-label">Contraseña:</label>
                            <div class="input-group">
                                <input required="required" type="password" class="form-control form-control-sm" name="password" placeholder="Password" value="123456">
                                <div class="input-group-addon w3-text-orange">
                                    <i class="ti-lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="control-label">Correo Electrónico:</label>
                            <div class="input-group">
                                <input required="required" class="form-control form-control-sm" placeholder="Email" type="email" name="email">
                                <div class="input-group-addon w3-text-orange">
                                    <i class="ti-email"></i>
                                </div>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label for="puid" class="control-label">POOL :</label>
                            <div class="input-group">
                                <select name="pool" required="required" class="form-control" style="width: 100%;">
                                    <option value="" selected="selected" disabled="disabled">Elije un Pool</option>
                                    <option value="BTC">BTC</option>
                                    <option value="BCH">BCH</option>
                                    <option value="DCR">SIA</option>
                                    <option value="LUXOR">LUXOR</option>
                                </select>
                                
                                <div class="input-group-addon w3-text-orange">
                                    <i class="mdi mdi-currency-btc"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="puid" class="control-label">Servidor :</label>
                            <div class="input-group">
                                <select name="url_pool" required="required" class="form-control" style="width: 100%;">
                                    <option value="" selected="selected" disabled="disabled">Elije un Pais</option>
                                    <option value="USA">Usa</option>
                                    <option value="EU">Europa</option>
                                    <option value="CH">China</option>
                                </select>
                                <div class="input-group-addon w3-text-orange">
                                    <i class="mdi mdi-web"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="puid" class="control-label">Dirección PUID :</label>            
                            <div class="input-group">
                                <input required="required" class="form-control form-control-sm" placeholder="PUID O ADDRESS" type="text" min="0" name="puid">
                                <div class="input-group-addon w3-text-orange">
                                    <i class="ti ti-key"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="puid" class="control-label">Método de Cobranza : </label> &nbsp; &nbsp;
                            Porcentaje :
                            <input type="radio" name="cobranza" value="porcentaje" checked="checked">
                            &nbsp; &nbsp;
                            Deducción :
                            <input type="radio" name="cobranza" value="deduccion">

                            <div class="input-group">
                                <input required="required" class="form-control form-control-sm" placeholder="Cantidad del Cobro %" type="number" min="1" name="dcantidad" value="1">
                                <div class="input-group-addon w3-text-orange">
                                    <i class="mdi mdi-currency-btc"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer w3-center" style="border-top: solid orange 1px;">
                        <button class="btn-sm btn-info" type="submit">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- FIN USER POOL -->
<span id="url" url="<?php echo e(url('')); ?>"></span>
<script type="text/javascript">
    function nombreusuario(nombre) {
        var url, ruta;
        url=$("#url").attr('url');
        ruta=url+'/buscarusuario/'+nombre;
        $("#clu").hide();
        
        $.get( ruta, function(usuario){
            //console.log(usuario);
            if (usuario==1)
            {
                $("#clu").show();
            }
        });
    }
</script>