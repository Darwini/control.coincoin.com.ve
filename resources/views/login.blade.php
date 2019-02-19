<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Bienvenido a la plataforma Nomina Coincoin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets_client/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('assets_client/css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{asset('assets/images/background/fondo_login.png') }});">
            <div class="login-box card" style="max-width:25%; padding-bottom:0px;">

                <div class="card-body">
          
                        <div class=" form-group text-center">
                            <img class="text-center light-logo" src="{{asset('assets/images/logo_login.png')}}">
                        </div>
                  
                    <h4 class="box-title  text-center font-14" >INICIO DE SESIÓN</h4>
                    <form class="form-horizontal" id="loginform" action="{{ route('login') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="m-b-10 ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="email" placeholder="Usuario"> 
                            </div>
                        </div>
                        <div>
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="password" placeholder="Contraseña">
                            </div>
                            <div>
                                <a href="{{route ('reset')}}" class="m-t-10 m-b-10 text-dark pull-right font-12"><i class="fa fa-lock m-r-5"></i>  Recuperar clave?</a> 
                            </div>
                        </div>

                        <div class=" text-center">
                            <div class="col-xs-12">
                                <button class="btn btn-login  btn-block text-uppercase waves-effect waves-light text-white" type="submit" style="background-color: #d5521c">Ingresar</button>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-center font-14 p-t-10">Tasa de Hash </h4>
                        </div>
                        <div  style="background-color: #e9e9e9;border-radius: 3px; padding-left:5px">

                            <div class="row  text-center">
                                <div class="col-md-7 align-self-center">
                                    <h2  id="_pool_red" class="text-inverse text-center  font-bold p-t-10">5.89
                                    <span class="font-14 font-light">GH/s</span></h2>
                             
                                </div>
                                <div class="col-md-5 text-left" style ="border-left:solid 1px; border-color:#d5521c">
                                    <div>
                                        <span class="font-12">Total </span>
                                    </div>
                                    <div>
                                        <span class="font-12">del POOL </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </form>

                </div>

            </div>
            <hr class="hr login-box m-t-20">
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('assets_client/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('assets_client/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('assets_client/js/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/login.js') }}"></script>
</body>

</html>