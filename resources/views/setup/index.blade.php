{{-- @extends('layouts.master')

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
       <div class="card-title">System Setup</div>
       
       <form action="" class="form">
           {{ csrf_field() }}
           <div class="row">
               <div class="col-md-6">
                <div class="controls">
                    <div class="form-group">
                        {{ Form::label('Setup', 'Setup Name' ) }}
                        {{ Form::text('Setup', null, ['class' => 'form-control', 'placeholder' => 'Add New Setup', 'required']) }}
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

    <div class="card-box">
        <div class="card-title">Entries</div>
        <table class="table tableWithSearch table-bordered">
            <thead>
                <th width="10%">Setup Type</th>
                <th width="15%">Action</th>
            </thead>
            <tbody>
                @foreach($setup as $item)
                    <tr>
                        <td>{{$item->S ?? ''}}</td>
                        <td>
                            <button type="button" class="btn btn-xs btn-primary toggler" onclick="editstaff_type({{$item->StaffTypeRef}})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i>Edit</button>
                            <a href="#" onclick="deleteItem('{{$item->StaffTypeRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
    </div>


@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>

<script>

    
</script> --}}