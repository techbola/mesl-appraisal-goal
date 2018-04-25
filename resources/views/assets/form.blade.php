<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Description') }}
      {{ Form::text('Description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'required']) }}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Quantity') }}
      {{ Form::number('Quantity', null, ['class' => 'form-control', 'placeholder' => 'Quantity']) }}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('UnitCost', 'Unit Cost') }}
      {{ Form::number('UnitCost', null, ['class' => 'form-control', 'placeholder' => 'Unit Cost']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('PurchaseDate', 'Purchase Date' ) }}
      <div class="input-group date dp">
        {{ Form::text('PurchaseDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Purchase Date']) }}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('SerialNo', 'Serial Number') }}
      {{ Form::text('SerialNo', null, ['class' => 'form-control', 'placeholder' => 'Serial Number']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('AssetNo', 'Asset Number') }}
      {{ Form::text('AssetNo', null, ['class' => 'form-control', 'placeholder' => 'Asset Number']) }}
    </div>
  </div>

</div>
