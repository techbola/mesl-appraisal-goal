<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Court') }}
      {{ Form::text('Court', null, ['class' => 'form-control', 'placeholder' => 'Court Name', 'required' ]) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Location') }}
      {{ Form::text('Location', null, ['class' => 'form-control', 'placeholder' => 'Court Location', 'required' ]) }}
    </div>
  </div>
</div>
