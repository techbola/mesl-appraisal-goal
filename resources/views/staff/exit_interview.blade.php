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

    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control, .select2 {
        font-weight: normal !important;
        color: #aaaaaa !important;
        font-family: "Karla", sans-serif !important;
    }

    .form-control{
        font-family: "Karla", sans-serif !important;
    }

    body {
        color: #444;
        background-color: #ebeff2 !important;
        font-size: 14px;
        font-family: "Karla", 'Helvetica Neue', Helvetica, Arial, sans-serif;
        zoom: 99%;
    }
	</style>
@endpush

@section('content')
    <ul class="nav nav-tabs outside">
        <li class="active">
            <a data-toggle="tab" href="#exit-request">
                Exit Interview Form &nbsp; <span class="badge badge-warning"></span>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#exit-table">
                Exit table &nbsp; <span class="badge badge-success">
                    {{-- {{ count() }} --}}
                </span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="exit-request" class="tab-pane fade in active">
            <div class="clearfix"></div>
            <div class="card-box">
                <div class="card-title">Staff Exit Request</div>
                <br>
                <form action="{{ route('SendExit') }}" method="POST" class="form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('StaffID', 'Staff Name' ) }}
                                    <select name="StaffID" class="full-width" data-init-plugin="select2" onchange="fetchFillElement()">
                                        <option value=" ">Select Staff</option>
                                        @foreach($staff as $item)
                                            <option value="{{ $item->StaffRef }}">{{ $item->Fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('DepartmentID', 'Department') }}
                                    <select name="DepartmentID" class="full-width" data-init-plugin="select2">
                                        <option value=" ">Select Department</option>
                                        @foreach($department as $item)
                                            <option value="{{ $item->DepartmentRef }}">{{ $item->Department }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('SupervisorID', 'Supervisor') }}
                                        <select name="SupervisorID" class="full-width" data-init-plugin="select2">
                                            <option value="">Select Supervisor</option>
                                            @foreach($staff as $st)
                                                <option value="{{ $st->StaffRef }}">{{ $st->Fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="row">
                        <div class="pull-right">
                            <button class="btn btn-info" type="submit">Send Exit Notification</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="exit-table" class="tab-pane fade">        
            <div class="clearfix"></div>
            <div class="card-box">
                <table class="table tableWithSearch table-bordered">
                    <thead>
                        <th width="10%">Staff Name</th>
                        <th width="7%">Department</th>
                        <th width="7%">Supervisor</th>
                        <th width="15%">Status</th>
                        <th width="15%">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($exitnotice as $item)
                        <tr>
                            <td>{{$item->staff->FullName}}</td>
                            <td>{{$item->department->Department ?? ''}}</td>
                            <td>{{$item->supervisor->FullName ?? ''}}</td>
                            <td>
                                @if($item->exit_interview->SentResponse == true )
                                    <button type="button" class="btn btn-xs btn-success toggler" onclick=""><i class="fa fa-success"></i>Filled</button>
                                @else
                                    <button type="button" class="btn btn-xs btn-danger toggler" onclick=""><i class="fa fa-danger"></i>Pending</button>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-xs btn-primary toggler" onclick="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye"></i>View</button>
                                <a href="#" onclick="deleteItem('{{$item->ExitNotificationRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
        // fill related element
        function fetchFillElement(){
            var StaffID = $("select[name=StaffID]").val();
            $.get('{{ url("fetch/staff/info") }}', {StaffID}, function(data){
                console.log(data);
                $("select[name=DepartmentID]").val(data.department_id).trigger('change');
                $("select[name=SupervisorID]").val(data.supervisor_id).trigger('change');
            });
        }

        // what to delete btn
    function deleteItem(ExitNotificationRef){
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result == true){
                window.location.href = "/staff/exit_interview/"+ExitNotificationRef;
            }
        })
    }
    </script>
@endpush