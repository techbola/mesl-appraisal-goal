<style>
/* CSS used here will be applied after bootstrap.css */
  .nav-tabs .glyphicon:not(.no-margin) { margin-right:10px; }
  .tab-pane .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
  .tab-pane .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
  .tab-pane .list-group .checkbox { display: inline-block;margin: 0px; }
  .tab-pane .list-group input[type="checkbox"]{ margin-top: 2px; }
  .tab-pane .list-group .glyphicon { margin-right:5px; }
  .tab-pane .list-group .glyphicon:hover { color:#FFBC00; }
  a.list-group-item.read { color: #222;background-color: #F3F3F3; }
  hr { margin-top: 5px;margin-bottom: 10px; }
  .nav-pills>li>a {padding: 5px 10px;}

  .ad { padding: 5px;background: #F5F5F5;color: #222;font-size: 80%;border: 1px solid #E5E5E5; }
  .ad a.title {color: #15C;text-decoration: none;font-weight: bold;font-size: 110%;}
  .ad a.url {color: #093;text-decoration: none;}

  .inbox-menu {
    padding-right: 0;
  }
  .inbox-menu .card-box {
    padding:0;
    min-height: 200px;
  }
  .inbox-content {
    padding-left: 0;
  }
  .inbox-content .card-box {
    padding-right: 0px;
    padding-left: 0px;
  }
  .menu-list li {
    padding-left: 0px;
  }
  .menu-list li a {
    padding: 10px 10px 10px 15px;
  }
</style>

@php
  // $messages = Cavi\Message::where('ToID', $user->id)->orderBy('MessageRef', 'desc')->get();
@endphp

<div class="col-sm-4 col-md-3 inbox-menu">
  <div class="card-box">
    <div class="" style="padding:15px 10%">
      <a href="{{ route('compose_message') }}" class="btn btn-danger btn-block" role="button">
        {{--<i class="glyphicon glyphicon-edit"></i>--}} Compose
      </a>
    </div>
    {{-- <hr> --}}
    <ul class="nav nav-pills nav-stacked menu-list">
      <li class="{{ ($active == 'inbox')? 'active':'' }}">
        <a href="{{ route('inbox') }}">
          @if (count( auth()->user()->unread_inbox ) > 0)
            <span class="label label-info pull-right m-t-5">{{ count( auth()->user()->unread_inbox ) }}</span>
          @endif
          Inbox
        </a>
      </li>
      {{-- <li><a href="#">Starred</a></li>
      <li><a href="#">Important</a></li> --}}
      <li class="{{ ($active == 'sent')? 'active':'' }}"><a href="{{ route('sent_messages') }}">Sent Messages</a></li>
      {{-- <li><a href="#"><span class="label label-info pull-right">3</span>Drafts</a></li> --}}
    </ul>
  </div>
</div>
