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
                    Department Listing
                </div>
                <div class="pull-right">
                    <a class="btn btn-info pull-right" href="javascript:void(0);" onclick="showCreateDepartmentForm()">
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
                            Department
                        </th>
                        <th>
                            Option
                        </th>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ ucfirst($department->name) }}</td>
                                <td>
                                    <a class="btn btn-info" href="javascript:void(0);" onclick="showEditModel('{{ $department->id }}')">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <a class="btn btn-info" href="javascript:void(0);" onclick="delDepartment('{{ $department->id }}')">
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

    @include('company_department.modals')
@endsection

@section('scripts')
    <script type="text/javascript">
        // show department form
        function showCreateDepartmentForm() {
            $("#add-department").modal();
        }

        // update department
        function showEditModel(department_id) {
            // body...
            var params = {
                department_id: department_id
            }

            $.get('{{ url("department/one") }}', params, function(data) {
                /*optional stuff to do after success */
                $(".edit-department-name").html(data.name);

                // form
                $("#edit_department_name").val(data.name);
                $("#edit_department_id").val(data.id);
            });

            $("#edit-department").modal();
        }

        // add department 
        function addDepartment() {
            $("#add-department-btn").prop('disabled', true);
            var token       = $("#token").val();
            var department  = $("#department_name").val();
            var params = {
                _token: token,
                department: department
            };

            $.post('{{ url("department/create") }}', params, function(data, textStatus, xhr) {
                /*optional stuff to do after success */
                if(data.status == "success"){
                    swal(
                        "Ok",
                        data.message,
                        data.status
                    );
                    $("#add-department").modal('hide');
                    $("#add-department-form")[0].reset();

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
        function delDepartment(department_id) {
            var token       = $("#token").val();
            var department  = $("#department_name").val();
            var params = {
                _token: token,
                department_id: department_id
            };

            $.post('{{ url("department/delete") }}', params, function(data, textStatus, xhr) {
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
        function updateDepartment() {
            $("#edit-department-btn").prop('disabled', true);
            var token       = $("#token").val();
            // form
            var department_name = $("#edit_department_name").val();
            var department_id   = $("#edit_department_id").val();
            var params = {
                _token: token,
                department_name: department_name,
                department_id: department_id
            };

            $.post('{{ url("department/edit") }}', params, function(data, textStatus, xhr) {
                /*optional stuff to do after success */
                if(data.status == "success"){
                    swal(
                        "Ok",
                        data.message,
                        data.status
                    );
                    $("#edit-department").modal('hide');
                    $("#edit-department-form")[0].reset();

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
                $("#edit-department-btn").prop('disabled', false);
            });

            // void form
            return false;
        }
    </script>
@endsection