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
                    Supervisor Listing
                </div>
                <div class="pull-right">
                    <a class="btn btn-info pull-right" href="javascript:void(0);" onclick="showCreateSupervisorForm()">
                        <i class="fa fa-plus"></i> Add
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
                <table class="table tableWithSearch">
                    <thead>
                        <th>
                            Supervisor
                        </th>
                        <th>
                            Department
                        </th>
                        <th>
                            Option
                        </th>
                    </thead>
                    <tbody>
                        @foreach($assigned_supervisors as $staff)
                            <tr>
                                <td>{{ ucfirst($staff['last_name']) }} {{ ucfirst($staff['last_name']) }}</td>
                                <td>{{ ucfirst($staff['department']) }}</td>
                                <td>
                                    <a class="btn btn-info" href="javascript:void(0);" onclick="showSupervisorEditModal('{{ $staff['id'] }}')">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <a class="btn btn-info" href="javascript:void(0);" onclick="delSupervisor('{{ $staff['id'] }}')">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END PANEL -->
    </div>

    @include('company_supervisor.modals')
@endsection

@section('scripts')
    <script type="text/javascript">
        // show department form
        function showCreateSupervisorForm() {
            $("#add-supervisor").modal();
        }

        // update department
        function showSupervisorEditModal(supervisor_id) {
            // body...
            var params = {
                supervisor_id: supervisor_id
            }

            $.get('{{ url("supervisor/one") }}', params, function(data) {
                /*optional stuff to do after success */
                // $(".edit-supervisor-name").html(data.name);

                // form
                $("#edit_staff_name").html(`
                    <option value="${data.staff_id}"> ${data.first_name} ${data.last_name}</option>
                `);
                $("#edit_department_name").html(`
                    <option value="${data.department_id}"> ${data.department}</option>
                `);
                $("#edit_supervisor_id").val(supervisor_id);

                // load all staff
                $('#edit_staff_name').select2({
                    allowClear: true,
                    placeholder: "SELECT UNIT",
                    ajax: { 
                        url: "{{ url('supervisor/all/users') }}",
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

                // load all department
                $('#edit_department_name').select2({
                    allowClear: true,
                    placeholder: "SELECT UNIT",
                    ajax: { 
                        url: "{{ url('supervisor/all/department') }}",
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
            });

            $("#edit-supervisor").modal();
        }

        // add department 
        function addSupervisor() {
            $("#add-supervisor-btn").prop('disabled', true);
            var token           = $("#token").val();
            var staff_name      = $("#staff_name").val();
            var department_name = $("#department_name").val();
            var params = {
                _token: token,
                staff_id: staff_name,
                department_id: department_name
            };

            $.post('{{ url("supervisor/create") }}', params, function(data, textStatus, xhr) {
                /*optional stuff to do after success */
                if(data.status == "success"){
                    swal(
                        "Ok",
                        data.message,
                        data.status
                    );
                    $("#add-supervisor").modal('hide');
                    $("#add-supervisor-form")[0].reset();

                    // reload
                    window.location.reload();
                }else{
                    swal(
                        "Oops",
                        data.message,
                        data.status
                    );
                }

                // release btn
                $("#add-department-btn").prop('disabled', false);
            });

            // void form
            return false;
        }

        // delete department
        function delSupervisor(supervisor_id) {
            var token       = $("#token").val();
            var params = {
                _token: token,
                supervisor_id: supervisor_id
            };

            $.post('{{ url("supervisor/delete") }}', params, function(data, textStatus, xhr) {
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

            // void form
            return false;
        }

        // get one department
        function updateSupervisor() {
            $("#edit-supervisor-btn").prop('disabled', true);
            var token       = $("#token").val();
            // form
            var staff_name      = $("#edit_staff_name").val();
            var department_name = $("#edit_department_name").val();
            var supervisor_id   = $("#edit_supervisor_id").val();

            var params = {
                _token: token,
                staff_id: staff_name,
                department_id: department_name,
                supervisor_id: supervisor_id
            };

            $.post('{{ url("supervisor/edit") }}', params, function(data, textStatus, xhr) {
                /*optional stuff to do after success */
                if(data.status == "success"){
                    swal(
                        "Ok",
                        data.message,
                        data.status
                    );
                    $("#edit-supervisor").modal('hide');
                    $("#edit-supervisor-form")[0].reset();

                    // reload
                    window.location.reload();
                }else{
                    swal(
                        "Oops",
                        data.message,
                        data.status
                    );
                }

                // release btn
                $("#edit-supervisor-btn").prop('disabled', false);
            });

            // void form
            return false;
        }

        // auto load dropdown helper
        $(function(){

            // load all staff
            $('#staff_name').select2({
                allowClear: true,
                placeholder: "SELECT UNIT",
                ajax: { 
                    url: "{{ url('supervisor/all/users') }}",
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

            // load all department
            $('#department_name').select2({
                allowClear: true,
                placeholder: "SELECT UNIT",
                ajax: { 
                    url: "{{ url('supervisor/all/department') }}",
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
    </script>
@endsection