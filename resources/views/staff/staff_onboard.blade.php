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
                                {{-- {{ Form::text('Department', null, ['class' => 'form-control', 'placeholder' => 'Staff Department', 'required' ]) }} --}}
                                <select name="Department" id="Staff Department" class= "full-width",data-placeholder = "Choose your Leave Type", data-init-plugin = "select2" >
                                    <option value="">Select Department</option>
                                    @foreach ($department as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
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
                                        <select name="StaffType" class="full-width" data-init-plugin="select2">
                                            <option value="">Select Staff Type</option>
                                            <option value="Full Staff">Full Staff</option>
                                            <option value="Contract Staff">Contract Staff</option>
                                            <option value="Intern">Intern</option>
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
                                    <input class="form-check-input" type="checkbox" name="OfficeTable" value="Table" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Table
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="BusinessCard" value="Business Card" id="defaultCheck1">
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
                                    <input class="form-check-input" type="checkbox" name="System" value="System(Laptop/ Desktop)" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        System(Laptop/ Desktop)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="IDcreation" value="ID Card/Email Creation" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        ID Card, Email Creation
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="OfficemateProfile" value="Officemate Profile" id="defaultCheck1">
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
                        <th width="12%">Items</th>
                        <th width="15%">Action</th>
                    </thead>
                    <tbody>
                        @foreach($staff_onboards as $staff_onboard)
                              <tr>
                              <td>{{$staff_onboard->StaffName}}</td>
                              <td>{{$staff_onboard->staff_department->name}}</td>
                              <td>{{$staff_onboard->StaffType}}</td>
                              <td>{{$staff_onboard->ResumptionDate}}</td>
                              <td>{{$staff_onboard->System}}, {{$staff_onboard->IDcreation}}, {{$staff_onboard->OfficemateProfile}}</td>
                              <td>
                                  {{-- <button type="submit" class="btn btn-xs btn-success">Onboard Staff</button> {{ route('SendOnboarding', $staff_onboard->StaffOnboardRef) }} --}}
                                  <a href="{{ route('SendOnboarding', $staff_onboard->StaffOnboardRef) }}" class="btn btn-xs btn-success"><i class="fa fa-share-square"></i> Onboard Staff</a>
                                  <a href="/staff/staff_onboard/{{$staff_onboard->StaffOnboardRef}}" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
        <div id="onboarding-status" class="tab-pane fade">        
            <div class="clearfix"></div>
            <div class="card-box">
                <table class="table tableWithSearch table-bordered">
                    <thead>
                        <th width="10%">Employee</th>
                        <th width="7%">Department</th>
                        <th width="7%">Employment</th>
                        <th width="5%">Resumption</th>
                        <th width="12%">Items</th>
                        <th width="15%">Admin</th>
                        <th width="15%">HR</th>
                    </thead>
                    <tbody>
                        @foreach($staff_onboarding_sent as $staff_onboard)
                            <tr>
                                <td>{{$staff_onboard->StaffName}}</td>
                                <td>{{$staff_onboard->staff_department->name}}</td>
                                <td>{{$staff_onboard->StaffType}}</td>
                                <td>{{$staff_onboard->ResumptionDate}}</td>
                                <td>
                                    {{$staff_onboard->System}}, {{$staff_onboard->IDcreation}}, {{$staff_onboard->OfficemateProfile}}
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-xs btn-info">
                                        <i class="fa fa-share-square"></i> Pending Approval
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-xs btn-info">
                                        <i class="fa fa-share-square"></i> Pending Approval
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
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
        });
    </script>
@endpush