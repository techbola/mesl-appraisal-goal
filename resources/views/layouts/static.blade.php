<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      @if(View::hasSection('title'))
        TIMS - @yield('title')
      @else
          TIMS
      @endif
    </title>

    <link href="{{ asset('assets/plugins/boostrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link class="main-stylesheet" href="{{ asset('pages/css/pages.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="padding-top:70px">
    @yield('content')

    <script src="{{ asset('assets/plugins/jquery/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" ></script>
    <script src="{{ asset('assets/plugins/modernizr.custom.js') }}" ></script>
    <script src="{{ asset('assets/plugins/boostrapv3/js/bootstrap.min.js') }}" ></script>
  </body>
</html>
