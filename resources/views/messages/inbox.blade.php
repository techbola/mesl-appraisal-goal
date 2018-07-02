@extends('layouts.master')

@section('title')
  Messages - Inbox
@endsection

@section('page-title')
  Messages - Inbox
@endsection

@section('content')

    {{-- <div class="row">
        <div class="col-sm-3 col-md-2">
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    EMail <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Mail</a></li>
                    <li><a href="#">Contacts</a></li>
                    <li><a href="#">Tasks</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-9 col-md-10">
            <!-- Split button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default">
                    <div class="checkbox" style="margin: 0;">
                        <label>
                            <input type="checkbox">
                        </label>
                    </div>
                </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">All</a></li>
                    <li><a href="#">None</a></li>
                    <li><a href="#">Read</a></li>
                    <li><a href="#">Unread</a></li>
                    <li><a href="#">Starred</a></li>
                    <li><a href="#">Unstarred</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh">
                &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;</button>
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    More <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Mark all as read</a></li>
                    <li class="divider"></li>
                    <li class="text-center"><small class="text-muted">Select messages to see more actions</small></li>
                </ul>
            </div>
            <div class="pull-right">
                <span class="text-muted"><b>1</b>–<b>50</b> of <b>160</b></span>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <hr> --}}

    <div class="row">
        @include('messages.menu', ['active' => 'inbox'])
        <div class="col-sm-8 col-md-9 inbox-content">
            <!-- Nav tabs -->
            {{-- <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">
                </span>Primary</a></li>
                <li><a href="#profile" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>
                    Social</a></li>
                <li><a href="#messages" data-toggle="tab"><span class="glyphicon glyphicon-tags"></span>
                    Promotions</a></li>
                <li><a href="#settings" data-toggle="tab"><span class="glyphicon glyphicon-plus no-margin">
                </span></a></li>
            </ul> --}}

            <!-- Tab panes -->
            {{-- <div class="tab-content"> --}}
                <div class="tab-pane fade in active card-box" id="home">
                    <div class="list-group">
                      @forelse ($messages as $msg)
                        {{-- {{ dd($msg->pivot->IsRead) }} --}}
                        <a href="{{ route('view_message', ['id'=>($msg->ParentID)? $msg->ParentID : $msg->MessageRef, 'reply'=>$msg->MessageRef] ) }}" class="list-group-item" style="{{ (!$msg->pivot->IsRead)? 'background:#eee;' : '' }}">
                          {{-- <div class="checkbox">
                          <label style="padding-left:0;margin-right:0;"><input type="checkbox"></label>
                          </div> --}}
                          <div class="checkbox">
                            <input type="checkbox" value="1" id="{{ $msg->MessageRef }}">
                            <label for="{{ $msg->MessageRef }}" style="padding-left:0;margin-right:0;"></label>
                          </div>
                          {{-- <span class="glyphicon glyphicon-star-empty"></span> --}}
                          <span class="name" style="min-width:120px; display: inline-block; {{ (!$msg->pivot->IsRead)? 'font-weight:bold;' : '' }}">{{ $msg->sender->FullName }}</span> <span class="" style="{{ (!$msg->pivot->IsRead)? 'font-weight:bold;' : '' }}">{{ $msg->Subject }}</span>
                          <span class="text-muted" style="font-size: 11px;">- {{ str_limit(strip_tags($msg->Body), '20') }}</span>
                          <span class="pull-right">
                            {{-- <i class="glyphicon glyphicon-paperclip"></i> --}}
                            <span class="label label-default m-l-5">
                              {{ ($msg->created_at->isToday())? $msg->created_at->format('g:i A') : $msg->created_at->format('jS M, Y') }}
                            </span>
                            {{-- <span class="label label-default m-l-5">12:10 AM</span> --}}
                          </span>
                        </a>
                      @empty
                        <div class="text-center m-t-20 m-b-30">
                          <img src="{{ asset('images/site/empty-messages.png') }}" alt="" style="opacity:0.7">
                          <h4 class="m-t-15 text-muted"><b>No messages yet</b></h4>
                          <div class="m-t-10 text-muted f16">You have no messages in your inbox yet.</div>
                        </div>
                      @endforelse
                      
                      <div class="m-t-10 m-l-10">{{ $messages->links() }}</div>

                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>

@endsection
