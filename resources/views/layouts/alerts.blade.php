    @if(Session::has('message-danger') )
      <div class="container-fluid" >
        <div class="darwin-panel">
          <span style="float: right; padding-right: 16px;" class="w3-text-grey w3-hover-text-black" onclick="$(this).parent().remove()">&times;</span>
          <b>{{ Session::get('message-danger') }}</b>
        </div>
      </div>
      <style>
        .darwin-panel { 
          padding-top: 5px; opacity: 1; transition: opacity 0.6s;
          height: 60px; text-align: center; margin: 2.5px;
          background-color: #FFDDDD; font-size: 16px; border-left: 6px solid red;
        }
      </style>
      <script>
        function ocultar(){
          $(".darwin-panel").fadeIn(5000);
          $(".darwin-panel").fadeOut(5000);
        }
        ocultar();
      </script>
    @endif



    @if(Session::has('message-info'))
      <div class="container-fluid" >
        <div class="darwin-panel">
          <span style="float: right; padding-right: 10px;" class="w3-text-black w3-hover-text-red" onclick="$(this).parent().remove()">&times;</span>
          <span>{{ Session::get('message-info') }}  </span>
        </div>
      </div>

      <style>
        .darwin-panel { 
          padding-top: 5px; opacity: 1; transition: opacity 0.6s;
          height: 60px; text-align: center; margin: 2.5px;
          background-color: #DDFFFF; font-size: 16px; border-left: 6px solid blue;
        }
      </style>
      <script>
        function ocultar(){
          $(".darwin-panel").fadeIn(5000);
          $(".darwin-panel").fadeOut(5000)
        }
        ocultar();
      </script>
    @endif
  

    @if(Session::has('message-success'))
      <div class="container-fluid" >
        <div class="darwin-panel">
          <span style="float: right; padding-right: 16px;" class="w3-text-black w3-hover-text-red" onclick="$(this).parent().remove()">&times;</span>
          <span>{{ Session::get('message-success') }}  </span>
        </div>
      </div>
      <style>
        .darwin-panel { 
          padding-top: 5px; color: black; opacity: 1; transition: opacity 0.6s;
          height: 60px; text-align: center; margin: 2.0px;
          background-color: #DDFFDD; font-size: 16px; border-left: 6px solid green;
        }
      </style>
      <script>
        function ocultar(){
          $(".darwin-panel").fadeIn(5000);
          $(".darwin-panel").fadeOut(5000)
        }
        ocultar();
      </script>
    @endif


    @if(Session::has('message-warning'))
      <div class="container-fluid" >
        <div class="darwin-panel">
          <span style="float: right; padding-right: 16px;" class="w3-text-black w3-hover-text-red" onclick="$(this).parent().remove()">&times;</span>
          <span> <b> <strong>ATENCIÓN!</strong> </b>{{ Session::get('message-warning') }}</span>
        </div>
      </div>

      <style>
        .darwin-panel { 
          padding-top: 5px; opacity: 1; transition: opacity 0.6s;
          height: 60px; text-align: center; margin: 2.0px;
          background-color: #FFFFCC; font-size: 16px; border-left: 6px solid yellow;
        }
      </style>

      <script>
        function ocultar(){
          $(".darwin-panel").fadeIn(5000);
          $(".darwin-panel").fadeOut(5000)
        }
        ocultar();
      </script>
    @endif

