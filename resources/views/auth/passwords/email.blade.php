<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="base_url" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Bienvenido a la plataforma Coincoin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets_client/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('assets_client/css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
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
                  
                    <h4 class="box-title fz text-center font-16 p-b-10 p-t-10" >Recuperar Clave</h4>
                    <form class="form-horizontal" id="emailform" action="" method="POST">
                        {{ csrf_field() }}
                         <div class="form-group">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Correo electronico"> 

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        

                        <div class=" text-center">
                            <div class="col-xs-12">
                                <button id="_enviar" class="btn btn-login  btn-block text-uppercase waves-effect waves-light text-white" type="button" style="background-color: #d5521c">ENVIAR</button>
                            </div>
                        </div>
                        <div class=" text-center p-t-10">
                            <div class="col-xs-12">
                                <button id="_cancelar" class="btn btn-login  btn-block text-uppercase waves-effect waves-light text-white" type="button" style="background-color: #d5521c">CANCELAR</button>
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>
    <script src="{{ asset('assets/js/general.js') }}"></script>
    <script src="{{ asset('assets/js/login.js') }}"></script>
    <script>
        var _url   = $("meta[name=base_url]").attr('content');
        var _email = $("#email").val();
        var _token = $("input[name='_token']").val();

        $( "#_cancelar" ).on( "click", function(event) {
            window.location = _url + '/login'
        });

        $( "#_enviar" ).on( "click", function(event) {
            event.preventDefault();
            console.log("eee");
            $.ajax({
                   headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: _url+'/password/email',
                    type: 'post',
                    data: $('#emailform').serialize(),
                    cache: false,
                    processData: false,
                    timeout: 8000,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        if(data.datos  == 1){
                            toastr.success(data.msg);
                            setTimeout(function(){ location.href = _url+'/login'; }, 1500);
                        }else{
                            toastr.error(data.msg);
                            //setTimeout(function(){ location.href = _url+'/login'; }, 1500);
                        }
                 
                    }
            });
                      
        });

        $(document).ready(function() {
            $("form").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
        });
    </script>
</body>

</html>