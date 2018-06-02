@extends('layouts.static2')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">

      @if (!empty(session('notice')))
        <div class="alert alert-danger">
          {{ session('notice') }}
        </div>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Change Password</h3>
        </div>
        <div class="panel-body">

          @include('errors.list')

          <form action="{{ route('activate_pass2', ['id'=>$id, 'code'=>$code]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
              <label>Current Password</label>
              <input type="password" class="form-control" name="old_password" placeholder="Enter your current password">
            </div>
            <div class="form-group">
              <label>New Password</label>
              <input type="password" class="form-control" name="new_password" placeholder="Enter your new password">
            </div>
            <div class="form-group">
              <label>Confirm New Password</label>
              <input type="password" class="form-control" name="new_password_confirmation" placeholder="Confirm your new password">
            </div>
            <input type="submit" class="btn btn-info btn-lg btn-cons m-t-20" value="Save">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
