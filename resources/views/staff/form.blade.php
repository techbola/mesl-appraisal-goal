@push('styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css"></link>
@endpush
@include('errors.list')
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('EmployeeNumber','Employee Number') }}
            {{ Form::text('EmployeeNumber', null,  ['class' => 'form-control', 'placeholder' => 'Enter Employee Number']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('JobTitle','JobTitle') }}
            {{ Form::text('JobTitle', null,  ['class' => 'form-control', 'placeholder' => 'Enter staff Job Title']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('TitleID','Title') }}
            {{ Form::select('TitleID', [ 0 =>  'Select Title'] + $titles->pluck('Title', 'TitleRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Title", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('LastName','Lastname') }}
            {{ Form::text('LastName', null,  ['class' => 'form-control', 'placeholder' => 'Enter staff lastname']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('MiddleName','Middlename') }}
            {{ Form::text('MiddleName', null,  ['class' => 'form-control', 'placeholder' => 'Enter staff middlename']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('FirstName','Firstname') }}
            {{ Form::text('FirstName', null,  ['class' => 'form-control', 'placeholder' => 'Enter staff Firstname']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('LocationID','Location') }}
             {{ Form::select('LocationID', [ 0 =>  'Select Staff Location'] + $locations->pluck('Location', 'LocationRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Staff location", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('email','Company Email') }}
            {{ Form::text('email', null,  ['class' => 'form-control', 'placeholder' => 'Enter staff Company Email']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('DepartmentID','Department') }}
            {{ Form::select('DepartmentID', [ 0 =>  'Select Staff Department'] + $departments->pluck('Department', 'DepartmentRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Staff location", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('ConfirmationDate', 'Confirmation Date') }}
            <div class="input-group date dp">
                {{ Form::text('ConfirmationDate', null, ['class' => 'form-control', 'placeholder' => 'Confirmation Date']) }}
                <span class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('EmploymentDate','Employment Date') }}
            <div class="input-group date dp">
                {{ Form::text('EmploymentDate', null, ['class' => 'form-control', 'placeholder' => 'Employmentdate']) }}
                <span class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('EmploymentStatusID','Employment Status') }}
             {{ Form::select('EmploymentStatusID', [ 0 =>  'Select Staff Employment Status'] + $status->pluck('EmploymentStatus', 'StatusRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Staff Employment Status", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('Gender','Gender') }}
             {{ Form::select('SexID', [ 0 =>  'Select Staff Gender'] + $sexs->pluck('Sex', 'SexRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Staff Gender", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('LeaveDays','Number of leave days') }}
             {{ Form::number('LeaveDays', null,  ['class' => 'form-control', 'placeholder' => 'Enter staff Number of leave days']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('SupervisorID','Supervisor') }}
             {{ Form::select('SupervisorID', [ 0 =>  'Select Staff Supervisor'] + $staff->pluck('FullName', 'StaffRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Staff Supervisor", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('RoleID','Role') }}
             {{ Form::select('RoleID', [ 0 =>  'Select Staff Role'] + $roles->pluck('name', 'id')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Staff Role", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group ">
            {{ Form::label('PositionID','Supervisor') }}
             {{ Form::select('PositionID', [ 0 =>  'Select Staff Position'] + $positions->pluck('Position', 'PositionRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Staff Position", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('UnitID','Unit') }}
             {{ Form::select('UnitID', [ 0 =>  'Select Staff Unit'] + $units->pluck('Unit', 'UnitRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Staff Unit", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <input type="hidden" name="password" value="welcome">
    <!-- action buttons -->
    <div class=" pull-right">
        <div class="form-group">
            <div class="controls">
                <div class="m-t-25">
                </div>
                {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
            </div>
        </div>
    </div>
    @push('scripts')
      <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
      <script>
        $('.dp').datepicker();
      </script>
    @endpush
