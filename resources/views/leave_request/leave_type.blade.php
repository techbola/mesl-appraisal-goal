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

    <div class="card-box">
        <div class="card-title">Leave Type</div>

        <form action="{{ route('StoreLeaveType') }}" method="POST" class="form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('LeaveType', 'Leave Type' ) }}
                            {{ Form::text('LeaveType', null, ['class' => 'form-control', 'placeholder' => 'Enter Leave Type', 'required']) }}
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

    {{-- Table --}}
    <div class="card-box">
        <div class="card-title">Entries</div>
        <table class="table tableWithSearch table-bordered">
            <thead>
                <th width="10%">Leave Type</th>
                <th width="15%">Action</th>
            </thead>
            <tbody>
                @foreach($leavetypes as $leavetype)
                    <tr>
                        <td>{{$leavetype->LeaveType}}</td>
                        <td>
                            <button type="button" class="btn btn-xs btn-primary toggler" onclick="edit_leavetype( {{$leavetype->LeaveTypeRef}})" data-toggle="modal" data-target="#exampleModal">Edit</button>
                            <a href="#" onclick="deleteItem('{{$leavetype->LeaveTypeRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
              <h5 class="modal-title" id="exampleModalLabel">Edit Leave Type</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <hr>
            <div class="modal-body">
                <form action="" method="POST" id="form-edit">
                    <input type="hidden" id="LeaveTypeRef" name="LeaveTypeRef">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="controls">
                                <div class="form-group">
                                    {{ Form::label('LeaveType', 'Leave Type' ) }}
                                    {{ Form::text('LeaveType', null, ['class' => 'form-control', 'id' => 'leave_type', 'placeholder' => 'Edit Leave Type', 'required']) }}
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
          </div>
        </div>
      </div>



@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>

<script>

    function edit_leavetype(id)
    {
            $.get('/edit_leave_type/'+id, function(data, status) {

            $('#LeaveTypeRef').val(data.LeaveTypeRef);

            $('#leave_type').val(data.LeaveType);

            $('#form-edit').prop('action', '/update_leave_type');
            
        });

    }

    // delete alert function
    function deleteItem(LeaveTypeRef){
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
                window.location.href = "/leave_request/leave_type/"+LeaveTypeRef;
            }
        })
    }
</script>