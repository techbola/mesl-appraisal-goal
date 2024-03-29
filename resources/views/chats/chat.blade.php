@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
@endpush

@section('title')
  Chat
@endsection

@section('content')

  {{-- @php
    $session = session('chat_session');
  @endphp --}}

  <div class="card-box">

    <div class="row">
      <div class="col-md-5" style="height:75vh; overflow-y:scroll">
        <input id="search_users" type="text" class="form-control m-b-10" value="" placeholder="Search">

        <ul id="search_list" class="my-list">

        </ul>

        <ul id="user_list" class="my-list">
          <!-- BEGIN Chat User List Item  !-->
          @foreach ($employees as $staff)
            <li id="" class="chat-user-list clearfix">
              {{-- <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view" class="" href="#"> --}}
              <a id="user_{{ $staff->UserID }}" onclick="load_chats('{{ $staff->UserID }}')" class="" href="#">
                <span class="col-xs-height col-middle">
                  <span class="thumbnail-wrapper d32 circular bg-success">
                    <img width="34" height="34" alt="" src="{{ $staff->user->avatar_url() }}" class="col-top avatar2">
                  </span>
                </span>
                <p class="p-l-10 col-xs-height col-middle col-xs-12">
                  <span class="text-master">{{ $staff->FullName }}</span>
                  <span class="m-l-10 badge badge-danger new_chats_user" {{ (count($user->unread_chats_from($staff->UserID)) > 0)? '' : 'style=display:none' }}>
                      {{ count($user->unread_chats_from($staff->UserID)) }}
                  </span>
                  {{-- <span class="block text-master hint-text fs-12">Hello there</span> --}}
                </p>
              </a>
            </li>
          @endforeach
          <!-- END Chat User List Item  !-->
        </ul>

      </div>
      <div class="col-md-7">

        <div id="chat-container">

          <div id="user-info"></div>
          <div class="chat-wrapper theme-black">
            <div class="chat-overlay"></div>
            <div class="chat-messages" style="height: 85%;overflow-y:scroll">
              <div class="f22 bold" style="text-align:center; margin-top: 30%; opacity:0.7;">Click on a user to start chatting</div>
            </div>
            <div class="" style="position:  absolute;left: 5px;right: 5px;bottom: 0;">
              <form class="chat-form" method="post">
                {{ csrf_field() }}
                {{-- chat messages --}}
                <div class="form-group">
                  <input type="text" class="form-control m-t-10" id="message" placeholder="Type a message..." style="border-radius: 25px !important; padding: 25px 15px;" value="">
                  <input type="hidden" id="ToID" value="">
                </div>
              </form>
            </div>
          </div>

        </div>


      </div>
    </div>

  </div>


  {{-- <div class="text-center m-t-30 m-b-10">
    <a href="#" class="btn btn-info btn-sm" onclick="confirm2('End This Chat?', '', 'end_chat')">End Chat</a>
  </div>
  <form action="{{ route('end_chat', session('chat_session')) }}" method="post" id="end_chat">
    {{ csrf_field() }}
  </form> --}}

@endsection

@push('scripts')
  <script>
    $('.chatmessages').scrollTop($('.chat-messages')[0].scrollHeight);
  </script>

{{-- Load Chats --}}
<script>
  function load_chats(id) {
    $('#search_list').empty();
    $('#ToID').val(id);
    $.get('/load_chats/'+id, function(data, status){
      // console.log(data);
      var user_id = '{{ auth()->user()->id }}';
      $('.chat-messages').empty();
      data.forEach(function(chat){

        if(chat.FromID !== user_id){
            $('.chat-messages').append(`
              <div class="clearfix">
                <div class="chat-box-left m-t-10">
                    <span class="text-danger bold small">`+chat.from.first_name+' '+chat.from.last_name+`</span><br />
                    <span class="f13 m-t-5">`+chat.Body+`</span>
                    <span class="small pull-right text-muted chat-time">`+chat.date+`</span>
                    <br />
                </div>
              </div>
            `);
        }else{
          // <span class="text-muted bold small">Me: </span><br />
            $('.chat-messages').append(`
              <div class="clearfix">
                <div class="chat-box-right m-t-10">
                    <span class="f13 m-t-5">`+chat.Body+`</span>
                    <span class="small pull-right text-muted chat-time">`+chat.date+`</span>
                    <br />
                </div>
              </div>
            `);
        }
        $('.chat-messages').stop().animate({
            scrollTop: $(".chat-messages")[0].scrollHeight
        }, 800);
      });

    });

    // Show User Info
    $('#user-info').html(`
      <div class="m-b-10">
        <span class="col-xs-height col-middle">
          <span class="thumbnail-wrapper d39 circular">
            <img width="34" height="34" alt="" src="${ $(event.target).closest('li').find('img').attr('src') }" class="col-top avatar2">
          </span>
        </span>
        <p class="p-l-10 col-xs-height col-middle col-xs-12">
          <span class="text-master bold">${ $(event.target).closest('li').find('.text-master').text() }</span>
        </p>
      </div>
    `);
    // End Show User Info

    // Remove New Chat Count
    $(event.target).closest('li').find('.new_chats_user').hide().text('0');
  }

</script>

  <script>

  $('.chat-form').on('submit', function(event){
    event.preventDefault();
    sendChat();
  });

    function sendChat(){
      // alert('World');
      var message = $('#message').val();
      var token = $('input[name=_token]').val();
      var ToID = $('#ToID').val();
      var data = {
        _token: token,
        message: message,
        ToID: ToID,
      };
      $('#message').val('');
      $.ajax({
        type: 'post',
        url: '/save_chat',
        data: data,
        success: function(data) {
          // $('.chat-form')[0].reset();
          // console.log(data);
        },
        error: function(data) {
          // console.log(data);
        }
      });
      return false;
    }

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('{{ config('app.pusher_app_key') }}', {
      cluster: 'eu',
      encrypted: true
    });

    var channel = pusher.subscribe('new-chat');
    // var channel = pusher.subscribe('officemate');
    channel.bind('MESL\\Events\\NewChatMsg', function(data) {
      var ToID = $('#ToID').val();
      var user_id = '{{ Auth::user()->id }}';
      // console.log(data);
        if(data.FromID == ToID && data.ToID == user_id){
          // var audio = new Audio('/assets/sound/chat.mp3');
          // audio.play();

            $('.chat-messages').append(`
              <div class="clearfix">
                <div class="chat-box-left m-t-10">
                    <span class="text-danger bold small">`+data.from.first_name+' '+data.from.last_name+`</span><br />
                    <span class="f13 m-t-5">`+data.Body+`</span>
                    <span class="small pull-right text-muted chat-time">`+moment(data.created_at).fromNow()+`</span>
                    <br />
                </div>
              </div>
            `);
        } else if(data.FromID == user_id) {
          // <span class="text-muted bold small">Me: </span><br />
            $('.chat-messages').append(`
              <div class="clearfix">
                <div class="chat-box-right m-t-10">
                    <span class="f13 m-t-5">`+data.Body+`</span>
                    <span class="small pull-right text-muted chat-time">`+moment(data.created_at).fromNow()+`</span>
                    <br />
                </div>
              </div>
            `);
        } else if(data.ToID == user_id) {
          var chats = Number($('#user_'+data.FromID).find('.new_chats_user').text());
          $('#user_'+data.FromID).find('.new_chats_user').show().text(chats + 1);
        }
        $('.chat-messages').stop().animate({
            scrollTop: $(".chat-messages")[0].scrollHeight
        }, 800);

    });
  </script>

  <script>
    $('#search_users').on('keyup', function(){
      var search = $('#search_users').val();
      if (search.length >= 3) {
        $.post('/search_users', {search: search}, function(data, status){
          $('#search_list').empty();
          data.forEach(function(staff){
            $('#search_list').append(`
              <li id="" class="chat-user-list clearfix">
                <a id="user_${staff.UserID}" onclick="load_chats('${staff.UserID}')" class="" href="#">
                  <span class="col-xs-height col-middle">
                    <span class="thumbnail-wrapper d32 circular bg-success">
                      <img width="34" height="34" alt="" src="/images/avatars/${staff.user.avatar}" class="col-top avatar2">
                    </span>
                  </span>
                  <p class="p-l-10 col-xs-height col-middle col-xs-12">
                    <span class="text-master">${staff.user.first_name} ${staff.user.last_name}</span>
                  </p>
                </a>
              </li>
            `);
          });
          $('#search_list').append(`<hr>`);
        });
      }
    });
  </script>

  <script>
    $(document).ready(function(){
      $('#new_chats').hide().text('0');
    });
  </script>
@endpush
