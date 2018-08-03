@extends('layouts.app')

@section('content')
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">2FA Secret Key</div>

                <div class="panel-body">
                @include('errors.list')
                    <form class="form-inline" action="/2fa/validate" method="POST">
                    {{ csrf_field() }}
  <div class="form-group">
    <input name="totp" type="text" class="form-control" placeholder="Enter your secret key">
  </div>
  <button type="submit" class="btn btn-primary">Authenticate</button>
</form>
                </div>
            </div>
        </div>
@endsection

