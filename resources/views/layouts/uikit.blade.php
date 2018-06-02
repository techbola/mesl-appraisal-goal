<!doctype html>
<html lang="en-us">

<!-- Mirrored from zawiastudio.com/dashboard/demo/messanger.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Feb 2018 16:21:03 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>
          @if(View::hasSection('title'))
            @yield('title') | OfficeMate
          @else
              OfficeMate
          @endif
        </title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- Stylesheet -->
        {{-- <link href="{{ asset('assets/plugins/boostrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> --}}



        <link rel="stylesheet" href="{{ asset('css/uikit.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/uikit-edited.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/style-uikit.css') }}">
    </head>
    <body class="o-page">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <div class="o-page__sidebar js-page-sidebar">
            <div class="c-sidebar">
                <a class="c-sidebar__brand" href="#">
                    {{-- <img class="c-sidebar__brand-img" src="img/logo.png" alt="Logo"> Dashboard --}}
                    <img class="c-sidebar__brand-img" src="{{ asset('images/officemate.png') }}" alt="Logo">
                </a>

                <h4 class="c-sidebar__title">Dashboards</h4>
                <ul class="c-sidebar__list">

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

                    <li class="c-sidebar__item">
                        <a class="c-sidebar__link" href="home-overview.html">
                            <i class="fa fa-home u-mr-xsmall"></i>Overview
                        </a>
                    </li>


                    <li class="c-sidebar__item has-submenu">
                        <a class="c-sidebar__link" data-toggle="collapse" href="#sidebar-submenu" aria-expanded="false" aria-controls="sidebar-submenu">
                            <i class="fa fa-caret-square-o-down u-mr-xsmall"></i>Sub Menu
                        </a>
                        <ul class="c-sidebar__submenu collapse" id="sidebar-submenu">
                            <li><a class="c-sidebar__link" href="#">Submenu link</a></li>
                            <li><a class="c-sidebar__link" href="#">Submenu link</a></li>
                            <li><a class="c-sidebar__link" href="#">Submenu link</a></li>
                        </ul>
                    </li>

                </ul>




            </div><!-- // .c-sidebar -->
        </div><!-- // .o-page__sidebar -->

        <main class="o-page__content">
            <header class="c-navbar u-mb-medium">
                <button class="c-sidebar-toggle js-sidebar-toggle">
                    <span class="c-sidebar-toggle__bar"></span>
                    <span class="c-sidebar-toggle__bar"></span>
                    <span class="c-sidebar-toggle__bar"></span>
                </button>

                <h2 class="c-navbar__title u-mr-auto">@yield('title')</h2>

                <div class="c-dropdown dropdown">
                    <a  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="c-avatar__img" src="{{ asset('images/avatar-72.jpg') }}" alt="{{ auth()->user()->first_name }}">
                    </a>

                    <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                        <a class="c-dropdown__item dropdown-item" href="#">Edit Profile</a>
                        <a class="c-dropdown__item dropdown-item" href="#">View Activity</a>
                        <a class="c-dropdown__item dropdown-item" href="#">Manage Roles</a>
                    </div>
                </div>
            </header><!-- // .c-navbar -->

            <div class="container-fluid">
              @yield('content')
            </div><!-- // .container -->
        </main><!-- // .o-page__content -->

        <!-- Main javascsript -->
        <script src="{{ asset('js/uikit.js') }}"></script>
        {{-- <script src="{{ asset('js/uikit-edited.js') }}"></script> --}}

        {{-- <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
        <script  src="{{ asset('js/select2.min.js') }}"></script>
        <script>
          $('.select3').select2();
        </script> --}}

    </body>

<!-- Mirrored from zawiastudio.com/dashboard/demo/messanger.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Feb 2018 16:21:03 GMT -->
</html>
