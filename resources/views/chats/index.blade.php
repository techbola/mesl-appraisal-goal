@extends('layouts.master')

@section('title')
  Customer Chats
@endsection

@section('content')
  <div class="row">
    @forelse ($chats as $chat)
      <a href="{{ route('chat', $chat->session) }}">
        <div class="col-md-4">
          <div class="panel panel-default glow">
            <div class="panel-heading">
              <h3 class="panel-title">{{ $chat->user->name }}</h3>
            </div>
            <div class="panel-body">
              <div class="f16 text-white">{{ Carbon\Carbon::parse($chat->date)->diffForHumans() }}</div>
            </div>
          </div>
        </div>
      </a>
    @empty
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"></h3>
        </div>
        <div class="panel-body">
          <div class="empty text-center">
            No active chats.
          </div>
        </div>
      </div>
    @endforelse
  </div>
@endsection
