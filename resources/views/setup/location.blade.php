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
       <div class="card-title">Locatoion Setup</div>
       <form action="{{route('StoreLocation')}}" method="POST" class="form">
           {{ csrf_field() }}
           <div class="row">
                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('Location', 'Office Location' ) }}
                            {{ Form::text('Location', null, ['class' => 'form-control', 'placeholder' => 'Enter Office Location', 'required']) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('CompanyID', 'Company ID' ) }}
                            {{ Form::text('CompanyID', null, ['class' => 'form-control', 'placeholder' => 'Enter Company ID']) }}
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
                    <th width="10%">Office Location</th>
                    <th width="10%">CompanyID</th>
                    <th width="15%">Action</th>
                </thead>
                <tbody>
                    @foreach($location as $item)
                        <tr>
                            <td>{{$item->Location}}</td>
                            <td>{{$item->CompanyID ?? ''}}</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-primary toggler" onclick="edit_office_location({{$item->LocationRef}})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i>Edit</button>
                                <a href="#" onclick="deleteItem('{{$item->LocationRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                        <input type="hidden" id="LocationRef" name="LocationRef">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('Location', 'Office Location' ) }}
                                        {{ Form::text('Location', null, ['class' => 'form-control', 'id' => 'location_id', 'placeholder' => 'Edit Office Location', 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('CompanyID', 'Company ID' ) }}
                                        {{ Form::text('CompanyID', null, ['class' => 'form-control', 'id' => 'company_id', 'placeholder' => 'Edit Company ID']) }}
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

    function edit_office_location(id)
    {
        $.get('/edit_location/'+id, function(data, status) {
            console.log(data);

            $('#LocationRef').val(data.LocationRef);

            $('#location_id').val(data.Location);

            $('#company_id').val(data.CompanyID);
            
            $('#form-edit').prop('action', '/update_location');
            
        });

    }

    function deleteItem(LocationRef){
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
                window.location.href = "/setup/location/"+LocationRef;
            }
        })
    }
</script>