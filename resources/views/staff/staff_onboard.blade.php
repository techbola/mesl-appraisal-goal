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

        tbody tr td {
            font-size: 12px;
        }

        .form-add-more{
            width: 20px;
            height: 20px;
            line-height: 20px;
            border-radius: 50%;
            text-align: center;
            padding: 0 !important;
            cursor: pointer;
        }
	</style>
@endpush

@section('content')
    <ul class="nav nav-tabs outside">
        <li class="active">
            <a data-toggle="tab" href="#onboarding-request">
                Onboarding Request &nbsp; <span class="badge badge-warning"></span>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#onboarding-status">
                Onboarding Status &nbsp; <span class="badge badge-success">
                    {{ count($staff_onboarding_sent) }}
                </span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="onboarding-request" class="tab-pane fade in active">
            <div class="clearfix"></div>
            <form action="{{ route('StoreStaff') }}" method="POST" class="form">
                {{ csrf_field() }}
                <div class="card-box">
                    <div class="card-title">New Staff Onboarding form</div>
                        {{-- row1 --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('StaffName','Staff Name') }}
                                    {{ Form::text('StaffName', null, ['class' => 'form-control', 'placeholder' => 'Staff Name', 'required' ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('Department','Department') }}
                                <select name="Department" id="department_name" class="form-control" required="">
                                    <option value="">Select Department</option>
                                </select>
                            </div>
                        </div>

                        <br>
                        {{-- row2 --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('StaffType', 'Staff Type' ) }} <span style="padding: 0 !important" class="form-add-more add-stafftype badge badge-success" data-toggle="modal" data-target="staff_type_setup"><i class="fa fa-plus"></i></span>
                                        <select name="StaffType" class="full-width" data-init-plugin="select2" id="staff_type_id" required>
                                            <option value="">Select Staff Type</option>
                                            @foreach($stafftype as $item)
                                                <option value="{{ $item->StaffTypeRef }}">{{ $item->StaffType }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('ResumptionDate', 'Resumption Date' ) }}
                                    <div class="input-group date dp">
                                        {{ Form::text('ResumptionDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Resumption Date', 'required', 'id' => 'resumption_Date']) }}
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="card-box">
                    <small style="color: #FA7638;"><strong>Kindly tick below the items to be provided for the new staff.</strong></small>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card-title">Admin</div>
                                <hr>
                                {{-- <p>create the staff under the following:</p> --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="OfficeSpace" value="Office Space" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Office Space
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="OfficeTable" value="Table" id="defaultCheck2">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Table
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="BusinessCard" value="Business Card" id="defaultCheck3">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Business Card
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card-title">IT</div>
                                <hr>
                                {{-- <p>create the staff under the following:</p> --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="System" value="System(Laptop/ Desktop)" id="defaultCheck4">
                                    <label class="form-check-label" for="defaultCheck1">
                                        System(Laptop/ Desktop)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="IDcreation" value="ID Card/Email Creation" id="defaultCheck5">
                                    <label class="form-check-label" for="defaultCheck1">
                                        ID Card, Email Creation
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="OfficemateProfile" value="Officemate Profile" id="defaultCheck6">
                                    <label class="form-check-label" for="defaultCheck1">
                                        User Account creation on Officemate
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="row">
                        <div class="pull-right">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>

            <hr>
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
                        <th width="10%">Employee</th>
                        <th width="7%">Department</th>
                        <th width="7%">Employment</th>
                        <th width="5%">Resumption</th>
                        <th width="12%">Workspace</th>
                        <th width="12%">Office Assets</th>
                        <th width="24%">Action</th>
                    </thead>
                    <tbody>
                        @foreach($staff_onboards as $staff_onboard)
                              <tr>
                              <td>{{$staff_onboard->StaffName}}</td>
                              <td>{{$staff_onboard->staff_department->name ?? ''}}</td>
                              <td>{{$staff_onboard->StaffType}}</td>
                              <td>{{$staff_onboard->ResumptionDate}}</td>
                              <td>
                                    {{$staff_onboard->OfficeSpace}} {{$staff_onboard->OfficeTable}} {{$staff_onboard->BusinessCard}}
                                </td>
                                <td>
                                    {{$staff_onboard->System}} {{$staff_onboard->IDcreation}} {{$staff_onboard->OfficemateProfile}}
                                </td>
                              <td>

                                  <a style="margin-right: 10px; display: inline-block" href="{{ route('SendOnboarding', $staff_onboard->StaffOnboardRef) }}" class="btn btn-xs btn-success"><i class="fa fa-share-square"></i> Onboard Staff</a>
                                  <!-- Button trigger modal -->
                                    <button style="margin-right: 10px; display: inline-block" type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#exampleModal"  onclick="edit_staff_onboarding( {{$staff_onboard->StaffOnboardRef}})">
                                        Edit Request
                                    </button>
                                  <a href="/staff/staff_onboard/{{$staff_onboard->StaffOnboardRef}}" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>

        {{-- Modal --}}
        <div id="onboarding-status" class="tab-pane fade">        
            <div class="clearfix"></div>
            <div class="card-box">
                <table class="table tableWithSearch table-bordered">
                    <thead>
                        <th width="10%">Employee</th>
                        <th width="7%">Department</th>
                        <th width="7%">Employment</th>
                        <th width="5%">Resumption</th>
                        <th width="12%">Workspace</th>
                        <th width="12%">Office Assets</th>
                        <th width="15%">Admin</th>
                        <th width="15%">IT</th>
                        <th width="15%">Action</th>
                    </thead>
                    <tbody>
                        @foreach($staff_onboarding_sent as $staff_onboard)
                            <tr>
                                <td>{{$staff_onboard->StaffName}}</td>
                                <td>{{$staff_onboard->staff_department->name}}</td>
                                <td>{{$staff_onboard->StaffType}}</td>
                                <td>{{$staff_onboard->ResumptionDate}}</td>
                                <td>
                                    {{$staff_onboard->OfficeSpace}} {{$staff_onboard->OfficeTable}} {{$staff_onboard->BusinessCard}}
                                </td>
                                <td>
                                    {{$staff_onboard->System}} {{$staff_onboard->IDcreation}} {{$staff_onboard->OfficemateProfile}}
                                </td>
                                
                                <td>
                                    @if($staff_onboard->ApprovalStatus2 == "0")
                                        <a href="javascript:void(0);" class="btn btn-xs btn-info">
                                            <i class="fa fa-share-square"></i> Pending Approval
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="btn btn-xs btn-success">
                                            <i class="fa fa-check-o"></i> Approved
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if($staff_onboard->ApprovalStatus1 == "0")
                                        <a href="javascript:void(0);" class="btn btn-xs btn-info">
                                            <i class="fa fa-share-square"></i> Pending Approval
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="btn btn-xs btn-success">
                                            <i class="fa fa-check-o"></i> Approved
                                        </a>
                                    @endif
                                </td>
                                <td><a href="/staff/staff_onboard/{{$staff_onboard->StaffOnboardRef}}" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Staff Onbaording</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <form action="{{ url('submit_staff_onboarding') }}" class="form-edit" method="POST">
            {{ csrf_field() }}
            <input type="hidden" id="StaffOnboardRef" name="StaffOnboardRef" value="">
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('StaffName','Staff Name') }}
                                    {{ Form::text('StaffName', null, ['class' => 'form-control', 'id' => 'staff_name', 'placeholder' => 'Staff Name', 'required' ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('Department','Department') }}
                                {{-- {{ Form::text('Department', null, ['class' => 'form-control', 'placeholder' => 'Staff Department', 'required' ]) }} --}}
                                <select name="Department" class="form-control" id="edit_department_name">
                                    <option value="">Select Department</option>
                                </select>
                            </div>
                        </div>
            
                        <br>
                        {{-- row2 --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('StaffType', 'Staff Type' ) }}
                                        <select name="StaffType" class="full-width" data-init-plugin="select2", id="staff_type">
                                            <option value="">Edit Staff Type</option>
                                            @foreach($stafftype as $item)
                                                <option value="{{ $item->StaffTypeRef }}">{{ $item->StaffType }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('ResumptionDate', 'Resumption Date' ) }}
                                    <div class="input-group date dp">
                                        {{ Form::text('ResumptionDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Resumption Date', 'required', 'id' => 'resumption_Date']) }}
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <br>
            
                        {{-- row3 --}}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card-title">Admin</div>
                                <hr>
                                {{-- <p>create the staff under the following:</p> --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="OfficeSpace" value="Office Space" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Office Space
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="OfficeTable" value="Table" id="defaultCheck2">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Table
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="BusinessCard" value="Business Card" id="defaultCheck3">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Business Card
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-title">IT</div>
                                <hr>
                                {{-- <p>create the staff under the following:</p> --}}
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="System" value="System(Laptop/ Desktop)" id="defaultCheck4">
                                    <label class="form-check-label" for="defaultCheck1">
                                        System(Laptop/ Desktop)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="IDcreation" value="ID Card/Email Creation" id="defaultCheck5">
                                    <label class="form-check-label" for="defaultCheck1">
                                        ID Card, Email Creation
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="OfficemateProfile" value="Officemate Profile" id="defaultCheck6">
                                    <label class="form-check-label" for="defaultCheck1">
                                        User Account creation on Officemate
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-edit" class="btn btn-primary">Save changes</button>
                </div>
                </div>
        </form>
    </div>
  </div>

  {{-- staff type setup modal --}}
  <div class="modal fade" id="staff_type_setup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Staff Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <hr>
        <div class="modal-body">
            <form action="" method="POST" id="staff-type-form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="controls">
                                {{ Form::label('StaffType', 'Staff Type' ) }}
                                {{ Form::text('StaffType', null, ['class' => 'form-control', 'placeholder' => 'Add Staff Type', 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="pull-right">
                        <button class="btn btn-info" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script>
        
    $('.add-stafftype').click(function(e){
        e.preventDefault();
        $('#staff_type_setup').show();
        $('#staff_type_setup').modal('show');
        
    });

    var form1 = $("#staff-type-form");
        form1.submit(function(e) {
        e.preventDefault();
        $.post('/api/add_staff_type', {
            StaffType: $('#StaffType').val()
        }, function(data, textStatus, xhr) {
            if(data.success === true){
            $('#staff_type_id').append('<option selected value="'+ data.data.StaffTypeRef +'">' +  data.data.StaffType +'</option>');
            $('#staff_type_setup').modal('hide');
            swal(
                'Success',
                data.data.StaffType + ' was added to the list',
                'success'
            )
                $('#StaffType').val('');
                
            } else {
            swal(
                'error',
                data.data.StaffType + ' has already been taken.',
                'error'
            )
        }
        });
    });


        $(document).ready(function() {
            $('#travelTable').DataTable({
                "scrollX": true
            });
        });

        function edit_staff_onboarding(id)
        {
        
            $.get('/edit_staff_onboarding/'+id, function(data, status) {
                console.log('data',data)

                $('#staff_name').val(data.StaffName);

                $('#edit_department_name').val(data.Department).trigger('change');

                $('#staff_type').val(data.StaffType).trigger('change');

                $('#resumption_date').val(data.ResumptionDate);

                $('#defaultCheck1').val(data.OfficeSpace);

                $('#defaultCheck2').val(data.OfficeTable);

                $('#defaultCheck3').val(data.BusinessCard);

                $('#defaultCheck4').val(data.System);

                $('#defaultCheck5').val(data.IDcreation);

                $('#defaultCheck6').val(data.OfficemateProfile);

                if (data.OfficeSpace != null)
                {
                    $('[name=OfficeSpace]').prop('checked', 'checked');
                }

                if (data.OfficeTable != null)
                {
                    $('[name=OfficeTable]').prop('checked', 'checked');
                }

                if (data.BusinessCard != null)
                {
                    $('[name=BusinessCard]').prop('checked', 'checked');
                }

                if (data.System != null)
                {
                    $('[name=System]').prop('checked', 'checked');
                }

                if (data.IDcreation != null)
                {
                    $('[name=IDcreation]').prop('checked', 'checked');
                }

                if (data.OfficemateProfile != null)
                {
                    $('[name=OfficemateProfile]').prop('checked', 'checked');
                }

                $('#StaffOnboardRef').val(data.StaffOnboardRef);

                $('#form-edit').prop('action', '/submit_staff_onboarding');
            });
        }


        //  $('#submit-edit').click(function(e) {
        //      e.preventDefault();
        //      $.post('/submit_staff_onboarding', $('#form-edit').serialize(), function(data, status) {
        //     if(status === 'success'){
        //     //   $('').html(data);
        //       swal('Ok', data, 'success');
        //     }
        // });

    //   });

        // get all department
        $(function(){
            $.get('{{ url("supervisor/all/department") }}', function(data) {
                $("#department_name").html("");
                $("#edit_department_name").html("");

                $.each(data, function(index, val) {
                    $("#department_name").append(`
                        <option value="${val.id}">${val.text}</option>
                    `);
                    $("#edit_department_name").append(`
                        <option value="${val.id}">${val.text}</option>
                    `);
                });

                // prepare select 2
                $('#department_name').select2({
                    // multiple: true
                });
            });
        })
    </script>
@endpush