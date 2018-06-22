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
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
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
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css') }}">
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
          {{-- @foreach($parent_menus as $menu)
            @if($menu->name != 'Dashboard') continue; @endif --}}
            @if ($dashboard)
              <li>
                <a href="{{ $dashboard->route != '#' ? route($dashboard->route) : "#" }}" class="">
                  <span class="title">{{$dashboard->name }}</span>
                  @if(count($dashboard->children) > 0 )
                    <span class="arrow"></span>
                  @endif
                </a>
                <span class="icon-thumbnail">{{ substr($dashboard->name, 0, 2) }}</span>
                {{$dashboard->hasSubmenu($dashboard->id ) }}
              </li>
            @endif
          {{-- @endforeach --}}

          {{-- OTHERS EXCEPT DASHBOARD --}}
          @foreach($parent_menus as $menu)
            <?php if($menu->name == 'Dashboard') continue; ?>
           <li>
            <a href="{{ $menu->route != '#' ? route($menu->route) : "#" }}" class="">
              <span class="title" data-toggle="tooltip" data-placement="right" title="{{ $menu->name }}">{{$menu->name }}</span>
              @if(count($menu->children) > 0 )
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
                {{-- <span class="icon-set menu-hambuger"></span> --}}
                <span class="pg-menu_justify"></span>
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
              Trade Date: <span class="text-success m-l-5">{{ Cavidel\Config::find('1')->TradeDate }}</span>
            </div> --}}

            {{-- Notification Icon --}}
            {{-- <div class="fa fa-bell m-r-15 m-t-15 f18"></div> --}}

            <!-- START NOTIFICATION LIST -->
            <ul class="notification-list no-style">
              <li class="inline">
                <div class="dropdown">


                  <a href="javascript:;" id="notification-center" class="" data-toggle="dropdown" style="position:relative">
                    <div class="fa fa-bell m-r-15 m-t-15 f18"></div>
                    <span id="notif" class="badge badge-danger badge-notif" {{ (count(auth()->user()->unreadNotifications) > 0)? '' : 'style=display:none' }}>{{ count(auth()->user()->unreadNotifications) }}</span>
                  </a>

                  <!-- START Notification Dropdown -->
                  <div class="dropdown-menu notification-toggle" role="menu" aria-labelledby="notification-center">
                    <!-- START Notification -->
                    <div class="notification-panel">
                      <!-- START Notification Body-->
                      <div class="notification-body scrollable">
                        @if (auth()->check())
                          <?php $user = auth()->user(); ?>
                          <ul class="notif-list">
                            @foreach ($user->unreadNotifications as $notif)
                              <li>
                                <a href="{{ $notif->data['link'] ?? '#' }}">{{ $notif->data['text'] ?? '' }}</a>
                              </li>
                            @endforeach
                          </ul>
                        @endif

                      </div>
                      <!-- END Notification Body-->
                      <!-- START Notification Footer-->
                      <div class="notification-footer text-center">
                        <a href="#" class="">Read all notifications</a>
                        <a data-toggle="refresh" class="portlet-refresh text-black pull-right" href="#">
                          <i class="pg-refresh_new"></i>
                        </a>
                      </div>
                      <!-- START Notification Footer-->
                    </div>
                    <!-- END Notification -->
                  </div>
                  <!-- END Notification Dropdown -->
                </div>
              </li>
            </ul>
            <!-- END NOTIFICATIONS LIST -->

            {{-- Message Icon --}}
            <a href="{{ route('inbox') }}" style="position:relative">
              <div class="fa fa-envelope m-r-15 m-t-15 f20"></div>
                <span id="msg" class="badge badge-danger badge-notif" {{ (count(auth()->user()->unread_inbox) > 0)? '' : 'style=display:none' }}>{{ count(auth()->user()->unread_inbox) }}</span>
            </a>

            <div class="dropdown pull-right">


              <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d39 circular inline m-t-5 text-white">
                  <img src="{{ asset('images/avatars/'.$user->avatar_light()) }}" alt="" data-src="{{ asset('images/avatars/'.$user->avatar_light()) }}" data-src-retina="{{ asset('images/avatars/'.$user->avatar_light()) }}" width="32" height="32">
                  {{-- defaulr abbr avatar from fullname --}}
                  {{-- <span style="display: inline-block;" class="abbr-avatar">{{ Auth::user()->abbreviation(Auth::user()->FullName) }}</span> --}}
                </span>
                {{-- User Name --}}
                <div class="pull-right text-left p-l-10 fs-16 font-heading" style="padding-top:7px"> {{--removed p-t-10 --}}
                  <span style="font-weight:500px">{{ Auth::user()->FullName }}</span> <i class="fa fa-caret-down m-l-5"></i>
                  <br>
                  <div class="text-muted" style="font-size:13px; margin-top:-4px">
                    {!! ucwords(Auth::user()->roles()->first()->name) !!}
                  </div>
                  {{-- <span class="m-l-5">
                    {!! Auth::user()->role_names_formatted !!}
                  </span> --}}
                </div>
              </button>
              <ul class="dropdown-menu profile-dropdown" role="menu">
                @if ($user->staff)
                  <li><a href="{{ route('staff.edit_biodata', $user->staff->StaffRef) }}"><i class="fa fa-user"></i> Edit Staff Profile</a>
                  </li>
                @endif
                @if ($user->hasRole('admin'))
                  <li><a href="{{ route('edit_company', $user->CompanyID) }}"><i class="fa fa-briefcase"></i> Edit Company</a>
                  </li>
                @endif
                <li>
                  <a href="{{ route('help') }}"><i class="fa fa-support"></i> Help</a>
                </li>
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
              <span class="hint-text">Copyright &copy; {{ date('Y') }} </span>
              <span class="font-montserrat">OfficeMate</span>.
              <span class="hint-text">All rights reserved. </span>
              <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
            </p>
            <p class="small no-margin pull-right sm-pull-reset">
              <span class="hint-text">Designed and Developed by </span><a href="www.cavidel.com">Cavidel Limited</a>
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



    <div id="spinner" style="display: none; padding-top:40vh" class="text-center">
      <img src="{{ asset('assets/img/spinner.gif') }}" alt="" width="40px">
    </div>

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
    <script src="{{ asset('assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}" ></script>
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

    <script src="https://unpkg.com/vue@2.5.16/dist/vue.js" charset="utf-8"></script>
    @stack('vue')

    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->

    <script src="{{ asset('pages/js/pages.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.js') }}" ></script>
    <script src="{{ asset('assets/js/scripts.js') }}" ></script>

    <!-- smart-input -->
    <script src="{{ asset('js/autonumeric/autoNumeric.min.js') }}"></script>
    <!-- /smart input -->

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

    {{-- PUSH.JS BROWSER NOTIF --}}
    <script src="{{ asset('assets/plugins/push.js/push.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/plugins/push.js/serviceWorker.min.js') }}" charset="utf-8"></script>

    <script>
      // Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;

      var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'eu',
        encrypted: true
      });

      var channel = pusher.subscribe('officemate');
      var audio = new Audio('/assets/sound/chat.mp3'); //Sound

      channel.bind('Cavidel\\Events\\NewTaskEvent', function(data) {
        if (data['StaffID'] == '{{ auth()->user()->staff->StaffRef }}') {
          // console.log(data);

          Push.create("New Task on OfficeMate", {
              body: data['Task'],
              icon: '{{ asset('images/site/stopwatch.png') }}',
              requireInteraction: true,
          });

          // $('.notif-list').prepend(`
          //   <li>
          //     <a href="${ data['link'] }">${ data['body'] }</a>
          //   </li>
          //   `);

          // Increment count by 1
          // var notif = Number($('#notif').text());
          // $('#notif').text(notif + 1);
          audio.play();
        }

      });

      channel.bind('Cavidel\\Events\\NewMessageEvent', function(data) {
        // console.log(data);
        console.log($.inArray('{{ auth()->user()->id }}', data['recipients']));
        if ($.inArray('{{ auth()->user()->id }}', data['recipients']) > -1) {
          Push.create("New Message From "+data['from'], {
              body: data['subject'],
              icon: '{{ asset('images/site/envelope.png') }}',
              requireInteraction: true,
          });

          var msg = Number($('#msg').text());
          $('#msg').show().text(msg + 1);
          audio.play();
        }

      });

      channel.bind('Cavidel\\Events\\ProjectChatEvent', function(data) {

        if ($.inArray('{{ auth()->user()->id }}', data['recipients']) > -1) {
          Push.create("New Chat In Project: \""+data['project']+"\"", {
              body: data['body'],
              icon: '{{ asset('images/site/envelope.png') }}',
              requireInteraction: true,
          });

          $('.notif-list').prepend(`
            <li>
              <a href="${ data['link'] }">${ data['text'] }</a>
            </li>
            `);

          var notif = Number($('#notif').text());
          $('#notif').show().text(notif + 1);
          audio.play();
        }

      });
    </script>

    {{-- END PUSHER Notifications --}}

    <script>
      // $('input[required]').parent().parent().find('label').addClass('req');
      $('input[required]').closest(".form-group").find('label').addClass('req');
      $('select[required]').closest(".form-group").find('label').addClass('req');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    </script>

    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>

    <script>
      $(function(){
          var options = {
              todayHighlight: true,
              format: 'yyyy-mm-dd',
              autoclose: true,
          };
          $('.dp').datepicker(options);
      });

      // $('.timepicker').timepicker().on('show.timepicker', function(e) {
      //     var widget = $('.bootstrap-timepicker-widget');
      //     widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
      //     widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
      //     widget.attr("style", "z-index: 9999999 !important; box-shadow: 0 6px 12px rgba(0,0,0,.175); border: 1px solid #ccc");
      // });
    </script>


      <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/css/summernote.css') }}" />
      <script src="{{ asset('assets/plugins/summernote/js/summernote.min.js') }}" charset="utf-8"></script>

      <link href="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
      <script src="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>



      <script>
        $(document).ready(function() {

          $('.summernote').summernote({
            // height: '100px',
            placeholder: '',
            toolbar: [
              // [groupName, [list of button]]
              ['style', ['bold', 'italic', 'underline', 'clear']],
              // ['font', ['strikethrough', 'superscript', 'subscript']],
              // ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              // ['height', ['height']],
              ['table', ['table']],
              ['insert', ['link', 'picture']],
            ],
            dialogsInBody: true,
          });


          $('.timepicker').timepicker({template: 'modal', defaultTime: false }).on('show.timepicker', function(e) {
              var widget = $('.bootstrap-timepicker-widget');
              widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
              widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
              widget.attr("style", "z-index: 9999999 !important; box-shadow: 0 6px 12px rgba(0,0,0,.175); border: 1px solid #ccc");
          });

          $('.scrollbar-outer').scrollbar();

        });

      </script>

      <!-- initialize smart input -->
      <script>
        AutoNumeric.multiple('.smartinput', {
            currencySymbol : '₦ ',
            decimalCharacter : '.',
            unformatOnSubmit: true,
            modifyValueOnWheel: false,
            minimumValue: 0,
            decimalPlaces: 2,
            decimalPlacesRawValue: 0,
        });
      </script>


  </body>
</html>
