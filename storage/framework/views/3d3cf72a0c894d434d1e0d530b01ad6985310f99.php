<?php
$url = request()->path();
$porciones = explode("/", $url );
$ruta = $porciones[0];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="base_url" content="<?php echo e(url('/')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/images/logo_login.png')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>
        <?php $__env->startSection('title'); ?>
        | Mineria Coin
        <?php echo $__env->yieldSection(); ?>
    </title>
    <link href="<?php echo e(asset('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets_client/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets_client/css/colors/purple.css')); ?>" id="theme" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/highcharts/css/highcharts.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets_client/css/colors/coin.css')); ?>" id="theme" rel="stylesheet">
    <link href="<?php echo e(asset('assets_client/css/coin_style.css')); ?>" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
</head>


<body class="fix-header fix-sidebar card-no-border logo-center">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <?php if( $ruta != 'changePassword'): ?>

            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                        
                    <div class="">
                        <a class="navbar-brand" href="<?php echo e(url('/user')); ?>">
                            <b>
                                <img src="<?php echo e(asset('assets/images/logo_inicio_tope.png')); ?>" width="150px" alt="Pagina de Inicio" class="light-logo" />
                            </b>
                        </a>
                    </div>
                    <div class="navbar-collapse">
                        <ul class="navbar-nav mr-auto mt-md-0">
                            <div id="_pagos" class="m-r-20">
                                <h6 class="m-t-10 font-14">Ganancia mes actual</h6>
                                <li class="nav-item hidden-sm-down">
                                   <span id="ganado" precio="" class="m-r-20  text-info font-bold font-14"></span>
                                </li>
                            </div>
                            <div id="_cobros" class="">
                                <h6 class="m-t-10 font-14">Deducción mes actual</h6>
                                <li class="nav-item">
                                    <span id="_apagar" precio="" class="m-r-20 text-danger font-bold font-14"></span>
                                </li>
                            </div>
                           
                                
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                            <li class="nav-item dropdown">
                            </li>
                        </ul>
                        <ul class="navbar-nav my-lg-0">
                            <li class="nav-item hidden-sm-down">
                                <span id="_btc_price" class="p-t-10 m-r-20 nav-link  font-bold font-14"></span>
                            </li>
                            
                            <li style="padding-top:8px">
                                <h5  style="border-bottom:1px solid; padding-bottom:3px; font-size:12px;" id="_usuario"><?php echo e(Auth::user()->username); ?>

                                </h5>
                                <h6 class="text-right">
                                    <a href="javascript:void(0)" id="_cerrar_session">
                                           <sup> Cerrar Sesión</sup>
                                             <form id="logout-form" action="" method="POST" style="display: none;">
                                                <?php echo e(csrf_field()); ?>

                                            </form>
                                           
                                    </a>
                                </h6> 
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?php echo e(asset('assets/images/users/usuario_tope.png')); ?>" alt="user" class="" height="30" width="30" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right scale-up">
                                    <ul class="dropdown-user font-14">
                                       
                                        <li><a href="changePassword"><i class="ti-settings"></i> Cambiar Clave</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="javascript:void(0)" id="_btn_cerrar_session">
                                             <form id="logout-form" action="" method="POST" style="display: none;">
                                                <?php echo e(csrf_field()); ?>

                                            </form>

                                            <i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>

                    </div>

                </nav>     
            </header>
         <?php endif; ?>
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <?php if( $ruta != 'changePassword' ): ?>
                            <li>
                                <a class="has-arrow waves-effect waves-dark" href="<?php echo e(url('/user')); ?>" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Inicio</span></a>
                            </li>
                            <li>
                                <a class="has-arrow waves-effect waves-dark" href="<?php echo e(url('mineria')); ?>" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Minadores</span></a>
                            </li>
                            <li>
                                <a class="has-arrow waves-effect waves-dark" href="<?php echo e(url('ganancias')); ?>" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Ganancias</span></a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
       
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <?php if( $ruta != 'changePassword' ): ?>
                    <div class="col-md-5 align-self-center">
                        <h3 id="_url_pagina" class="text-default font-bold">Escritorio</h3>
                    </div>
                    <div class="col-md-7 align-self-center" >
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                             <a href="javascript:void(0)" class="text-warning font-bold">Inicio</a></li>
                            <li class="breadcrumb-item active font-bold" id="_titulo">Escritorio</li>
                        </ol>
                    </div>
                <?php endif; ?>
                <!--<div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>-->

               
           
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <?php echo $__env->make('layouts.alerts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="container-fluid">
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <div class="container-fluid text-center">
                <b>
                    <img src="<?php echo e(asset('assets/images/logo_inicio_footer.png')); ?>"  alt="Pagina de Inicio" class="light-logo" />
                </b>
            </div>
            
            <footer class="footer text-white"> © 2018 Reservados todos los derechos a www.coincoin.com.ve </footer>
        </div>

    </div>
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_client/js/jquery.slimscroll.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/waves.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_client/js/sidebarmenu.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_client/js/custom.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/raphael/raphael-min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/highcharts/js/highcharts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/highcharts/js/modules/series-label.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/styleswitcher/jQuery.style.switcher.js')); ?>" ></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>
    <script src="<?php echo e(asset('assets/js/general.js')); ?>" ></script>
    <script>
    const url = $("meta[name=base_url]").attr('content');
    _percio_dolar = 0;

    function pagado(){
        $.ajax({
            url: url+'/gananciasUltimoMes',
            type: 'get',
            dataType: "json",
            //data:{},
            success: function(data) {
                //console.log(data)
                var _pre; 
                if(data.datos != 0){
                    var total_minado = ((data.datos.earnings*0.00000001));  
                    var porcentaje = data.datos.porcentaje;
                    var deduccion = data.datos.deduccion;
                }else{
                    var total_minado = ((0*0.00000001));  
                    var porcentaje = 0;
                    var deduccion = 0;
                }

                $.ajax({
                    url: 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD,EUR&e=Coinbase&extraParams=your_app_name',
                    type: 'get',
                    dataType: "json",
                    //data:{},
                    success: function(data) {
                        //C
                        $("#_btc_price").html('1 BTC = '+data.USD+' USD'); 
                        _pre = data.USD;
                        var num = (total_minado*_pre);
                        var n = num.toFixed(2);
                        $("#ganado").html(number_format((total_minado), 8, '.', '')+' BTC = '+n+' $'); //ganado en el mes
                        if(porcentaje>0){
                            var dolar = (total_minado*_pre);
                            var resto = dolar - (dolar * porcentaje)/100;
                            var pagar = dolar - resto;
                            var bitcoin = pagar / _pre
                            var nu = pagar.toFixed(2);
                            $("#_apagar").html(number_format((bitcoin), 8, '.', '')+' BTC = '+nu+' $'); // a pagar 
                        }else if(deduccion > 0){
                            var dolar = (total_minado*_pre);
                            var bitcoin = deduccion / _pre
                            var nu = deduccion.toFixed(2);
                           
                            $("#_apagar").html(number_format((bitcoin), 8, '.', '')+' BTC = '+nu+' $'); // a pagar  
                        }
                        
                    }
                });
              
                //$("#ganado").html(number_format((total_minado*0.00000001), 8, '.', '')+' BTC = '); //estimado hoy 

            }
        });
    }

    //Para la nueva logica de multipool
    function pagado_nueva(){
        $.ajax({
            url: url+'/gananciasUltimoMes1',
            type: 'get',
            dataType: "json",
            //data:{},
            success: function(data) {
                //Precio del bitcoin o de la moneda a minar o de ambos
                if(parseInt(data.datos.coin_precio) > 0){
                    $("#_btc_price").html('1 '+data.datos.current_coin+' = '+data.datos.coin_precio+' $ / '+' 1 BTC = '+data.datos.btc_precio+' $');
                }else{
                    $("#_btc_price").html('1 BTC = '+data.datos.btc_precio+' $');
                }

                if(parseInt(data.datos.earnings) != 0){
                    $("#ganado").html(data.datos.earnings+' '+data.datos.current_coin+' = '+data.datos.earnings_dolar+' $'); //ganado en el mes
                    $("#_apagar").html(data.datos.pagar_coin+' '+data.datos.current_coin+' = '+data.datos.pagar_dolar+' $'); // a pagar 
                }else{
                    $($)
                    $("#ganado").html(data.datos.earnings+' '+data.datos.current_coin+' = '+data.datos.earnings_dolar+' $'); //ganado en el mes
                    $("#_apagar").html(data.datos.pagar_coin+' '+data.datos.current_coin+' = '+data.datos.pagar_dolar+' $'); // a pagar 
                }
            }
        });
    }

     function llenarDiario(){
        $.ajax({
            async: false,
            url: url+'/historialGanancias1',
            type: 'get',
            dataType: "json",
            //data:{},
            success: function(data) {
            }
        }); 
    }

    llenarDiario();
    //pagado();
    //precio_bitcoin();

    $(document).ready(function () {             
        pagado_nueva();
    });
     
    function load(){
        //mineros();
        //precio_bitcoin();
        //pagado();
        pagado_nueva()
    }
    setInterval(load, 100000/*300000*/); 

    $("#_btn_cerrar_session, #_cerrar_session" ).on( "click", function(event) {
            event.preventDefault();
            $.ajax({
                   headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/logout',
                    type: 'post',
                    data: $('#logout-form').serialize(),
                    cache: false,
                    processData: false,
                    timeout: 8000,
                    dataType: 'json',
                    success: function(data) {
                        if(data.datos == 1){
                            toastr.success("Sesión cerrada correctamente");
                            setTimeout(function(){ location.href = url+'/'; }, 1000);
                        }else{
                            toastr.error("Falló al cerrar sesión");
                            setTimeout(function(){ location.href = url+'/'; }, 1000);
                        }
                    }
            });
                      
    });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
