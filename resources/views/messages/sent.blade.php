@extends('layouts.master')

@section('title')
  Sent Messages
@endsection

@section('page-title')
  Sent Messages
@endsection

@section('content')

    <div class="row">
        @include('messages.menu', ['active' => 'sent'])
        <div class="col-sm-8 col-md-9 inbox-content">

                <div class="tab-pane fade in active card-box" id="home">
                    <div class="list-group">
                      @forelse ($messages as $msg)
                        <a href="{{ route('view_message', ['id'=>($msg->ParentID)? $msg->ParentID : $msg->MessageRef, 'reply'=>$msg->MessageRef] ) }}" class="list-group-item">

                          <div class="checkbox">
                            <input type="checkbox" value="1" id="{{ $msg->MessageRef }}">
                            <label for="{{ $msg->MessageRef }}" style="padding-left:0;margin-right:0;"></label>
                          </div>
                          {{-- <span class="glyphicon glyphicon-star-empty"></span> --}}
                          <span class="name" style="min-width:120px; display: inline-block;">{{ $msg->sender->FullName }}</span> <span class="">{{ $msg->Subject }}</span>
                          <span class="text-muted" style="font-size: 11px;">- {{ str_limit(strip_tags($msg->Body), '20') }}</span>
                          <span class="pull-right">
                            <i class="glyphicon glyphicon-paperclip"></i>
                            <span class="label label-default m-l-5">
                              {{ ($msg->created_at->isToday())? $msg->created_at->format('g:i A') : $msg->created_at->format('jS M, Y') }}
                            </span>

                          </span>
                        </a>
                      @empty
                        <div class="text-center m-t-20 m-b-30">
                          <img src="{{ asset('images/site/empty-messages.png') }}" alt="" style="opacity:0.7">
                          <h4 class="m-t-15 text-muted"><b>No messages yet</b></h4>
                          <div class="m-t-10 text-muted f16">You haven't sent any messages yet.</div>
                        </div>
                      @endforelse
                    </div>
                </div>

        </div>
    </div>

@endsection
