@extends('layouts.master')

@section('content')
    <div class="panel panel-transparent" style="padding: 0px;">
        <div class="panel-body" style="padding: 0px;">
        </div>
    </div>
@endsection

@section('bottom-content')
    <div class="container-fluid container-fixed-lg bg-white">
        <!-- START PANEL -->
        <div class="panel panel-transparent">
            <div class="panel-heading">
                <div class="panel-title">
                    Leave Resumption Request
                </div>
                <div class="pull-right">
                    <a class="btn btn-info pull-right" href="javascript:void(0);" onclick="showLeaveResumptionModal()">
                        <i class="fa fa-plus"></i> Create New
                    </a>
                </div>
                <div class="pull-right">
                    <div class="col-xs-12">
                        <input class="search-table form-control pull-right" placeholder="Search" type="text">
                        </input>
                    </div>
                </div>
                <div class="clearfix">
                </div>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs outside">
                    <li class="active">
                        <a data-toggle="tab" href="#resumption-unapproved">
                            Pending Resumption Request &nbsp; <span class="badge badge-warning"></span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#resumption-approved">
                            Approved Resumption Request &nbsp; <span class="badge badge-success"></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="resumption-unapproved" class="tab-pane fade in active">
                        <div class="card-box ">
                            <table class="table tableWithSearch">
                              <thead>
                                <th>Employee's Name</th>
                                <th>Department</th>
                                <th>Supervisor</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                              </thead>
                              <tbody>
                                @foreach($leave_resumptions as $lr)
                                    @if($lr['is_approved'] == "0")
                                        <tr>
                                            <td>{{ $lr['employee_name'] }}</td>
                                            <td>{{ $lr['department_name'] }}</td>
                                            <td>{{ $lr['supervisor_name'] }}</td>
                                            <td>Pending</td>
                                            <td>{{ $lr['date'] }}</td>
                                            <td>
                                                <a class="btn btn-info" href="javascript:void(0);" onclick="showLrEditModal('{{ $lr['id'] }}')">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a class="btn btn-info" href="javascript:void(0);" onclick="delLeaveResume('{{ $lr['id'] }}')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="resumption-approved" class="tab-pane fade">
                      <div class="card-box">
                        <table class="table tableWithSearch">
                            <thead>
                                <th>Employee's Name</th>
                                <th>Department</th>
                                <th>Supervisor</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                              </thead>
                              <tbody>
                                @foreach($leave_resumptions as $lr)
                                    @if($lr['is_approved'] == "1")
                                        <tr>
                                            <td>{{ $lr['employee_name'] }}</td>
                                            <td>{{ $lr['department_name'] }}</td>
                                            <td>{{ $lr['supervisor_name'] }}</td>
                                            <td>Pending</td>
                                            <td>{{ $lr['date'] }}</td>
                                            <td>
                                                <a class="btn btn-info" href="javascript:void(0);" onclick="showLrEditModal('{{ $lr['id'] }}')">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a class="btn btn-info" href="javascript:void(0);" onclick="delLeaveResume('{{ $lr['id'] }}')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                              </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PANEL -->
    </div>

    @include('leave_resumption.modals')
@endsection

@section('scripts')
    <script type="text/javascript">
        // showLeaveResumptionModal();
        computeStaffLeave({{ Auth::user()->id }});
        showDepartmentSupervisor({{ Auth::user()->id }});

        // show leave resumption modal
        function showLeaveResumptionModal() {
            $("#create-leave-resumption").modal()
        }

        // compute leave 
        function computeStaffLeave(staff_id) {
            var params = {staff_id: staff_id};

            $.get('{{ url("leave/resumption/calculate/leave") }}', params, function(data) {
                if(data.status == "error"){
                    swal(
                        "Oops",
                        data.message,
                        data.status
                    );
                }else{
                    /*optional stuff to do after success */
                    $("#staff_name").html(`
                        <option value="${data.employee_id}">${data.employee_name}</option>
                    `);
                    $("#leave_days_taken").val(data.leave_days);
                    $("#leave_days_used").val(data.leave_used);
                    $("#leave_days_left").val(data.leave_left);
                    $("#leave_commernce_date").val(data.start_date);
                    $("#leave_resumption_date").val(data.end_date);
                    $("#new_resume_date").val(data.end_date);
                }
            });
        }

        // auto load dropdown helper
        $(function(){
            // load office location
            $('#office_location').select2({
                allowClear: true,
                placeholder: "Office Location",
                ajax: { 
                    url: "{{ url('leave/resumption/office/location') }}",
                    dataType: 'json',
                    delay: 100,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        })

        // show deparment supervisor
        function showDepartmentSupervisor(staff_id) {
            var params = {
                staff_id: staff_id
            };
            // load office location
            $.get('{{ url("leave/resumption/department/supervisor") }}', params, function(data) {

                if(data.status == "error"){
                    swal(
                        "Oops",
                        data.message,
                        data.status
                    );
                }else{
                    $(".deparment-supervisor").html(`
                        <label>Supervisor</label>
                        <select id="department_supervisor" class="form-control">
                          <option value="${data.id}">${data.text}</option>
                        </select>
                    `)

                    $("#department_name").html(`
                        <option value="${data.deparment_id}">${data.department_name}</option>
                    `);
                }
            });
        }

        // create new leave letter
        function addLeaveResumption() {
            $("#add-leave-resume-btn").prop('disabled', true);
            $("#add-leave-resume-btn").html(`
                Sending...
            `);

            var token = $("#token").val();
            var staff_name = $("#staff_name").val();
            var department_name = $("#department_name").val();
            var office_location = $("#office_location").val();
            var leave_commernce_date = $("#leave_commernce_date").val();
            var leave_resumption_date = $("#leave_resumption_date").val();
            var leave_days_taken = $("#leave_days_taken").val();
            var leave_days_used = $("#leave_days_used").val();
            var leave_days_left = $("#leave_days_left").val();
            var new_resume_date = $("#new_resume_date").val();
            var late_resumption_reason = $("#late_resumption_reason").val();
            var supervisor_remark = $("#supervisor_remark").val();
            var supervisor_id = $("#department_supervisor").val();

            var params = {
                _token: token,
                staff_id: staff_name,
                department_id: department_name,
                office_id: office_location,
                supervisor_id: supervisor_id,
                leave_commernce_date: leave_commernce_date,
                leave_resume_date: leave_resumption_date,
                leave_days_taken: leave_days_taken,
                leave_days_used: leave_days_used,
                leave_days_left: leave_days_left,
                date_resume: new_resume_date,
                reason_for_resumption: late_resumption_reason,
                supervisor_remark: supervisor_remark
            }

            $.post('{{ url("leave/resumption/create") }}', params, function(data, textStatus, xhr) {
                /*optional stuff to do after success */
                if(data.status == "success"){
                    swal(
                        "Ok",
                        data.message,
                        data.status
                    );
                    $("#create-leave-resumption").modal('hide');
                    $("#add-leave-resume-form")[0].reset();
                    $("#add-leave-resume-btn").html(`
                       Send Leave Resumption Request
                    `);
                    // reload
                    window.location.reload();
                }else{
                    swal(
                        "Oops",
                        data.message,
                        data.status
                    );
                    $("#add-leave-resume-btn").html(`
                       Send Leave Resumption Request
                    `);
                }

                // release btn
                $("#add-leave-resume-btn").prop('disabled', false);
            });


            // return;
            return false;
        }
    </script>
@endsection