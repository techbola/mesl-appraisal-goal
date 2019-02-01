@extends('layouts.master')

@section('content')
    <style type="text/css">
        .format-passport {
            border: 3px solid #999;
            border-radius: 5px;
            margin-bottom: 5px;
        }
    </style>
    <div class="panel panel-transparent" style="padding: 0px;">
        <div class="panel-body" style="padding: 0px;">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('bottom-content')
    <div class="container-fluid container-fixed-lg bg-white">
        <!-- START PANEL -->
        <div class="panel panel-transparent">
            <div class="panel-heading">
                <div class="panel-title">
                    ID Card Request Listing
                </div>
                <div class="pull-right">
                    <a class="btn btn-info pull-right" href="javascript:void(0);" onclick="showCreateIdentityCardModal()">
                        <i class="fa fa-plus"></i> Request New ID Card
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
                            Employee's Name
                        </th>
                        <th>
                            ID Card No
                        </th>
                        <th>
                            ID Request Date
                        </th>
                        <th>
                            Department
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            More
                        </th>
                        <th>
                            Option
                        </th>
                    </thead>
                    <tbody>
                        @if($all_idcard_request !== null)
                            <tr>
                                <td>{{ $all_idcard_request['employee_name'] }}</td>
                                <td>{{ $all_idcard_request['staff_id_number'] }}</td>
                                <td>{{ $all_idcard_request['card_request_date'] }}</td>
                                <td>{{ $all_idcard_request['department_name'] }}</td>
                                <td>Pending</td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="viewCardRequest('{{json_encode($all_idcard_request)}}')">
                                        <i class="fa fa-user"></i> view 
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="editCardRequest('{{ $all_idcard_request['id'] }}')">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="delCardRequest('{{ $all_idcard_request['id'] }}')">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END PANEL -->
    </div>

    @include('identity_card.modals')
@endsection

@section('scripts')
    {{-- Alert for Redirect Post --}}
    @if(session('success'))
         <script type="text/javascript">
            swal(
                "Ok",
                {{ session('success') }},
                "success"
            );
        </script>
    @endif

    @if(session('error'))
        <script type="text/javascript">
            swal(
                "Oops",
                {{ session('error') }},
                "error"
            );
        </script>
    @endif

    <script type="text/javascript">
        // show department form
        function showCreateIdentityCardModal() {
            showStaffInfo({{ Auth::user()->id }});
            showStaffDepartment({{ Auth::user()->id }});

            $("#add-identity-card-modal").modal();
        }

        // show staff information
        function showStaffInfo(staff_id) {
            // body...
            var params = {staff_id: staff_id};
            $.get('{{ url("indentity/employee/info") }}', params, function(data) {
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
                }
            });
        }

        // show staff department
        function showStaffDepartment(staff_id) {
            var params = {
                staff_id: staff_id
            };
            // load office location
            $.get('{{ url("indentity/department/info") }}', params, function(data) {
                if(data.status == "error"){
                    swal(
                        "Oops",
                        data.message,
                        data.status
                    );
                }else{
                    $("#department_name").html(`
                        <option value="${data.department_id}">${data.department_name}</option>
                    `);
                }
            });
        }

        // update card request
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

        // delete department
        function delCardRequest(card_request_id) {
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
                var params = {
                    _token: token,
                    card_request_id: card_request_id
                };

                $.post('{{ url("identity/card/delete") }}', params, function(data, textStatus, xhr) {
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

        // view card request
        function viewCardRequest(payload) {
            // console.log(payload);
            var payload = JSON.parse(payload);

            var approved;
            var status;
            if(payload.first_approver_status == "1"){
                approved = "success";
                status = "Approved!";
            }else{
                approved = "danger";
                status = "Pending!"
            }

            $(".view-card-passport-image").html(`
                <img class="format-passport" src="{{asset('images/passport_images')}}/${payload.passport_path}" width="150" height="180" />
                <br />
            `);
            $(".view-card-holder-name").html(payload.employee_name);
            $(".view-card-holder-department").html(payload.department_name);
            $(".view-card-holder-number").html(payload.staff_id_number);
            $(".view-card-date-requested").html(payload.card_request_date);
            $(".view-card-date-expected").html(payload.expected_request_date);
            $(".view-card-approvers-name").html(`
                <a href="#" class="btn btn-${approved} btn-sm">
                    <i class="fa fa-user"></i> ${payload.first_approver_name} -- ${status}
                </a> 
            `);
            $("#view-card-request-modal").modal();
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

        // read selected image
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#preview_passport_image").html(`
                    <img class="format-passport" src="${e.target.result}" width="150" height="180" />
                    <br />
                `)
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
    </script>
@endsection