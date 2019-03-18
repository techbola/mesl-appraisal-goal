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
       <div class="card-title">HMO Setup</div>
       <form action="{{route('StoreHmo')}}" method="POST" class="form">
           {{ csrf_field() }}
           <div class="row">
                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('HMO', 'HMO title' ) }}
                            {{ Form::text('HMO', null, ['class' => 'form-control', 'placeholder' => 'Enter HMO Name', 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('HMOCode', 'HMO Code' ) }}
                            {{ Form::text('HMOCode', null, ['class' => 'form-control', 'placeholder' => 'Enter HMO code', 'required']) }}
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

    {{-- HMO-table --}}
    <div class="card-box">
            <div class="card-title">Entries</div>
            <table class="table tableWithSearch table-bordered">
                <thead>
                    <th width="10%">HMO</th>
                    <th width="7%">HMO CODE</th>
                    <th width="15%">Action</th>
                </thead>
                <tbody>
                    @foreach($hmo as $item)
                        <tr>
                            <td>{{$item->HMO}}</td>
                            <td>{{$item->HMOCode ?? ''}}</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-primary toggler" onclick="edithmo({{$item->HMORef}})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i>Edit</button>
                                <a href="#" onclick="deleteItem('{{$item->HMORef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Doc Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <hr>
                <div class="modal-body">
                    <form action="" method="POST" id="form-edit">
                        <input type="hidden" id="HMORef" name="HMORef">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('HMO', 'HMO Title' ) }}
                                        {{ Form::text('HMO', null, ['class' => 'form-control', 'id' => 'hmo_name', 'placeholder' => 'Edit HMO', 'required']) }}
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('HMOCode', 'HMO Code' ) }}
                                        {{ Form::text('HMOCode', null, ['class' => 'form-control', 'id' => 'hmo_code', 'placeholder' => 'Edit HMO Code', 'required']) }}
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

    function edithmo(id)
    {
            $.get('/edit_hmo/'+id, function(data, status) {

            $('#HMORef').val(data.HMORef);

            $('#hmo_name').val(data.HMO);

            $('#hmo_code').val(data.HMOCode);
            
            $('#form-edit').prop('action', '/update_hmo');
            
        });

    }

    function deleteItem(HMORef){
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
                window.location.href = "/setup/hmo/"+HMORef;
            }
        })
    }
</script>