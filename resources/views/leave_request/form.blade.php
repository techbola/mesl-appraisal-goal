@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    <style>
        textarea {
        max-height: 50px;
        resize: none;
    }
    </style>
    @endpush
@include('errors.list')
<div class="row">

    <div class="col-sm-3">
        <div class="form-group">
            {{ Form::label('AbsenceTypeID','Absence Type') }}
            {{ Form::select('AbsenceTypeID', [ '' =>  'Absence Type'] + $leave_type->pluck('LeaveType', 'LeaveTypeRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose your Absence Type", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>

     <div class="col-md-3">
    <div class="form-group">
      {{ Form::label('StartDate', 'Start Date' ) }}
      <div class="input-group date dp">
        {{ Form::text('StartDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Start Date', 'required', 'id' => 'start_Date']) }}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      {{ Form::label('Number_of_Leavedays', 'Number of leave days' ) }}
        {{ Form::text('NumberofDays', null, ['class' => 'form-control', 'placeholder' => 'Number of Leave Days', 'required', 'id'=>'numberdays', 'onblur'=>'check_leave_days()', ]) }}
      </div>
    </div>

    <div class="col-md-3">
    <div class="form-group">
      {{ Form::label('ReturnDate', 'End Date' ) }}
        {{ Form::text('ReturnDate', null, ['class' => 'form-control', 'required', 'id'=>'return_date', 'readonly']) }}
      </div>
    </div>

   
  </div>
<div class="row">
  <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('ReliefOfficerID','Relief Officer') }}
            {{ Form::select('ReliefOfficerID', [ '' =>  'Releif Officer'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose your Absence Type", 'data-init-plugin' => "select2"]) }}
        </div>
  </div>

  <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('PhoneContact','Contact Mobile Number') }}
            {{ Form::text('PhoneContact', null, ['class' => 'form-control', 'placeholder' => 'Mobile Phone Number', 'required']) }}
        </div>
  </div>

  <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('EmailContact','Contact Email') }}
            {{ Form::text('EmailContact', null, ['class' => 'form-control', 'placeholder' => 'Email Address', 'required']) }}
        </div>
  </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            {{ Form::label('AddressContact','Contact Address') }}
            {{ Form::textarea('AddressContact', null, ['class' => 'form-control','required']) }}
        </div>
  </div>

  <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('HandOverNote','Upload Document') }}
            {{ Form::file('HandOverNote', null, ['class' => 'form-control']) }}
        </div>
  </div>
</div>

<div class="row">
<div class="col-md-12">
    <div class="form-group">
            {{ Form::label('Note','Leave Note') }}
            {{ Form::textarea('Note', null, ['class' => 'form-control']) }}
    </div>
</div><br>
<hr>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('ApproverID1','First Approver') }}
            {{ Form::select('ApproverID1', [ '' =>  'select Approver'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "select Approver", 'data-init-plugin' => "select2", 'required', 'id'=>'approver', 'onchange' => 'getValue()']) }}
        </div>
  </div>
  <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('ApproverID2','Second Approver') }}
            {{ Form::select('ApproverID2', [ '' =>  'select Approver'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "select Approver", 'data-init-plugin' => "select2"]) }}
        </div>
  </div>
  <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('ApproverID3','Third Approver ') }}
            {{ Form::select('ApproverID3', [ '' =>  'select Approver'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "select Approver", 'data-init-plugin' => "select2"]) }}
        </div>
  </div>
  <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('ApproverID4','Fourth Approver ') }}
            {{ Form::select('ApproverID4', [ '' =>  'select Approver'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "select Approver", 'data-init-plugin' => "select2"]) }}
        </div>
  </div>
</div>
<input type="hidden" name="StaffID" value="{{ $id }}">
<input type="hidden" name="ModuleID" value="3">
<input type="hidden" name="ApproverID" id='approver_id'>
</div>
   


    <!-- action buttons -->
    <div class=" pull-right">
        <div class="form-group">
            <div class="controls">
                <div class="m-t-25">
                </div>
                {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ', 'onclick'=>'verifyleave()' ]) }}
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script>
        $(function(){
        $('.dp').datepicker();
    })
    </script>

    <script>
        function getValue()
        {   
            $('#approver_id').empty();
            var id = $('#approver').val();
            $('#approver_id').val(id);
        }
    </script>

    <script>
           function check_leave_days()
            {
                var numberdays = parseInt($('#numberdays').val());
                var leave_left = parseInt($('#leave_left').text());
                var start_Date = $('#start_Date').val();
                if(numberdays > leave_left)
                {
                    alert('Your Request is more than the number of days remaining');
                    $('#numberdays').val(' ');
                }else
                {
                   $.get('/request_date/'+start_Date+'/'+numberdays, function(data, status) {
                    var value_date = data.EndDate;
                    $('#return_date').val(value_date);
                 });  
                }
                
            } 
    </script> 

    <script>
        function verifyleave()
        {

            var numberdays = parseInt($('#numberdays').val());
            var leave_left = parseInt($('#leave_left').text());
            if(numberdays > leave_left)
                {
                    alert('Your Request is more than the number of days remaining');
                    $('#numberdays').val(' ');
                }
                    
        }
    </script>
    @endpush
