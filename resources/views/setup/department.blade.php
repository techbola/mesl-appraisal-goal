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
       <div class="card-title">Locatoion Setup</div>
        <form action="{{ route('StoreDept') }}" method="POST" class="form">
           {{ csrf_field() }}
           <div class="row">
                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('Department', 'Department' ) }}
                            {{ Form::text('Department', null, ['class' => 'form-control', 'placeholder' => 'Add Department', 'required']) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('CompanyID', 'Company' ) }}
                            <select name="CompanyID" class="form-control select2" data-init-plugin="select2">
                                @foreach($company as $comp)
                                    <option value="{{ $comp->CompanyRef }}">{{ $comp->Company }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
           </div>

           <div class="row">
                <div class="col-md-4">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('SubsidiaryID', 'Subsidiary' ) }}
                            <select name="SubsidiaryID" class="form-control select2" data-init-plugin="select2">
                                @foreach($subsidiary as $sub)
                                    <option value="{{ $sub->SubsidiaryRef }}">{{ $sub->Subsidiary }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('divisionID', 'Division' ) }}
                            <select name="divisionID" class="form-control select2" data-init-plugin="select2">
                                @foreach($division as $div)
                                    <option value="{{ $div->DivisionRef }}">{{ $div->Division }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('GroupID', 'Group' ) }}
                            <select name="GroupID" class="form-control select2" data-init-plugin="select2">
                                @foreach($group as $grp)
                                    <option value="{{ $grp->GroupRef }}">{{ $grp->GroupName }}</option>
                                @endforeach
                            </select>
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

    {{-- Location-table --}}
    <div class="card-box">
        <div class="card-title">Entries</div>
        <table class="table tableWithSearch table-bordered">
            <thead>
                <th width="10%">Department</th>
                <th width="15%">Action</th>
            </thead>
            <tbody>
                @foreach($department as $item)
                    <tr>
                        <td>{{$item->Department}}</td>
                        <td>
                            <button type="button" class="btn btn-xs btn-primary toggler" onclick="edit_dept({{$item->DepartmentRef}})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i>Edit</button>
                            <a href="#" onclick="deleteItem('{{$item->DepartmentRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Office Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <hr>
                <div class="modal-body">
                    <form action="" method="POST" id="form-edit">
                        <input type="hidden" id="DepartmentRef" name="DepartmentRef">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('Department', 'Department' ) }}
                                        {{ Form::text('Department', null, ['class' => 'form-control', 'id' => 'department_id', 'placeholder' => 'Edit Department', 'required']) }}
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('CompanyID', 'Company ID' ) }}
                                        <select name="CompanyID" id="company_id" class="form-control">
                                            @foreach($company as $comp)
                                                <option value="{{ $comp->CompanyRef }}">{{ $comp->Company }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                       </div>

                       <div class="row">
                            <div class="col-md-4">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('SubsidiaryID', 'Subsidiary' ) }}
                                        <select name="SubsidiaryID" id="subsidiary_id" class="form-control select2" data-init-plugin="select2">
                                            @foreach($subsidiary as $sub)
                                                <option value="{{ $sub->SubsidiaryRef }}">{{ $sub->Subsidiary }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('DivisionID', 'Division' ) }}
                                        <select name="DivisionID" id="division_id" class="form-control select2" data-init-plugin="select2">
                                            @foreach($division as $div)
                                                <option value="{{ $div->DivisionRef }}">{{ $div->Division }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('GroupID', 'Group' ) }}
                                        <select name="GroupID" id="group_id" class="form-control select2" data-init-plugin="select2">
                                            @foreach($group as $grp)
                                                <option value="{{ $grp->GroupRef }}">{{ $grp->GroupName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                       </div>
                
                        <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-info" type="submit">Update</button>
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

    function edit_dept(id)
    {
        $.get('/edit_department/'+id, function(data, status) {

            $('#DepartmentRef').val(data.DepartmentRef);

            $('#department_id').val(data.Department);

            $('#company_id').val(data.CompanyID).trigger('change');

            $('#subsidiary_id').val(data.SubsidiaryID).trigger('change');

            $('#division_id').val(data.DivisionID).trigger('change');

            $('#group_id').val(data.GroupID).trigger('change');
            
            $('#form-edit').prop('action', '/update_department');
            
        });

    }

    function deleteItem(DepartmentRef){
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
                window.location.href = "/setup/department/"+DepartmentRef;
            }
        })
    }
</script>