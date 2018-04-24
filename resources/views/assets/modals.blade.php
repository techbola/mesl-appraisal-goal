<div class="modal fade" id="new_asset" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">Add New Asset</h5>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'save_asset']) !!}
        @include('assets.form')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
