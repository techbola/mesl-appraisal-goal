<div class="modal fade" id="new_contact" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">New Business Contact</h5>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'BusinessContactController@save_contact', 'role' => 'form']) !!}
        @include('contacts.form')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>


<div class="modal fade" id="view_contact" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">@{{ contact.Name }}</h5>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>
