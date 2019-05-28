@push('styles')
<style type="text/css">
  .add-more {
    padding: 0;
    border-radius: 50%;
    height: 20px;
    width: 20px;
    line-height: 20px;
    font-weight: bolder;
    margin-top: 30px;
  }
</style>
@endpush

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('StaffID', 'Employee Name') !!}
      <input type="text" class="form-control disabled" readonly value="{{ auth()->user()->staff->FullName }}">
      <input type="hidden" name="StaffID" value="{{ auth()->user()->staff->StaffRef }}">
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('DepartmentID', 'Department') !!}
      {!! Form::text('DepartmentID', auth()->user()->staff->department->Department , ['class'=>'form-control disabled', 'readonly']) !!}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {{-- {!! Form::label('AppraiserID', 'Appraiser\'s Name') !!}
      {!! Form::select('AppraiserID', ['' => 'Select Appraiser'] + $staff->pluck('FullName', 'StaffRef')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!} --}}
      {!! Form::label('AppraiserID', 'Appraiser\'s Name') !!}
      <input type="text" class="form-control disabled" readonly value="{{ auth()->user()->staff->supervisor->fullName }}">
      
    </div>
  </div>

  {{-- {!!  !!} --}}

  <div class="col-md-6">
    <div class="form-group">
       {!! Form::label('StaffID', 'Appraiser Role') !!}
       <select name="roles[]" id="appraiser_role" class="form-control select2" data-init-plugin = "select2" required multiple disabled>
         @foreach($roles as $role)
          <option @if(in_array($role->id, fecth_assigned_roles(auth()->user()->staff->supervisor->StaffRef))) selected @endif value="{{ $role->id }}">{!! $role->name !!}</option>
         @endforeach
       </select>
            
    </div>
  </div>


</div>



   <div class="row">
     <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="financials-heading">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#financials" aria-expanded="true" aria-controls="collapseOne">
          Financial
        </a>
      </h4>
    </div>
    <div id="financials" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="financials-heading">
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="objectives">Objectives</label>
              <input type="text" name="Objective[]" class="form-control" placeholder="Enter Objective">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="kpi">KPI</label>
              <input type="text" name="KPI[]" class="form-control" placeholder="Enter KPI">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="target">Target</label>
              <input type="number" min="1" max="100" name="Target[]" class="form-control" placeholder="Enter Target">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="objectives">Weight</label>
              <input type="number" min="1" max="100" name="Weight[]" class="form-control" placeholder="Enter Weight">
            </div>
          </div>

          <input type="hidden" name="AppraisalGroupID[]" value="1">

          <div class="col-sm-2">
            <button id="add_more_financials" class="add-more btn btn-sm btn-success">&plus;</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="internal-heading">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#internal" aria-expanded="false" aria-controls="internal-heading">
          Internal
        </a>
      </h4>
    </div>
    <div id="internal" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="objectives">Objectives</label>
              <input type="text" name="Objective[]" class="form-control" placeholder="Enter Objective">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="kpi">KPI</label>
              <input type="text" name="KPI[]" class="form-control" placeholder="Enter KPI">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="target">Target</label>
              <input type="number" min="1" max="100" name="Target[]" class="form-control" placeholder="Enter Target">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="objectives">Weight</label>
              <input type="number" min="1" max="100" name="Weight[]" class="form-control" placeholder="Enter Weight">
            </div>
          </div>

          <input type="hidden" name="AppraisalGroupID[]" value="1">

          <div class="col-sm-2">
            <button id="add_more_financials" class="add-more btn btn-sm btn-success">&plus;</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="customer-heading">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#customer" aria-expanded="false" aria-controls="customer-heading">
          Customer
        </a>
      </h4>
    </div>
    <div id="customer" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="objectives">Objectives</label>
              <input type="text" name="Objective[]" class="form-control" placeholder="Enter Objective">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="kpi">KPI</label>
              <input type="text" name="KPI[]" class="form-control" placeholder="Enter KPI">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="target">Target</label>
              <input type="number" min="1" max="100" name="Target[]" class="form-control" placeholder="Enter Target">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="objectives">Weight</label>
              <input type="number" min="1" max="100" name="Weight[]" class="form-control" placeholder="Enter Weight">
            </div>
          </div>

          <input type="hidden" name="AppraisalGroupID[]" value="1">

          <div class="col-sm-2">
            <button id="add_more_financials" class="add-more btn btn-sm btn-success">&plus;</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

   </div>

   {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}

   @push('scripts')
   <script>
     $(function(){
      $('#add_more_financials').click(function(e) {
        e.preventDefault();
      });
     });
   </script>
   @endpush