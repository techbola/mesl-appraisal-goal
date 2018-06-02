<!doctype html>
<html lang="en-us">

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
        <link href="{{ asset('assets/plugins/boostrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('css/uikit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style-uikit.css') }}">

    </head>
    <body class="o-page o-page--center" style="padding-top:60px">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        @yield('content')

        <!-- Main javascsript -->
        <script src="{{ asset('js/uikit.js') }}"></script>


    </body>

<!-- Mirrored from zawiastudio.com/dashboard/demo/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Feb 2018 16:23:17 GMT -->
</html>
