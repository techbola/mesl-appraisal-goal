@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
@endpush

@section('title')
  Support Chat
@endsection

@section('content')

  {{-- @php
    $session = session('chat_session');
  @endphp --}}

  <div class="row">
    <div class="col-md-6 col-md-offset-3">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"></h3>
        </div>
        <div class="panel-body">
          <div class="chat-wrapper theme-black">
            <div class="chat-overlay"></div>
            <div class="chat-messages"></div>
          </div>

          {{-- <div class="chat-input"> --}}
          @if ( empty($chat) || $chat->status == 'active')
            <div class="">
              <form class="chat-message-form" method="post" onsubmit="return false">
                  {{ csrf_field() }}
                  {{-- auth logged email --}}
                  <input type="hidden" id="user_email" value="{{ Auth::user()->email }}">
                  <input type="hidden" id="session" value="{{ $session }}">

                  {{-- chat messages --}}
                  <div class="form-group">
                      <textarea class="form-control m-t-10" rows="2" cols="3" id="message" placeholder="Type a message..." style="border-radius: 5px !important;"></textarea>
                  </div>
                  <div class="form-group">
                      <button class="btn btn-complete btn-lg col-xs-12" onclick="sendChat()">
                          Send <img src="/svg/three-dots.svg" width="20px" height="20px" style="display: none;" class="loading pull-right">
                      </button>
                  </div>
              </form>
            </div>
          @else
            <div class="bg-danger p-t-15 p-b-15 p-r-10 p-l-10 f16 font-title">
              This chat has ended.
            </div>
          @endif




        </div>
      </div>

      {{-- @if ($user->hasRole('Admin')) --}}
      @if (empty($chat) || $chat->status == 'active')
        <div class="text-center m-t-30 m-b-10">
          <a href="#" class="btn btn-info btn-sm" onclick="confirm2('End This Chat?', '', 'end_chat')">End Chat</a>
        </div>
        <form action="{{ route('end_chat', session('chat_session')) }}" method="post" id="end_chat">
          {{ csrf_field() }}
        </form>
      @endif
      {{-- @endif --}}


    </div>
  </div>

@endsection

@push('scripts')
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>

  <script>
    $('.chatmessages').scrollTop($('.chat-messages')[0].scrollHeight);
  </script>

{{-- Load Chats --}}
<script>

    $.get('/load_chats', function(data, status){
      console.log(data);
      var logged_email = '{{ Auth::user()->email }}';
      data.forEach(function(chat){

        if(chat.email !== logged_email){
            $('.chat-messages').append(`
                <div class="chat-box-right m-t-10">
                    <span class="text-danger bold">`+chat.user.name+`</span><br />
                    <span class="f15 m-t-5">`+chat.body+`</span>
                    <span class="small pull-right text-muted">`+chat.date+`</span>
                    <br />
                </div>
            `);
        }else{
            $('.chat-messages').append(`
                <div class="chat-box-left m-t-10">
                    <span class="text-muted bold">Me: </span><br />
                    <span class="f15 m-t-5">`+chat.body+`</span>
                    <span class="small pull-right text-muted">`+chat.date+`</span>
                    <br />
                </div>
            `);
        }
        $('.chat-wrapper').stop().animate({
            scrollTop: $(".chat-wrapper")[0].scrollHeight
        }, 800);
      });


    });
</script>

  <script>
    function sendChat(){
      // alert('World');
      var email = $('#user_email').val();
      var message = $('#message').val();
      var token = $('input[name=_token]').val();
      var session = $('#session').val();
      var data = {
        _token: token,
        email: email,
        message: message,
        session: session,
      };
      $('#message').val('');
      $.ajax({
        type: 'post',
        url: '/save_chat',
        data: data,
        success: function(data) {
          // $('.chat-message-form')[0].reset();
          // console.log(data);
        },
        error: function(data) {
          // console.log(data);
        }
      });
      return false;
    }

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    // var pusher = new Pusher('b25f58af67b74d2863d6', {
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
      cluster: 'eu',
      encrypted: true
    });

    var channel = pusher.subscribe('new-chat');
    channel.bind('App\\Events\\NewChatMsg', function(data) {
      var el = data;
      var logged_email = '{{ Auth::user()->email }}';
      console.log(data);
      console.log('{{session('chat_session')}}');
      if (el.session == '{{ session('chat_session') }}') {
        if(el.email !== logged_email){
          var audio = new Audio('/assets/sound/chat.mp3');
          audio.play();

            $('.chat-messages').append(`
              <div class="chat-box-right m-t-10">
                  <span class="text-danger bold">`+el.username+`</span><br />
                  <span class="f15 m-t-5">`+el.body+`</span>
                  <span class="small pull-right text-muted">`+el.date+`</span>
                  <br />
              </div>
            `);
        }else{
            $('.chat-messages').append(`
              <div class="chat-box-left m-t-10">
                  <span class="text-muted bold">Me: </span><br />
                  <span class="f15 m-t-5">`+el.body+`</span>
                  <span class="small pull-right text-muted">`+el.date+`</span>
                  <br />
              </div>
            `);
        }
        $('.chat-wrapper').stop().animate({
            scrollTop: $(".chat-wrapper")[0].scrollHeight
        }, 800);

      }

    });
  </script>
@endpush
