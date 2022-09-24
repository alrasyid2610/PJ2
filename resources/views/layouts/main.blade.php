<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{ asset('adminTemplate') }}/production/images/favicon.ico" type="image/ico" />

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="{{ asset('adminTemplate') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('adminTemplate') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('adminTemplate') }}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('adminTemplate') }}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('adminTemplate') }}/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('adminTemplate') }}/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('adminTemplate') }}/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    {{-- Datatable --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <!-- Custom Theme Style -->
    <link href="{{ asset('adminTemplate') }}/build/css/custom.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('layouts.sidebar')
        @include('layouts.top_nav')

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('main')
        </div>
        <!-- /page content -->

        @include('layouts.footer')
      </div>
    </div>

     @vite('resources/js/app.js')

    <!-- jQuery -->
    <script src="{{ asset('adminTemplate') }}/vendors/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js" defer></script>
    <script src="public\adminTemplate\vendors\datatables.net\js\jquery.dataTables.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('adminTemplate') }}/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('adminTemplate') }}/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ asset('adminTemplate') }}/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="{{ asset('adminTemplate') }}/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="{{ asset('adminTemplate') }}/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('adminTemplate') }}/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="{{ asset('adminTemplate') }}/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="{{ asset('adminTemplate') }}/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="{{ asset('adminTemplate') }}/vendors/Flot/jquery.flot.js"></script>
    <script src="{{ asset('adminTemplate') }}/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="{{ asset('adminTemplate') }}/vendors/Flot/jquery.flot.time.js"></script>
    <script src="{{ asset('adminTemplate') }}/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="{{ asset('adminTemplate') }}/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('adminTemplate') }}/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="{{ asset('adminTemplate') }}/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="{{ asset('adminTemplate') }}/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="{{ asset('adminTemplate') }}/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('adminTemplate') }}/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="{{ asset('adminTemplate') }}/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="{{ asset('adminTemplate') }}/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('adminTemplate') }}/vendors/moment/min/moment.min.js"></script>
    <script src="{{ asset('adminTemplate') }}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    {{-- Datatable --}}


    <!-- Custom Theme Scripts -->
    <script src="{{ asset('adminTemplate') }}/build/js/custom.min.js"></script>

  </body>
</html>
