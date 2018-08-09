<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('CaseNumber', 'Case Number') }}
      {{ Form::text('CaseNumber', null, ['class' => 'form-control', 'placeholder' => 'Case Number', 'required' ]) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Parties', 'Parties') }}
      {{ Form::text('Parties', null, ['class' => 'form-control', 'placeholder' => '', 'required' ]) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('CourtID', 'Court and Location') }} <span style="padding: 0 !important" class="form-add-more badge badge-success"><i class="fa fa-plus"></i></span>
      {{ Form::select('CourtID', [''=>'Select Court'] + $courts->pluck('Court', 'CourtRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Court", 'data-init-plugin' => "select2", 'required']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('ContactID', 'Solicitor') }}
      {{ Form::select('ContactID', [''=>'Select Contact'] + $contacts->pluck('Customer', 'CustomerRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Contact", 'data-init-plugin' => "select2",]) }}
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('Summary', 'Summary Of Facts' ) }}
      {{ Form::textarea('Summary', null, ['class' => 'summernote', 'placeholder' => 'Summary of facts', 'rows' => '4']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Status', 'Status') }}
      {{ Form::select('Status', [''=>'Select Status'] + [0=>'Pending', 1=> 'Completed'],null, ['class'=> "full-width",'data-placeholder' => "Select Contact", 'data-init-plugin' => "select2", 'required']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('StatusDate', 'Status Date' ) }}
      <div class="input-group date dp">
        {{ Form::text('StatusDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Start Date', 'required']) }}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('LitigationStatus', 'Status Update' ) }}
      {{ Form::textarea('LitigationStatus', null, ['class' => 'summernote', 'placeholder' => 'Summary of facts', 'rows' => '4']) }}
    </div>
  </div>


  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('AdjournmentDate', 'Adjournment Date' ) }}
      <div class="input-group date dp">
        {{ Form::text('AdjournmentDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Start Date', 'required']) }}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>

</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('EstimatedFineAmountAgainst', 'Estimated Fine Amount Against') }}
      {{ Form::text('EstimatedFineAmountAgainst', null, ['class' => 'form-control smartinput amount', 'placeholder' => '0.00' ]) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('ActualFineAmountAgainst', 'Actual Fine Amount Against') }}
      {{ Form::text('ActualFineAmountAgainst', null, ['class' => 'form-control smartinput amount', 'placeholder' => '0.00' ]) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('EstimatedFineAmountInFavour', 'Estimated Fine Amount In Favour') }}
      {{ Form::text('EstimatedFineAmountInFavour', null, ['class' => 'form-control smartinput amount', 'placeholder' => '0.00' ]) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('ActualFineAmountInFavour', 'Actual Fine Amount In Favour') }}
      {{ Form::text('ActualFineAmountInFavour', null, ['class' => 'form-control smartinput amount', 'placeholder' => '0.00' ]) }}
    </div>
  </div>
</div>