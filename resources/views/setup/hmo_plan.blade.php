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
       <div class="card-title">HMO Plan Setup</div>
       <form action="{{route('StoreHMOplan')}}" method="POST" class="form">
           {{ csrf_field() }}
           <div class="row">
                <div class="col-md-12">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('HMOPlan', 'HMO Plan' ) }}
                            {{ Form::text('HMOPlan', null, ['class' => 'form-control', 'placeholder' => 'Enter HMO Plan', 'required']) }}
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
                    <th width="10%">HMO PLAN</th>
                    <th width="15%">Action</th>
                </thead>
                <tbody>
                    @foreach($hmoplan as $item)
                        <tr>
                            <td>{{$item->HMOPlan}}</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-primary toggler" onclick="edithmo_plan({{$item->HMOPlanRef}})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i>Edit</button>
                                <a href="#" onclick="deleteItem('{{$item->HMOPlanRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit HMO PLAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <hr>
                <div class="modal-body">
                    <form action="" method="POST" id="form-edit">
                        <input type="hidden" id="HMOPlanRef" name="HMOPlanRef">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('HMOPlan', 'HMO Plan' ) }}
                                        {{ Form::text('HMOPlan', null, ['class' => 'form-control', 'id' => 'hmo_plan', 'placeholder' => 'Edit HMO Plan', 'required']) }}
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

    function edithmo_plan(id)
    {
            $.get('/edit_hmo_plan/'+id, function(data, status) {

            $('#HMOPlanRef').val(data.HMOPlanRef);

            $('#hmo_plan').val(data.HMOPlan);
            
            $('#form-edit').prop('action', '/update_hmo_plan');
            
        });

    }

    function deleteItem(HMOPlanRef){
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
                window.location.href = "/setup/hmo_plan/"+HMOPlanRef;
            }
        })
    }
</script>