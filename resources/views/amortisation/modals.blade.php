<div class="modal fade" id="new_amort" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">Add New Amortisation</h5>
      </div>
      <div class="modal-body">
        @include('errors.list')
        {!! Form::open(['route' => 'save_amort']) !!}
        @include('amortisation.form')
        <div class="text-right m-t-10">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

{{-- <div class="modal fade" id="edit_asset" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">Edit Asset</h5>
      </div>
      <div class="modal-body">
        @include('errors.list')
        {!! Form::open(['id'=>'amort_form_edit']) !!}
        {{ method_field('PATCH') }}
        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('MonthlyAmortItemID', 'Monthly Amort Item') }} <a class="pull-right toggle_item toggle_icon" onclick="new_item()"> <i class="fa fa-plus-circle text-success"></i> </a>
              {{ Form::select('MonthlyAmortItemID', [''=>'Select Monthly Amort Item'] + $items->pluck('MonthlyAmortItem', 'MonthlyAmortItemRef')->toArray(),null, ['data-init-plugin'=>'select2', 'class' => 'full-width select_item']) }}

              <input type="text" class="input_item form-control" placeholder="Enter a New Amortisation Item" style="display:none">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('Amount', 'Amount') }}
              {{ Form::number('Amount', null, ['class' => 'form-control', 'placeholder' => 'Amount']) }}
            </div>
          </div>

        </div>
        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('StartDate', 'Start Date' ) }}
              <div class="input-group date dp">
                {{ Form::text('StartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date']) }}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('EndDate', 'End Date' ) }}
              <div class="input-group date dp">
                {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date']) }}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
          </div>

        </div>
        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('GLIDDebit', 'GL Debit') }}
              {{ Form::select('GLIDDebit', [''=>'Select GL To Debit'] + $gls->pluck('Description', 'GLRef')->toArray(),null, ['data-init-plugin'=>'select2', 'class' => 'full-width']) }}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('GLIDCredit', 'GL Credit') }}
              {{ Form::select('GLIDCredit', [''=>'Select GL To Credit'] + $gls->pluck('Description', 'GLRef')->toArray(),null, ['data-init-plugin'=>'select2', 'class' => 'full-width']) }}
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
</div> --}}
