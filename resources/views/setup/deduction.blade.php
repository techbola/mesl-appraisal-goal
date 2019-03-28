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
       <div class="card-title">Deduction Item Setup</div>
       <form action="{{route('StoreDeduction')}}" method="POST" class="form">
           {{ csrf_field() }}
           <div class="row">
                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('DeductionItem', 'Deduction Item' ) }}
                            {{ Form::text('DeductionItem', null, ['class' => 'form-control', 'placeholder' => 'Add Deduction Item', 'required']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('DeductionSign', 'Deduction Sign' ) }}
                            {{ Form::text('DeductionSign', null, ['class' => 'form-control', 'placeholder' => 'Add Deduction Sign', 'required']) }}
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
            <div class="card-title">List Of Deductions</div>
            <table class="table tableWithSearch table-bordered">
                <thead>
                    <th width="10%">Deduction Item</th>
                    <th width="10%">Deduction Sign</th>
                    <th width="15%">Action</th>
                </thead>
                <tbody>
                    @foreach($deduction as $item)
                        <tr>
                            <td>{{$item->DeductionItem}}</td>
                            <td>{{$item->DeductionSign}}</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-primary toggler" onclick="edit_deduction_item({{$item->DeductionItemRef}})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i>Edit</button>
                                <a href="#" onclick="deleteItem('{{$item->DeductionItemRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Deduction Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <hr>
                <div class="modal-body">
                    <form action="" method="POST" id="form-edit">
                        <input type="hidden" id="DeductionItemRef" name="DeductionItemRef">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('DeductionItem', 'Deduction Item' ) }}
                                        {{ Form::text('DeductionItem', null, ['class' => 'form-control', 'id' => 'deduction_item', 'placeholder' => 'Edit Deduction Item', 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('DeductionSign', 'Deduction Sign' ) }}
                                        {{ Form::text('DeductionSign', null, ['class' => 'form-control', 'id' => 'deduction_sign', 'placeholder' => 'Edit Deduction Sign', 'required']) }}
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

    function edit_deduction_item(id)
    {
        $.get('/edit_deduction/'+id, function(data, status) {
            console.log(data);

            $('#DeductionItemRef').val(data.DeductionItemRef);

            $('#deduction_item').val(data.DeductionItem);

            $('#deduction_sign').val(data.DeductionSign);
            
            $('#form-edit').prop('action', '/update_deduction');
            
        });

    }

    function deleteItem(DeductionItemRef){
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
                window.location.href = "/setup/deduction/"+DeductionItemRef;
            }
        })
    }
</script>