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

    {{-- <link href="{{ asset('css/uikit.css') }}" rel="stylesheet" type="text/css" /> --}}
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
     {{-- Animate --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/animate/animate.min.css') }}">
    <link href="{{ asset('assets/plugins/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />

    {{-- Custom --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/white.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    {{-- <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet"> --}}


    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    @stack('styles')



    <!--[if lte IE 9]>
    <link href="assets/plugins/codrops-dialogFx/dialog.ie.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <![endif]-->
  </head>
  <body class="fixed-header menu-pin">
    @if (auth()->check())
      <?php $user = auth()->user(); ?>
    @endif
  {{-- begin vue init  --}}
  <div id="app" >
    <!-- BEGIN SIDEBPANEL-->
    <nav class="page-sidebar" data-pages="sidebar">
      <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->

      <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
      <!-- BEGIN SIDEBAR MENU HEADER-->
      <div class="sidebar-header">
        <a href="{{ route('home') }}"><img src="{{ asset('images/officemate.png') }}" alt="logo" class="brand" data-src="{{ asset('images/officemate.png') }}" data-src-retina="{{ asset('images/officemate.png') }}" width="120"></a>
        {{-- <h4 class="white semi-bold font-montserrat" style="
    color: #fff; display: inline-block;
"> TIMS. </h4> --}}
        {{-- <div class="sidebar-header-controls">
          <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i>
          </button>
          <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
          </button>
        </div> --}}
      </div>
      <!-- END SIDEBAR MENU HEADER-->
      <!-- START SIDEBAR MENU -->
      <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items" style="margin-top: 30px">

          {{-- DASHBOARD ONLY --}}
          @foreach($parent_menus as $menu)
            <?php if($menu->name != 'Dashboard') continue; ?>
           <li  {{-- @if($parent_menus->first() == $menu) class="m-t-30" @endif --}} >
            <a href="{{ $menu->route != '#' ? route($menu->route) : "#" }}" class="">
              <span class="title">{{$menu->name }}</span>
              @if($menu->children()->count() > 0 )
              <span class="arrow"></span>
              @endif
            </a>
            <span class="icon-thumbnail">{{ substr($menu->name, 0, 2) }}</span>
            {{$menu->hasSubmenu($menu->id ) }}
          </li>
          @endforeach

          {{-- OTHERS EXCEPT DASHBOARD --}}
          @foreach($parent_menus as $menu)
            <?php if($menu->name == 'Dashboard') continue; ?>
           <li>
            <a href="{{ $menu->route != '#' ? route($menu->route) : "#" }}" class="">
              <span class="title" data-toggle="tooltip" data-placement="right" title="{{ $menu->name }}">{{$menu->name }}</span>
              @if($menu->children()->count() > 0 )
              <span class="arrow"></span>
              @endif
            </a>
            <span class="icon-thumbnail">{{ substr($menu->name, 0, 2) }}</span>
            {{$menu->hasSubmenu($menu->id ) }}
          </li>
          @endforeach
        </ul>

        {{-- <ul class="menu-items" style="margin-top: 30px">
          @foreach ($menus as $menu)
            <li>
              @if ($user->roles()-> || $user->is_superadmin)

              @endif
            </li>
          @endforeach
        </ul> --}}

        <div class="clearfix"></div>
      </div>
      <!-- END SIDEBAR MENU -->
    </nav>
    <!-- END SIDEBAR -->
    <!-- END SIDEBPANEL-->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
      <!-- START HEADER -->
      <div class="header ">
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
                <img src="{{ asset('images/officemate.png') }}" alt="logo" data-src="{{ asset('images/officemate.png') }}" data-src-retina="{{ asset('images/officemate.png') }}" width="100">
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
              <img src="{{ asset('images/officemate.png') }}" alt="logo" data-src="{{ asset('images/officemate.png') }}" data-src-retina="{{ asset('images/officemate.png') }}" width="100">
            </div>
            <!-- START NOTIFICATION LIST -->
            <!-- END NOTIFICATIONS LIST -->
            @if (Auth::user()->staff)
              <span class="m-l-20 f16 bold">
                {{ Auth::user()->staff->company->Company }}
              </span>
            @endif
          </div>
        </div>


        <div class="pull-right">
          <!-- START User Info-->
          <div class="visible-lg visible-md m-t-10">
            {{-- <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
              <span class="semi-bold">{{ Auth::user()->name }}</span> <span class="text-master"></span>
            </div> --}}

            {{-- Trade Date --}}
            {{-- <div class="m-r-30 m-t-10 font-title f16" style="display:inline-block">
              Trade Date: <span class="text-success m-l-5">{{ App\Config::find('1')->TradeDate }}</span>
            </div> --}}


            <div class="fa fa-bell m-r-15 m-t-15 f18"></div>
            <a href="#">
              <div class="fa fa-envelope m-r-15 m-t-15 f20"></div>
            </a>

            <div class="dropdown pull-right">


              <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d39 circular inline m-t-5 text-white">
                  <img src="{{ asset('images/avatars/'.($user->avatar ?? 'default2.png')) }}" alt="" data-src="{{ asset('images/avatars/'.($user->avatar ?? 'default2.png')) }}" data-src-retina="{{ asset('images/avatars/'.($user->avatar ?? 'default2.png')) }}" width="32" height="32">
                  {{-- defaulr abbr avatar from fullname --}}
                  {{-- <span style="display: inline-block;" class="abbr-avatar">{{ Auth::user()->abbreviation(Auth::user()->FullName) }}</span> --}}
                </span>
                {{-- User Name --}}
                <div class="pull-right text-left p-l-10 fs-16 font-heading" style="padding-top:7px"> {{--removed p-t-10 --}}
                  <span style="font-weight:500px">{{ Auth::user()->FullName }}</span> <i class="fa fa-caret-down m-l-5"></i>
                  <br>
                  <div class="text-muted" style="font-size:13px; margin-top:-4px">
                    {!! ucwords(Auth::user()->roles()->first()->display_name) !!}
                  </div>
                  {{-- <span class="m-l-5">
                    {!! Auth::user()->role_names_formatted !!}
                  </span> --}}
                </div>
              </button>
              <ul class="dropdown-menu profile-dropdown" role="menu">
                @if ($user->staff)
                  <li><a href="{{ route('staff.edit_biodata', $user->staff->StaffRef) }}"><i class="pg-settings_small"></i> Edit Staff Profile</a>
                  </li>
                @endif
                {{-- <li><a href="#"><i class="pg-outdent"></i> Feedback</a>
                </li>
                <li><a href="#"><i class="pg-signals"></i> Help</a>
                </li> --}}
                <li class="bg-master-lighter">
                  <a href="/logout" class="clearfix">
                    <span class="pull-left">Logout</span>
                    <span class="pull-right"><i class="pg-power"></i></span>
                  </a>
                </li>
              </ul>
            </div>

          </div>
          <!-- END User Info-->
        </div>
      </div>
      <!-- END HEADER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content ">
          <!-- START JUMBOTRON -->
          <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
              <div class="inner">
                <!-- START BREADCRUMB -->

                {{-- <h4 class="page-title pull-left">
                    @if(View::hasSection('page-title'))
                      @yield('page-title')
                    @else
                        @yield('title')
                    @endif
                </div> --}}

                <ul class="breadcrumb">
                  {{-- <li>
                    <p class="theme-secondary text-uppercase">{{ config('app.name1', 'OfficeMate') }}</p>
                  </li>
                  <li><a href="#" class="active text-uppercase">{{ Route::currentRouteName() }}</a></li> --}}
                    @if(View::hasSection('page-title'))
                      <li class="page-title">
                        @yield('page-title')
                      </li>
                    @else
                      {{-- @yield('title') --}}
                      <li>
                        <p class="theme-secondary text-uppercase">{{ config('app.name1', 'OfficeMate') }}</p>
                      </li>
                      <li><a href="#" class="active text-uppercase">{{ Route::currentRouteName() }}</a></li>
                    @endif
                </ul>
                <span  class="pull-right" style="margin-top : -45px">
                  <button onclick="goBack()" class="btn btn-sm btn-rounded btn-inverse"><i class="fa fa-arrow-left m-r-5"></i> Back</button>
                  <span class="m-l-10">@yield('buttons')</span>

                </span>
                <div class="clearfix"></div>
                <!-- END BREADCRUMB -->
              </div>
            </div>
          </div>
          <!-- END JUMBOTRON -->

          {{-- @include('layouts.partials.submenu') --}}

          <!-- START CONTAINER FLUID -->
          <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            @yield('content')
</div>
          <!-- END CONTAINER FLUID -->
          <!-- -->
          @yield('bottom-content')
          <!-- -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg footer">
          <div class="copyright sm-text-center">
            <p class="small no-margin pull-left sm-pull-reset">
              <span class="hint-text">Copyright &copy; 2017 </span>
              <span class="font-montserrat">OfficeMate</span>.
              <span class="hint-text">All rights reserved. </span>
              <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
            </p>
            <p class="small no-margin pull-right sm-pull-reset">
              <span class="hint-text">Designed and Developed by </span><a href="#">Cavidel Limited</a>
            </p>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->

</div><!-- end vue init -->
    <!-- BEGIN VENDOR JS -->


    <script src="{{ asset('js/uikit.js') }}"></script>


    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}" ></script>

    <script src="{{ asset('assets/plugins/jquery/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" ></script>
    <script src="{{ asset('assets/plugins/modernizr.custom.js') }}" ></script>
    <script src="{{ asset('assets/plugins/boostrapv3/js/bootstrap.min.js') }}" ></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/jquery/jquery-easy.js') }}" ></script>
    <script src="{{ asset('assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" ></script>
    <script src="{{ asset('assets/plugins/jquery-bez/jquery.bez.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}" ></script> --}}
    <script src="{{ asset('assets/plugins/jquery-actual/jquery.actual.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script  src="{{ asset('assets/plugins/bootstrap-select2/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/switchery/js/switchery.min.js') }}" ></script> --}}
    <script src="{{ asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>

    <!-- Sweet-Alert  -->
    <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweet-alert2/jquery.sweet-alert.init.js') }}"></script>

    <script src="{{ asset('assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}"></script>


    <script src="{{ asset('assets/plugins/multiselect/js/jquery.selectlistactions.js') }}"></script>

    {{-- Filestyle --}}
    <script src="{{ asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <style media="screen">
      .r-round{
        border-radius:0 20px 20px 0 !important;
      }
    </style>
    <script>
    $(document).on('ready', function(){
      $(".group-span-filestyle > label").css('border-radius', '20px 0 0 20px');
      $(".bootstrap-filestyle input").addClass('r-round');
    });
    </script>

    <script>
      // Function for Confirmation modals
      function confirm2(the_title, the_html, form_id, modalClass = '', defaultAnimation = true){
        // Turning off default animation if using classes from animate.css
        if( modalClass.indexOf('animated') >= 0){
          defaultAnimation = false;
        }

        swal({title:the_title, html: the_html, type:"warning",showCancelButton:!0,confirmButtonClass:"btn btn-primary",cancelButtonClass:"btn btn-danger",confirmButtonText:"Yes",cancelButtonText:"No", animation: defaultAnimation, customClass: modalClass }).then(function(){ $('#'+form_id).submit(); }).catch(swal.noop);
      }

      // Function for Warning modals
      function warn(the_title, the_html, modalClass = ''){
        swal({title:the_title, html: the_html, type:"warning", animation: false, customClass: modalClass }).catch(swal.noop);
      }
    </script>

    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->

    <script src="{{ asset('pages/js/pages.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.js') }}" ></script>
    <script src="{{ asset('assets/js/scripts.js') }}" ></script>

    {{-- Filestyle --}}
    <script src="{{ asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <script>
      function goBack() {
        window.history.back();
      }
    </script>

    @stack('scripts')
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->


    <!-- END PAGE LEVEL JS -->


    <!-- END PAGE LEVEL JS -->
    @include('notifications')

    {{-- PUSHER NOTIFICATIONS --}}
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>
      // Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;

      var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'eu',
        encrypted: true
      });

      var channel = pusher.subscribe('new-notif');
      channel.bind('App\\Events\\PendingTradeEvent', function(data) {

        console.log(data);

        // $('.notif-list').prepend(`
        //   <li>
        //     <a href="${ data['link'] }">${ data['body'] }</a>
        //   </li>
        //   `);

        // Increment count by 1
        var notif = Number($('#notif').text());
        $('#notif').text(notif + 1);

        //Sound
        var audio = new Audio('/assets/sound/chat.mp3');
        audio.play();

      });
    </script>

    <script>
      $('input[required]').parent().find('label').addClass('req');
    </script>

  </body>
</html>
