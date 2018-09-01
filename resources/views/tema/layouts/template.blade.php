<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{$profil->nama}} - @yield('judul')</title>
        <meta name="description" content="@yield('deskripsi')">
        <meta name="author" content="@ayo_ngoding">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('upload/profil/kecil/'.$profil->gambar)}}">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{{ asset('admins/clipone/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css') }}">

        <link rel="stylesheet" href="{{asset('tema/css/fontello.css')}}">
        <link rel="stylesheet" href="{{asset('tema/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('tema/js/owlcarousel/owl.carousel.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('tema/css/oldie.css')}}">
        <link rel="stylesheet" href="{{asset('tema/css/style.css')}}"> 

        <link rel="stylesheet" href="{{asset('tema/js/fancybox/source/jquery.fancybox.css')}}">
        <link rel="stylesheet" href="{{asset('tema/js/fancybox/source/helpers/jquery.fancybox-thumbs.css')}}">
       

        <!-- status pembayaran modal -->
        <!-- clipone -->
        
        <link href="{{ asset('admins/clipone/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('admins/clipone/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>

        
        
    </head>
    <body>
        <div class="wide_layout">   

        @include('tema/layouts/header')
        
        @yield('main')

        @include('tema/layouts/footer')

        </div>
        <script src="{{asset('admins/adminlte/bootstrap/dist/js/bootstrap.min.js')}}"></script>

        <script src="{{ asset('admins/clipone/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js') }}"></script>
        <script src="{{ asset('admins/clipone/plugins/bootstrap-modal/js/bootstrap-modal.js') }}"></script>
        <script src="{{ asset('admins/clipone/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"></script>
        <script src="{{ asset('admins/clipone/js/ui-modals.js') }}"></script> 
        
        <script src="{{asset('tema/js/modernizr.js')}}"></script>
        <script src="{{asset('tema/js/jquery-2.1.1.min.js')}}"></script>
        <script src="{{asset('tema/js/jquery.tweet.min.js')}}"></script>
        <script src="{{asset('tema/js/jquery.flexslider-min.js')}}" ></script>
        <script src="{{asset('tema/js/queryloader2.min.js')}}"></script>
        <script src="{{asset('tema/js/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
        <script src="{{asset('tema/js/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
        <script src="{{asset('tema/js/owlcarousel/owl.carousel.min.js')}}"></script>

        <!--Tambahan JS-->
        <script src="{{asset('tema/js/jquery.elevateZoom-3.0.8.min.js')}}"></script>
        <script src="{{asset('tema/js/fancybox/source/jquery.fancybox.pack.js')}}"></script>
        <script src="{{asset('tema/js/fancybox/source/helpers/jquery.fancybox-media.js')}}"></script>
        <script src="{{asset('tema/js/fancybox/source/helpers/jquery.fancybox-thumbs.js')}}"></script>

        
        <!-- <script src="{{asset('tema/js/jquery.appear.js')}}"></script>
        <script src="{{asset('tema/js/jquery.countdown.plugin.min.js')}}"></script>
        <script src="{{asset('tema/js/jquery.countdown.min.js')}}"></script>
        <script src="{{asset('tema/js/arcticmodal/jquery.arcticmodal.js')}}"></script>
        <script src="{{asset('tema/js/colorpicker/colorpicker.js')}}"></script>
        <script src="{{asset('tema/js/retina.min.js')}}"></script> -->

        <script src="{{asset('tema/js/theme.plugins.js')}}"></script>
        <script src="{{asset('tema/js/theme.core.js')}}"></script>     
        <script type="text/javascript" charset="utf-8">
          $(window).load(function() {
            $('.flexslider').flexslider();
          });
        </script>
        <script>
            jQuery(document).ready(function() {
              UIModals.init();
            });
        </script>
    </body>
</html>