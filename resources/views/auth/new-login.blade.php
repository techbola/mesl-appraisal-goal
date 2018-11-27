<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ env("APP_NAME") }} | Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v9/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v9/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v9/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v9/vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v9/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v9/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v9/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v9/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v9/css/util.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/login.css')}}">
<!--===============================================================================================-->

<style type="text/css">
  #myVideo {
    position: fixed;
    right: 0;
    bottom: 0;
    min-width: 100%; 
    min-height: 100%;
  }

  .site-logo {
    position: absolute;
    z-index: 9999;
    background-color: rgba(255,255,255,0.90);
    padding: 4px;
    border-radius: 4px;
    margin-top: 4px;
    margin-left: 10px;
  }
</style>
</head>
<body>

  <video autoplay muted loop id="myVideo">
    <source src="{{asset('assets/video/bg.mp4')}}" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  {{-- site logo --}}
  <div class="site-logo">
    <img src="{{asset('assets/img/mesllogo.png')}}">
  </div>

  <div class="container-login100" style="background-image: url('');">
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30" style="background-color: rgba(255,255,255,0.80);">
      <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <span class="login100-form-title p-b-37">
          <img src="https://mesl.officemate.ng/images/officemate.png" alt="logo" data-src="https://mesl.officemate.ng/images/officemate.png" data-src-retina="https://mesl.officemate.ng/images/officemate.png" width="150" class="m-b-20">
          <p style="font-size: 14px;">
            Sign into your OfficeMate account
          </p>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="list-unstyled">
                  @foreach ($errors->all() as $error)
                      <li><strong>Login failed</strong><br>{{ $error }}</li>
                  @endforeach
              </ul>
            </div>
          @endif
        </span>

        <div class="wrap-input100 validate-input m-b-20" data-validate="Enter email">
          <input class="input100" type="text" name="email" placeholder="email" value="{{ old('email') }}">
          <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 validate-input m-b-25" data-validate="Enter password">
          <input class="input100" type="password" name="password" placeholder="password">
          <span class="focus-input100"></span>
        </div>

        <div class="row p-t-10 p-b-30">
          <div class="col-md-6 no-padding">
            <div class="checkbox ">
              <input type="checkbox" value="1" id="rememberme" {{ old('remember') ? 'checked' : '' }}>
              <label for="rememberme" class="small">Keep Me Signed in</label>
            </div>
          </div>
          <div class="col-md-6 text-right">
            <a class="text-info small" href="{{url('password/reset')}}">
              Forgot Your Password?
            </a>
          </div>
        </div>

        <div class="container-login100-form-btn">
          <button class="btn btn-danger col-md-6" style="border-radius: 10px;">
            Sign In
          </button>
        </div>
      </form>
    </div>
  </div>

  <div id="dropDownSelect1"></div>

<!--===============================================================================================-->
  <script src="https://colorlib.com/etc/lf/Login_v9/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="https://colorlib.com/etc/lf/Login_v9/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="https://colorlib.com/etc/lf/Login_v9/vendor/bootstrap/js/popper.js"></script>
  <script src="https://colorlib.com/etc/lf/Login_v9/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="https://colorlib.com/etc/lf/Login_v9/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="https://colorlib.com/etc/lf/Login_v9/vendor/daterangepicker/moment.min.js"></script>
  <script src="https://colorlib.com/etc/lf/Login_v9/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="https://colorlib.com/etc/lf/Login_v9/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="https://colorlib.com/etc/lf/Login_v9/js/main.js"></script>
</body>
</html>
