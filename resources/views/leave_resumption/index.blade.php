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
                    @if($create_btn == "1")
                        <a class="btn btn-info pull-right" href="javascript:void(0);" onclick="showLeaveResumptionModal()">
                            <i class="fa fa-plus"></i> Create New
                        </a>
                    @elseif($create_btn == "0")
                        <a class="btn btn-info pull-right" href="javascript:void(0);" disabled>
                            <i class="fa fa-plus"></i> Create New
                        </a>
                    @endif
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
                            <h2 class="lead">My Leave Resumption Request</h2>
                            <table class="table tableWithSearch">
                              <thead>
                                <th>Employee's Name</th>
                                <th>Department</th>
                                <th>Supervisor</th>
                                <th>Status</th>
                                <th>Option</th>
                                <th>Action</th>
                              </thead>
                              <tbody>
                                @foreach($leave_resumptions as $lr)
                                    @if($lr['is_final_approved'] == "0")
                                        <tr>
                                            <td>{{ $lr['employee_name'] }}</td>
                                            <td>{{ $lr['department_name'] }}</td>
                                            <td>{{ $lr['supervisor_name'] }}</td>
                                            <td>Pending</td>
                                            <td>
                                                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="viewLeaveResumptionModal('{{ $lr['first_approver'] }}', '{{ $lr['second_approver'] }}', '{{ $lr['third_approver'] }}', '{{ $lr['employee_name'] }}', '{{ $lr['supervisor_name'] }}', '{{ $lr['department_name'] }}', '{{ $lr['first_approver_status'] }}', '{{ $lr['second_approver_status'] }}', '{{ $lr['third_approver_status'] }}')">
                                                    <i class="fa fa-file"></i> View
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="showLrEditModal('{{ $lr['id'] }}')">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteLeaveResume('{{ $lr['id'] }}')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                              </tbody>
                            </table>

                            @if(count($resumption_approval) > 0)
                                <hr />
                                <h2 class="lead">Staff's Leave Resumption Request</h2>
                                <table class="table tableWithSearch">
                                  <thead>
                                    <th>Employee's Name</th>
                                    <th>Department</th>
                                    <th>Supervisor</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                    <th>Action</th>
                                  </thead>
                                  <tbody>
                                    @foreach($resumption_approval as $lr)
                                        @if($lr['is_final_approved'] == "0")
                                            <tr>
                                                <td>{{ $lr['employee_name'] }}</td>
                                                <td>{{ $lr['department_name'] }}</td>
                                                <td>{{ $lr['supervisor_name'] }}</td>
                                                <td>Pending</td>
                                                <td>
                                                    <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="viewLeaveResumptionModal('{{ $lr['first_approver'] }}', '{{ $lr['second_approver'] }}', '{{ $lr['third_approver'] }}', '{{ $lr['employee_name'] }}', '{{ $lr['supervisor_name'] }}', '{{ $lr['department_name'] }}', '{{ $lr['first_approver_status'] }}', '{{ $lr['second_approver_status'] }}', '{{ $lr['third_approver_status'] }}')">
                                                        <i class="fa fa-file"></i> View Approver's List
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success btn-sm" id="approve-lrr-btn" href="javascript:void(0);" onclick="approveLeaveResumptionRequest('{{ $lr['id'] }}', '{{ Auth::user()->id }}')">
                                                        <i class="fa fa-check"></i> Approve
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                  </tbody>
                                </table>
                            @endif
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
                              </thead>
                              <tbody>
                                @foreach($leave_resumptions as $lr)
                                    @if($lr['is_final_approved'] == "1")
                                        <tr>
                                            <td>{{ $lr['employee_name'] }}</td>
                                            <td>{{ $lr['department_name'] }}</td>
                                            <td>{{ $lr['supervisor_name'] }}</td>
                                            <td>Approved</td>
                                            <td>{{ $lr['date'] }}</td>
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
        // show leave resumption modal
        function showLeaveResumptionModal() {
            // showLeaveResumptionModal();
            computeStaffLeave({{ Auth::user()->id }});
            showDepartmentSupervisor({{ Auth::user()->id }});

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

        // show view more modal
        function viewLeaveResumptionModal(fan, san, tan, en, sn, dn, fas, sas, tas) {
            var approved1;
            var approved2;
            var approved3;

            if(fas == "1"){
                approved1 = "success";
            }else{
                approved1 = "danger";
            }

            if(sas == "1"){
                approved2 = "success";
            }else{
                approved2 = "danger";
            }

            if(tas == "1"){
                approved3 = "success";
            }else{
                approved3 = "danger";
            }

            $(".lr-view-approvers-name").html(`
                <div class="row small">
                    <div class="col-xs-12" style="font-size:9px;">
                        <a href="#" class="btn btn-${approved1} btn-sm">${fan}</a> <i class="fa fa-arrow-right"></i>
                        <a href="#" class="btn btn-${approved2} btn-sm">${san}</a> <i class="fa fa-arrow-right"></i> 
                        <a href="#" class="btn btn-${approved3} btn-sm">${tan}</a>
                    </div>
                </div>
            `);

            $(".lr-view-employee-name").html(en);
            $(".lr-view-supervisor-name").html(sn);
            $(".lr-view-department-name").html(dn);

            // body...
            $("#view-leave-resumption").modal()
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

            // Fetch Risk Manager 
            // Fetch HR Manager
            $.get('{{ url("leave/resumption/get/approver") }}', function(data) {
                if(data.status == "success"){
                    $("#riskmgt_id").val(data.riskmgt_id);
                    $("#hrmgt_id").val(data.hrmgt_id);
                }else{
                    // warning
                    swal(
                        "Oops",
                        data.message,
                        data.status
                    );
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
                        <option value="${data.department_id}">${data.department_name}</option>
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
            var riskmgt_id = $("#riskmgt_id").val();
            var hrmgt_id = $("#hrmgt_id").val();

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
                supervisor_remark: supervisor_remark,
                riskmgt_id: riskmgt_id,
                hrmgt_id: hrmgt_id
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

        // delete leave resume letter
        function deleteLeaveResume(leave_resumption_id) {

            swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result == true) {
                var token = $("#token").val();
                var params = {
                    _token: token,
                    leave_resumption_id: leave_resumption_id
                };

                $.post('{{ url('leave/resumption/delete') }}', params, function(data, textStatus, xhr) {
                    /*optional stuff to do after success */
                    if(data.status == "success"){
                        swal(
                            "Ok",
                            data.message,
                            data.status
                        );

                        // reload
                        window.location.reload();
                    }else{
                        swal(
                            "Oops",
                            data.message,
                            data.status
                        );
                    }
                });  
              }
            })
        }

        // approve leave resumption request
        function approveLeaveResumptionRequest(leave_resumption_id, staff_id) {
            $("#approve-lrr-btn").prop('disabled', true);
            $("#approve-lrr-btn").html(`<i class="fa fa-check"></i> Approving...`);
            $.get('{{ url("approve/leave/resumption")}}/'+leave_resumption_id+'/'+staff_id, function(data) {
                if(data.status == "success"){
                    swal(
                        "Ok",
                        data.message,
                        data.status
                    );

                    $("#approve-lrr-btn").prop('disabled', false);
                    $("#approve-lrr-btn").html(`<i class="fa fa-check"></i> Approve`);

                    // refresh page
                    window.location.reload();
                }else{
                    swal(
                        "Oops",
                        data.message,
                        data.status
                    );

                    $("#approve-lrr-btn").prop('disabled', false);
                    $("#approve-lrr-btn").html(`<i class="fa fa-check"></i> Approve`);
                }
            });
        }
    </script>
@endsection