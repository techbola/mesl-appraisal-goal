<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>
      @if(View::hasSection('title'))
        OfficeMate - @yield('title')
      @else
          OfficeMate
      @endif
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" href="{{ asset('pages/ico/60.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('pages/ico/76.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('pages/ico/120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('pages/ico/152.png') }}">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="{{ asset('assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/boostrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('assets/plugins/bootstrap-select2/select2.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" type="text/css" media="screen" />

  {{-- <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}

     <link href="{{ asset('assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />
     <link href="{{ asset('pages/css/pages-icons.css') }}" rel="stylesheet" type="text/css">
     <link class="main-stylesheet" href="{{ asset('pages/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/black.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">

    @stack('styles')

  </head>
  <body>

    <!-- START HEADER -->
    <div class="header" style="background-color: #161c27">
      <!-- START MOBILE CONTROLS -->
      <div class="container-fluid relative">
        <!-- LEFT SIDE -->
        <div class="pull-left full-height visible-sm visible-xs">
          <!-- START ACTION BAR -->
          <div class="header-inner">
            <a href="#" class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5" data-toggle="sidebar">
              <span class="icon-set menu-hambuger"></span>
            </a>
          </div>
          <!-- END ACTION BAR -->
        </div>
        <div class="pull-center hidden-md hidden-lg">
          <div class="header-inner">
            <div class="brand inline">
              <img src="{{ asset('images/officemate.png') }}" alt="logo" data-src="{{ asset('images/officemate.png') }}" data-src-retina="{{ asset('images/officemate.png') }}" width="120">
            </div>
          </div>
        </div>
        <!-- RIGHT SIDE -->
        <div class="pull-right full-height visible-sm visible-xs">
          <!-- START ACTION BAR -->
          <div class="header-inner">
            <a href="#" class="btn-link visible-sm-inline-block visible-xs-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
              <span class="icon-set menu-hambuger-plus"></span>
            </a>
          </div>
          <!-- END ACTION BAR -->
        </div>
      </div>
      <!-- END MOBILE CONTROLS -->
      <div class=" pull-left sm-table hidden-xs hidden-sm">
        <div class="header-inner">
          <div class="brand inline">
            <img src="{{ asset('images/officemate.png') }}" alt="logo" data-src="{{ asset('images/officemate.png') }}" data-src-retina="{{ asset('images/officemate.png') }}" width="120">
          </div>
          <!-- START NOTIFICATION LIST -->

          <!-- END NOTIFICATIONS LIST --> </div>
      </div>
      <div class=" pull-right">

      </div>
    </div>
    <!-- END HEADER -->

    <div class="container-fluid m-t-35 m-b-50">
      @yield('content')
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/modernizr.custom.js') }}" ></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" ></script>
    <script src="{{ asset('assets/plugins/boostrapv3/js/bootstrap.min.js') }}" ></script>

    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}" ></script>

        {{-- <script src="{{ asset('assets/plugins/jquery/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" ></script>
        <script src="{{ asset('assets/plugins/modernizr.custom.js') }}" ></script>
        <script src="{{ asset('assets/plugins/boostrapv3/js/bootstrap.min.js') }}" ></script>
        <script src="{{ asset('assets/plugins/jquery/jquery-easy.js') }}" ></script>
        <script src="{{ asset('assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" ></script>
        <script src="{{ asset('assets/plugins/jquery-bez/jquery.bez.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-actual/jquery.actual.min.js') }}"></script> --}}
        <script src="{{ asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/plugins/switchery/js/switchery.min.js') }}" ></script> --}}
        {{-- <script src="{{ asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script> --}}


    <script src="{{ asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-select2/select2.min.js') }}"></script>

    <script src="{{ asset('pages/js/pages.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.js') }}" ></script>
    <script src="{{ asset('assets/js/scripts.js') }}" ></script>

    @stack('scripts')
    @include('notifications')
  </body>
</html>
