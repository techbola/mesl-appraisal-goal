@extends('layouts.master')
@push('styles')
<link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
@endpush
@section('content')
  <div class="card-box">
    <div class="card-title">Settings</div>
    <h3>Two Factor Authentication</h3> <hr>
    @if (Auth::user()->google2fa_secret)
    <a href="{{ url('2fa/disable') }}" class="btn btn-danger">Disable 2FA</a>
    @else
    <a href="{{ url('2fa/enable') }}" class="btn btn-primary">Enable 2FA</a>
    @endif
  </div>
@endsection

@push('scripts')
  <script src="assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
@endpush
