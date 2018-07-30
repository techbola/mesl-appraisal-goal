@extends('layouts.master')

@section('content')
    <div class="card-box">
    <div class="card-title">Two Factor Authentication</div>
   <p>Open up your 2FA mobile app and scan the following QR barcode:</p>
       <img alt="Image of QR barcode" src="{{ $image }}" />
        <br /> <br>
        <p class="alert alert-info">
        If your 2FA mobile app does not support QR barcodes, 
        enter in the following number:<code>{{ $secret }}</code>
        </p>
        <br />
        <a class="btn btn-complete" href="{{ url('/') }}">Go Home</a>
  </div>     
@endsection

