<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AfichaStore - @yield('judul')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admins/adminlte/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admins/adminlte/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admins/adminlte/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admins/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. -->
    <link rel="stylesheet" href="{{asset('admins/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" href="{{asset('admins/adminlte/iCheck/all.css')}}">

    <!-- clipone -->
    <link rel="stylesheet" href="{{ asset('admins/clipone/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css') }}">

    <!-- modal hapus -->
    <script src="{{ asset('admins/alert/sweetalert.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('admins/alert/sweetalert.css')}}">

    <!-- Morris chart -->
    <!-- <link rel="stylesheet" href="adminlte/morris.js/morris.css"> -->
    <!-- jvectormap -->
    <!-- <link rel="stylesheet" href="adminlte/jvectormap/jquery-jvectormap.css"> -->
    <!-- Date Picker -->
    <!-- <link rel="stylesheet" href="adminlte/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="adminlte/bootstrap-daterangepicker/daterangepicker.css"> -->
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      @include('layouts/header')
      
        @include('layouts/menu')
        <div class="content-wrapper">
          <section class="content-header">
            <h1>@yield('judul')</h1>
            <ol class="breadcrumb">
              @yield('bread')
            </ol>
          </section>
      
          @yield('main')

        </div>
      
      @include('layouts/footer')

      <div class="control-sidebar-bg"></div>
    </div>


    <!-- jQuery 3 -->
    <script src="{{asset('admins/adminlte/jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('admins/adminlte/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>$.widget.bridge('uibutton', $.ui.button);</script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('admins/adminlte/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!--  -->
    <script src="{{ asset('admins/clipone/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js') }}"></script>
    <!-- <script src="{{ asset('admins/clipone/plugins/bootstrap-modal/js/bootstrap-modal.js') }}"></script> -->
    <!-- <script src="{{ asset('admins/clipone/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"></script> -->
    <!-- <script src="{{ asset('admins/clipone/js/ui-modals.js') }}"></script>  -->

    <!-- AdminLTE App -->
    <script src="{{asset('admins/js/adminlte.min.js')}}"></script>
    <!-- input radio button -->
    <script src="{{asset('admins/adminlte/iCheck/icheck.min.js')}}"></script>

    <script src="{{asset('admins/js/pages/dashboard.js')}}"></script>
    <script src="{{asset('admins/adminlte/ckeditor/ckeditor.js')}}"></script>
    <script>
        function konfirmasi() {
          if(confirm("Apakah anda ingin menghapus data ini ?"))
            return true;
          else
            return false;
        }
        
        $(function () {

        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        })
        
        CKEDITOR.replace('teks')
            $('.textarea').wysihtml5()
        })
    </script>
  </body>
</html>