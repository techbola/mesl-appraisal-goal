@foreach ($bulletins as $item)
  <div class="card-box">
    <div class="thumbnail-wrapper d48 circular">
      <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->poster->avatar()) }}">
    </div>

    <div class="inline m-l-15">
      <h4 class="page-title" style="font-size:17px; margin-top:0 !important">{{ $item->Title }}</h4>
      <p class="no-margin text-muted">
        Posted by <b class="text-info">{{ $item->poster->FullName }}</b>, {{ ($item->CreatedDate->isToday())? 'Today' : 'on '.$item->CreatedDate->format('jS M, Y') }} at {{ $item->CreatedDate->format('g:ia') }}
      </p>
      @can ('manage-bulletins')
        <div class="pull-right btn btn-sm btn-danger" onclick="confirm2('Delete this item?', '', 'delete_{{ $item->BulletinRef }}')" style="position:absolute; top:10px; right:10px"><i class="fa fa-trash m-r-5"></i> Delete</div>
        <form id="delete_{{ $item->BulletinRef }}" action="{{ route('delete_bulletin', $item->BulletinRef) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form>
      @endcan
    </div>

    <hr>
    <div class="bulletin-text">
      {!! nl2br($item->Body) !!}
    </div>
  </div>
@endforeach

<div class="text-center">
  {{ $bulletins->links() }}
</div>
