@extends('layouts.master')

@section('content')
  <div class="card-box">

    <div class="row">
      <div class="col-md-6 col-md-offset-3">

        <form class="search-form" action="" method="get">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search" required>
            <span class="input-group-addon search pointer" onclick="$('#submit-search').trigger('click');">
              <i class="fa fa-search m-r-5"></i>Search
            </span>
            <input id="submit-search" type="submit" class="hidden">
          </div>
        </form>

      </div>
    </div>

    <hr>


    @if (!empty($_GET['q']))

        {{-- Messages --}}
        @if (count($inbox_messages) > 0)
          <div class="card-title">Messages</div>
          <div class="my-list">
            @foreach ($inbox_messages as $msg)
              <li>
                <div class="text-info">{{ $msg->Subject }}</div>
                <div class="">{!! str_limit(strip_tags($msg->Body), 50) !!}</div>
              </li>
            @endforeach
            @foreach ($sent_messages as $msg)
              <li>
                <div class="text-info">{{ $msg->Subject }}</div>
                <div class="">{!! str_limit(strip_tags($msg->Body), 50) !!}</div>
              </li>
            @endforeach
          </div>
        @endif

    @endif

  </div>
@endsection
