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

    /* table th, table td {
        width: 80px  !important;
    } */
	</style>
@endpush

@section('content')

    {{-- Leave-table --}}
    <div class="card-box">
            <div class="card-title">Leave Days</div>
            <table class="table nowrap tableWithSearch table-bordered" id="leave-days-table">
                <thead>
                    <th width="15%">Staff</th>
                    <th width="15%">Annual Leave Days</th>
                    <th width="15%">Maternity Leave Days</th>
                    <th width="15%">Sick Leave Days</th>
                    <th width="15%">Paternity Leave Days</th>
                    <th width="15%">Action</th>
                </thead>
                <tbody>
                    @foreach($staff as $item)
                        <tr>
                            <td>{{$item->FullName}}</td>
                            <td>{{$item->LeaveDays}}</td>
                            <td>{{$item->MaternityLeaveDays}}</td>
                            <td>{{$item->SickLeaveDays}}</td>
                            <td>{{$item->PaternityLeaveDays}}</td>
                            <td>
                            <button type="button" class="btn btn-xs btn-primary toggler" data-id="{{ $item->StaffRef }}" onclick="show_days({{$item->StaffRef}})" data-toggle="modal" data-target="#leave_modal"><i class="fa fa-edit"></i>Edit</button>
                                {{-- <a href="#" onclick="deleteItem('{{$item->HMORef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
    <div class="modal fade" id="leave_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Leave Days</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <hr>
                <div class="modal-body">
                    <form action="" method="POST" id="form-leave">
                        <input type="hidden" id="StaffRef" name="StaffRef">
                        {{ csrf_field() }}
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="controls">
                                        <div class="form-group">
                                            {{ Form::label('LeaveDays', 'Annual Leave Days' ) }}
                                            {{ Form::text('LeaveDays', null, ['class' => 'form-control', 'id'=>'annual', 'placeholder' => 'Add days']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('MaternityLeaveDays', 'Maternity Leave Days' ) }}
                                        {{ Form::text('MaternityLeaveDays', null, ['class' => 'form-control', 'id'=>'sick', 'placeholder' => 'Add days']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('SickLeaveDays', 'Sick Leave Days' ) }}
                                        {{ Form::text('SickLeaveDays', null, ['class' => 'form-control', 'id'=>'mat', 'placeholder' => 'Add days']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('PaternityLeaveDays', 'Paternity Leave Days' ) }}
                                        {{ Form::text('PaternityLeaveDays', null, ['class' => 'form-control', 'id'=>'pat', 'placeholder' => 'Add days']) }}
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
    // function editleave(id)
    // {
    //         $.get('/edit_leave_days/'+id, function(data, status) {


    //         $('#form-edit').prop('action', '/update_leave_days');

    //     });

   // }
</script>

<script>
    function show_days(ref) {
            $.get(`/get-days-by-id/${ref}`, function(data){
                console.log(data.data)

                $('#StaffRef').val(data.data.StaffRef);

                $('#annual').val(data.data.LeaveDays);

                $('#sick').val(data.data.SickLeaveDays);

                $('#mat').val(data.data.MaternityLeaveDays);

                $('#pat').val(data.data.PaternityLeaveDays);

                $('#form-leave').prop('action', '/update_leave_days');

            });

        }
</script>
