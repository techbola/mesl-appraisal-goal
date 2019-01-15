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
                            No. of Employee's
                        </th>
                        <th>
                            Head of Department
                        </th>
                        <th>
                            Option
                        </th>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ ucfirst($department['name']) }}</td>
                                <td>
                                    {{ $department['total_employee'] }}
                                </td>
                                <td>
                                    <a href="javascript:void(0);" onclick="showAssignHeadofDepartmentModal('{{ ucfirst($department['name']) }}', {{ $department['id'] }})">
                                        <i class="fa fa-user"></i> Assign
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="showEditModel('{{ $department['id'] }}')">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="delDepartment('{{ $department['id'] }}')">
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

        // show assign head of department modal
        function showAssignHeadofDepartmentModal(department_name, department_id) {
            $(".edit-head-of-department-name").html(department_name);
            $("#add-head-of-department").modal();
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
              }
            })
            
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

        // auto load dropdown helper
        $(function(){
            // load all staff
            $('#edit_head_of_department_name').select2({
                allowClear: true,
                placeholder: "Select Employee",
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
        })

        // assign head of department
        function assignHeadOfDepartment() {
            swal(
                "oops",
                "Access Denied!",
                "error"
            );

            // return
            return false;
        }
    </script>
@endsection