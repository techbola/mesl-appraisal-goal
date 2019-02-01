@extends('layouts.master')

@push('styles')

	<style>
		.modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
    }

    thead tr {
      font-weight: bold;
      color: #000;
    }

	</style>
@endpush

@section('content')
    <div class="card-box">
        <div class="card-title">ID Card request form</div>
        <form action="{{ route('StoreIDcard') }}" method="POST" class="form">
            {{ csrf_field() }}
            {{-- row1 --}}
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('Passport','Upload Passport') }}
                    {{ Form::file('Passport', ['class' => 'form-control filestyle', 'data-placeholder'=>"Upload File", 'data-buttonname'=>"btn-info", 'data-buttonBefore'=>"true"]) }}
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('StaffName','Staff Name') }}
                        {{ Form::text('StaffName', Auth::user()->FullName, ['class' => 'form-control', 'placeholder' => 'Staff Name', 'required', 'readonly' ]) }}
                    </div>
                </div>
            </div>

            <br>
            {{-- row2 --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('StaffNumber','Staff Number') }}
                        {{ Form::text('StaffNumber', null,  ['class' => 'form-control', 'placeholder' => 'Enter Staff Number']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                            {{ Form::label('Department','Staff Department') }}
                            {{-- {{ Form::text('DepartmentID', Auth::user()->staff->company_department->name, ['class' => 'form-control', 'placeholder' => 'Employee Deprartment', 'required']) }} --}}
                        <select name="Department" id="Staff Department" class= "full-width",data-placeholder = "Choose your Leave Type", data-init-plugin = "select2" >
                            <option value="">Select Department</option>
                            @foreach ($department as $item)
                        <option value="{{$item->id}}" @if($item->id == Auth::user()->staff->company_department->id)  selected @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <br>
            {{-- row3 --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('IdPurpose', 'Purpose of request' ) }}
                            <select name="IdPurpose" class="full-width" data-init-plugin="select2">
                                <option value="">Select Purpose</option>
                                <option value="New Employee">New Employee</option>
                                <option value="Not Received">Not Received</option>
                                <option value="Lost/Stolen">Lost/Stolen</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('RequestDate', 'Request Date' ) }}
                        <div class="input-group date dp">
                            {{ Form::text('RequestDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Request Date', 'required', 'id' => 'request_Date']) }}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('ExpectedDate', 'Expected Date' ) }}
                        <div class="input-group date dp">
                            {{ Form::text('ExpectedDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Expected Date', 'required', 'id' => 'request_Date']) }}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            {{-- row4 --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('ApproverID','Select Approver') }}
                        {{ Form::select('ApproverID', [ '' =>  'select Approver'] + $staff->pluck('FullName', 'UserID')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "select Approver", 'data-init-plugin' => "select2", 'required', 'id'=>'approver']) }}
                    </div>
                </div>
            </div>

            {{-- Submit button --}}
            <div class="row">
                <div class="pull-right">
                    <button class="btn btn-info" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>

    {{-- ID card request Table --}}
    <div class="card-box">
        <div class="card-title pull-left">ID Card Request Status</div>
        <div class="pull-right">
            <div class="col-xs-12">
                <input type="text" class="search-table form-control pull-right" placeholder="Search">
            </div>
        </div>
        <div class="clearfix"></div>
            
      <table class="table tableWithSearch table-bordered">
        <thead>
          <th width="10%">Staff Name</th>
          <th width="7%">Staff Department</th>
          <th width="12%">Purpose</th>
          <th width="5%">Date Of Request</th>
          <th width="5%">Expected Date</th>
          <th width="15%">Action</th>
        </thead>
        <tbody>

          @foreach($idcard_requests as $idcard_request)
            <tr>
              <td>{{$idcard_request->StaffName}}</td>
              <td>{{$idcard_request->staff_department->name}}</td>
              <td>{{$idcard_request->IdPurpose}}</td>
              <td>{{$idcard_request->RequestDate}}</td>
              <td>{{$idcard_request->ExpectedDate}}</td>
              <td>
                <a onclick="confirm2('Send Request?', '', 'sendreq_{{ $idcard_request->IDcardRequestRef }}')" class="btn btn-xs btn-success"><i class="fa fa-share-square"></i> Onboard Staff</a>
                <a href="/idcard_request/create/{{$idcard_request->IDcardRequestRef}}" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>

                <form id="sendreq_{{ $idcard_request->IDcardRequestRef }}" action="{{ route('SendIDReq', $idcard_request->IDcardRequestRef) }}" method="POST" class="hidden">
                  {{ csrf_field() }}
                </form>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table> 

    </div>



@endsection


@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>

<script>
    

     $(document).ready(function() {
    $('#travelTable').DataTable( {
        "scrollX": true
    } );
} );


</script>

@endpush