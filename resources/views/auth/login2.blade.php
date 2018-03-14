@extends('layouts.static-uikit')

@section('title')
  Login
@endsection

@section('content')
  <style media="screen">
    .static-bg {
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      background-position: center;
      background-size: cover;
    }
    .static-overlay {
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      background-position: center;
      background-size: cover;
      background-color: rgba(0,0,0,0.5);
    }
    .c-card {
      box-shadow: 0 2px 16px 0 rgba(33,43,54,0.2), 0 31px 41px 0 rgba(33,43,54,0.08);
      /* padding: 44px 50px; */
      /* max-width: 530px; */
    }
    .c-card__body {
      padding: 44px 50px;
    }
    @media (min-width: 769px) {
      .o-page__card{
        max-width: 550px;
        width: 100%;
      }
    }
  </style>
  {{-- <div class="static-bg" style="background-image:url('{{ asset('images/project-card8.jpg') }}')"></div>
  <div class="static-overlay"></div> --}}

  <div class="o-page__card">
    <div class="u-text-center m-b-30">
      <img src="{{ asset('images/officemate.png') }}" alt="" style="width:195px;">
    </div>

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="list-unstyled">
             @foreach ($errors->all() as $error)
                 <li><strong>Login failed</strong><br>{{ $error }}</li>
             @endforeach
          </ul>
        </div>
      @endif

      @include('layouts.partials.alerts')

      <div class="c-card u-mb-xsmall">
          {{-- <header class="c-card__header u-pt-large">
              <a class="c-card__icon" href="#!">
                  <img src="{{ asset('images/logo-login.svg') }}" alt="Dashboard UI Kit">
              </a>
              <h1 class="u-h3 u-text-center u-mb-zero">Welcome back! Please login.</h1>
          </header> --}}



          <form class="c-card__body" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
              <div class="c-field m-b-30">
                  <label class="" for="input1">Email address</label>
                  <input class="c-input input-lg" type="email" id="input1" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
              </div>

              <div class="c-field m-b-30">
                  <label class="" for="input2">Password</label>
                  <input class="c-input input-lg" type="password" id="input2" name="password" placeholder="Password" required>
              </div>

              <button class="c-btn c-btn--info c-btn--fullwidth btn-lg" type="submit">Sign in to your account</button>

              {{-- <span class="c-divider c-divider--small has-text u-mv-medium">Login via social networks</span>

              <div class="o-line">
                  <a class="c-icon u-bg-twitter" href="#!">
                      <i class="fa fa-twitter"></i>
                  </a>

                  <a class="c-icon u-bg-facebook" href="#!">
                      <i class="fa fa-facebook"></i>
                  </a>

                  <a class="c-icon u-bg-pinterest" href="#!">
                      <i class="fa fa-pinterest"></i>
                  </a>

                  <a class="c-icon u-bg-dribbble" href="#!">
                      <i class="fa fa-dribbble"></i>
                  </a>
              </div> --}}
              <div class="u-text-center m-t-10">
                <a href="" class="text-muted">Forgot your password?</a>
              </div>
          </form>

      </div>

      <div class="u-text-center m-t-15">
        Don't have an account? <a href="{{ route('register') }}" class="m-l-5">Sign up your company</a>
      </div>

      {{-- <div class="o-line">
          <a class="u-text-mute u-text-small" href="register.html">Don’t have an account yet? Get Started</a>
          <a class="u-text-mute u-text-small" href="forgot-password.html">Forgot Password?</a>
      </div> --}}
  </div>
@endsection
