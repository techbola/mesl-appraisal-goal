<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('RelationshipType', 'Business Relationship Type') }}
      {{ Form::text('RelationshipType', null, ['class' => 'form-control', 'placeholder' => 'Enter Business Relationship Type', 'required' ]) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Description') }}
      {{ Form::text('Description', null, ['class' => 'form-control', 'placeholder' => 'Description' ]) }}
    </div>
  </div>
</div>
