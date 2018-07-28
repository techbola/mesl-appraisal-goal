@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>2FA Secret Key</h3>
        </div>

        <div class="panel-body">
            <div class="alert alert-success">
                2FA has been removed
            </div>
            <br />
            <a class="btn btn-complete" href="{{ url('/') }}"><i class="fa fa-home m-r-5"></i> Go Home</a>
        </div>
    </div>
@endsection