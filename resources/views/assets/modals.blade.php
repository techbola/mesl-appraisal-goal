<div class="modal fade" id="new_asset" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">Add New Asset</h5>
      </div>
      <div class="modal-body">
        @include('errors.list')
        {!! Form::open(['route' => 'save_asset']) !!}
        @include('assets.form')
        <div class="text-right m-t-10">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="edit_asset" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">Edit Asset</h5>
      </div>
      <div class="modal-body">
        @include('errors.list')
        {!! Form::open(['id'=>'asset_form_edit']) !!}
        {{ method_field('PATCH') }}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('Description') }}
              {{ Form::text('Description', null, ['v-model'=>'asset.Description', 'class' => 'form-control', 'placeholder' => 'Description', 'required']) }}
              {{-- <input type="text" class="form-control" name="Description" value="" v-model="asset.Description"> --}}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('Quantity') }}
              {{ Form::number('Quantity', null, ['v-model'=>'asset.Quantity', 'class' => 'form-control', 'placeholder' => 'Quantity']) }}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('UnitCost', 'Unit Cost') }}
              {{ Form::number('UnitCost', null, ['v-model'=>'asset.UnitCost', 'class' => 'form-control', 'placeholder' => 'Unit Cost']) }}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('PurchaseDate', 'Purchase Date' ) }}
              <div class="input-group date dp">
                {{ Form::text('PurchaseDate', null, ['v-model'=>'asset.PurchaseDate', 'class' => 'form-control', 'placeholder' => 'Purchase Date']) }}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('SerialNo', 'Serial Number') }}
              {{ Form::text('SerialNo', null, ['v-model'=>'asset.SerialNo', 'class' => 'form-control', 'placeholder' => 'Serial Number']) }}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('AssetNo', 'Asset Number') }}
              {{ Form::text('AssetNo', null, ['v-model'=>'asset.AssetNo', 'class' => 'form-control', 'placeholder' => 'Asset Number']) }}
            </div>
          </div>

        </div>

        <div class="text-right m-t-10">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
