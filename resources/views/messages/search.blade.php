@extends('layouts.master')

@section('title')
  Messages - Inbox
@endsection

@section('page-title')
  Messages - Inbox
@endsection

@section('content')
    {{-- <div class="card-box">
      <form action="" method="get">
        <div class="row">
          <div class="col-md-10">
            <input type="text" class="form-control" name="q" value="" placeholder="Search messages">
          </div>
          <div class="col-md-2">
            <input type="submit" class="btn btn-info btn-block" value="Search">
          </div>
        </div>
      </form>
    </div> --}}

    @include('messages.searchbox')

    <div class="row">

        @include('messages.menu', ['active' => 'inbox'])
        <div class="col-sm-8 col-md-9 inbox-content">

            <!-- Tab panes -->
                <div class="tab-pane fade in active card-box" id="home">
                    <div class="list-group">
                      @forelse ($results as $msg)
                        <a href="{{ route('view_message', ['id'=>($msg->ParentID)? $msg->ParentID : $msg->MessageRef, 'reply'=>$msg->MessageRef] ) }}" class="list-group-item">
                          {{-- <div class="checkbox">
                            <input type="checkbox" value="1" id="{{ $msg->MessageRef }}">
                            <label for="{{ $msg->MessageRef }}" style="padding-left:0;margin-right:0;"></label>
                          </div> --}}
                          <span class="name" style="min-width:120px; display: inline-block;">{{ $msg->sender->FullName }}</span> <span class="" style="">{{ $msg->Subject }}</span>
                          <span class="text-muted" style="font-size: 11px;">- {{ str_limit(strip_tags($msg->Body), '20') }}</span>
                          <span class="pull-right">
                            <span class="label label-default m-l-5">
                              {{ ($msg->created_at->isToday())? $msg->created_at->format('g:i A') : $msg->created_at->format('jS M, Y') }}
                            </span>
                          </span>
                        </a>
                      @empty
                        <div class="text-center m-t-20 m-b-30">
                          <img src="{{ asset('images/site/empty-messages.png') }}" alt="" style="opacity:0.7">
                          <h4 class="m-t-15 text-muted"><b>No search results</b></h4>
                          <div class="m-t-10 text-muted f16">No messages were found matching your query.</div>
                        </div>
                      @endforelse

                      <div class="m-t-10 m-l-10">{{ $results->links() }}</div>

                    </div>
                </div>
        </div>
    </div>

@endsection
