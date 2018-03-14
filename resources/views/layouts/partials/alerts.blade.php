@if ( !empty(session('danger2')) || !empty(session('warning2')) || !empty(session('success2')) || !empty(session('info2')) )
  @foreach (['danger2', 'warning2', 'success2', 'info2'] as $msg)
    @if(Session::has($msg))
      {{-- Fix padding for home template --}}
      <div class="alert alert-{{ substr($msg,0,-1) }}" style="padding-right:35px; font-size:15px">
          {!! session($msg) !!}
      </div>
    @endif
  @endforeach
@endif
