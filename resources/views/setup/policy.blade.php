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
       <div class="card-title">Policy Setup</div>
       <form action="{{route('StorePolicy')}}" method="POST" class="form">
           {{ csrf_field() }}
           <div class="row">
                <div class="col-md-12">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('Policy', 'Policy' ) }}
                            {{ Form::text('Policy', null, ['class' => 'form-control', 'placeholder' => 'Add Policy', 'required']) }}
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
            <div class="card-title">List Of Policies</div>
            <table class="table tableWithSearch table-bordered">
                <thead>
                    <th width="10%">Policy</th>
                    <th width="15%">Action</th>
                </thead>
                <tbody>
                    @foreach($policy as $item)
                        <tr>
                            <td>{{$item->Policy}}</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-primary toggler" onclick="edit_policy({{$item->PolicyRef}})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i>Edit</button>
                                <a href="#" onclick="deleteItem('{{$item->PolicyRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <hr>
                <div class="modal-body">
                    <form action="" method="POST" id="form-edit">
                        <input type="hidden" id="PolicyRef" name="PolicyRef">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('Policy', 'Policy' ) }}
                                        {{ Form::text('Policy', null, ['class' => 'form-control', 'id' => 'policy_id', 'placeholder' => 'Edit Policy', 'required']) }}
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

    function edit_policy(id)
    {
        $.get('/edit_policy/'+id, function(data, status) {
            console.log(data);

            $('#PolicyRef').val(data.PolicyRef);

            $('#policy_id').val(data.Policy);
            
            $('#form-edit').prop('action', '/update_policy');
            
        });

    }

    function deleteItem(PolicyRef){
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
                window.location.href = "/setup/policy/"+PolicyRef;
            }
        })
    }
</script>