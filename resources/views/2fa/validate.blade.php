@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>2FA Secret Key</h3>
        </div>

        <div class="panel-body">
            <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/2fa/validate">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('totp') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">One-Time Password</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="totp">

                                @if ($errors->has('totp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('totp') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-complete">
                                    <i class="fa fa-btn fa-mobile"></i>Validate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
@endsection