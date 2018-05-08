<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Description') }}
      {{ Form::text('Description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'required']) }}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('CategoryID', 'Category') }} <a class="pull-right toggle_cat toggle_icon" onclick="new_cat()"> <i class="fa fa-plus-circle text-success"></i> </a>
      {{ Form::select('CategoryID', [''=>'Select Category'] + $categories->pluck('AssetCategory', 'AssetCategoryRef')->toArray(),null, ['data-init-plugin'=>'select2', 'class' => 'full-width select_cat']) }}

      <input type="text" class="input_cat form-control" placeholder="Enter a New Category Name" style="display:none">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('LocationID', 'Location') }} <a class="pull-right toggle_loc toggle_icon" onclick="new_loc()"> <i class="fa fa-plus-circle text-success"></i> </a>
      {{ Form::select('LocationID', [''=>'Select Location'] + $locations->pluck('Location', 'LocationRef')->toArray(),null, ['data-init-plugin'=>'select2', 'class' => 'full-width select_loc']) }}

      <input type="text" class="input_loc form-control" placeholder="Enter a New Location Name" style="display:none">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Quantity') }}
      {{ Form::number('Quantity', null, ['class' => 'form-control', 'placeholder' => 'Quantity']) }}
    </div>
  </div>

</div>
<div class="row">

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
        {{ Form::text('PurchaseDate', null, ['class' => 'form-control', 'placeholder' => 'Purchase Date']) }}
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
