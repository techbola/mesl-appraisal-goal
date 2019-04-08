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
       <div class="card-title">Bank Setup</div>
       <form action="{{route('StoreBank')}}" method="POST" class="form">
           {{ csrf_field() }}
           <div class="row">
                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('BankName', 'Bank name' ) }}
                            {{ Form::text('BankName', null, ['class' => 'form-control', 'placeholder' => 'Add Bank Name', 'required']) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('AccountName', 'Account Name' ) }}
                            {{ Form::text('AccountName', null, ['class' => 'form-control', 'placeholder' => 'Add account name']) }}
                        </div>
                    </div>
                </div>
           </div>

           <div class="row">
                <div class="col-md-4">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('AccountNumber', 'Account Number' ) }}
                            {{ Form::text('AccountNumber', null, ['class' => 'form-control', 'placeholder' => 'Add account number']) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('AccountOfficerName', 'Account Officer' ) }}
                            {{ Form::text('AccountOfficerName', null, ['class' => 'form-control', 'placeholder' => 'Add Account Officer']) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('AccountOfficerPhone', 'Account Officer mobile' ) }}
                            {{ Form::text('AccountOfficerPhone', null, ['class' => 'form-control', 'placeholder' => 'Add Account Officer number' ]) }}
                        </div>
                    </div>
                </div>
           </div>

           <div class="row">
                <div class="col-md-4">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('Branch', 'Branch' ) }}
                            {{ Form::text('Branch', null, ['class' => 'form-control', 'placeholder' => 'Add Branch']) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('SortCode', 'Sort Code' ) }}
                            {{ Form::text('SortCode', null, ['class' => 'form-control', 'placeholder' => 'Add Sort Code']) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="controls">
                        <div class="form-group">
                            {{ Form::label('CurrencyID', 'Currency' ) }}
                            <select name="CurrencyID" class="full-width" data-init-plugin="select2">
                                <option value=" ">Select Currency</option>
                                @foreach($currency as $kudi)
                                    <option value="{{ $kudi->CurrencyRef }}">{{ $kudi->Currency }}</option>
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

    {{-- Bank-table --}}
    <div class="card-box">
            <div class="card-title">List Of Banks</div>
            <table class="table tableWithSearch table-bordered">
                <thead>
                    <th width="10%">Bank Name</th>
                    <th width="10%">Currency</th>
                    <th width="15%">Action</th>
                </thead>
                <tbody>
                    @foreach($bank as $item)
                        <tr>
                            <td>{{$item->BankName}}</td>
                            <td>{{$item->currency->Currency ?? ''}}</td>
                            <td>
                                <button type="button" class="btn btn-xs btn-primary toggler" onclick="editbank({{$item->BankRef}})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i>Edit</button>
                                <a href="#" onclick="deleteItem('{{$item->BankRef}}')" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <hr>
                <div class="modal-body">
                    <form action="" method="POST" id="form-edit">
                        <input type="hidden" id="BankRef" name="BankRef">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('BankName', 'Bank name' ) }}
                                        {{ Form::text('BankName', null, ['class' => 'form-control', 'id' => 'bank_name', 'placeholder' => 'Add Bank Name', 'required']) }}
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('AccountName', 'Account Name' ) }}
                                        {{ Form::text('AccountName', null, ['class' => 'form-control', 'id' => 'account_name', 'placeholder' => 'Add account name']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col-md-4">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('AccountNumber', 'Account Number' ) }}
                                        {{ Form::text('AccountNumber', null, ['class' => 'form-control','id' => 'account_number', 'placeholder' => 'Add account number']) }}
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-4">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('AccountOfficerName', 'Account Officer' ) }}
                                        {{ Form::text('AccountOfficerName', null, ['class' => 'form-control', 'id' => 'account_officer_name', 'placeholder' => 'Add Account Officer']) }}
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-4">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('AccountOfficerPhone', 'Account Officer mobile' ) }}
                                        {{ Form::text('AccountOfficerPhone', null, ['class' => 'form-control', 'id' => 'account_officer_phone', 'placeholder' => 'Add Account Officer number' ]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="row">
                            <div class="col-md-4">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('Branch', 'Branch' ) }}
                                        {{ Form::text('Branch', null, ['class' => 'form-control', 'id' => 'branch_id', 'placeholder' => 'Add Branch']) }}
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-4">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('SortCode', 'Sort Code' ) }}
                                        {{ Form::text('SortCode', null, ['class' => 'form-control', 'id' => 'sort_code', 'placeholder' => 'Add Sort Code']) }}
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-md-4">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('CurrencyID', 'Currency' ) }}
                                        <select name="CurrencyID" class="full-width" data-init-plugin="select2" id="currency_id">
                                            <option value=" ">Select Currency</option>
                                            @foreach($currency as $kudi)
                                                <option value="{{ $kudi->CurrencyRef }}">{{ $kudi->Currency }}</option>
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

    function editbank(id)
    {
            $.get('/edit_bank/'+id, function(data, status) {

            $('#BankRef').val(data.BankRef);

            $('#bank_name').val(data.BankName);

            $('#account_name').val(data.AccountName);

            $('#account_number').val(data.AccountNumber);

            $('#account_officer_name').val(data.AccountOfficerName);

            $('#account_officer_phone').val(data.AccountOfficerPhone);

            $('#brnach_id').val(data.Branch);

            $('#sort_code').val(data.SortCode);

            $('#currency_id').val(data.CurrencyID).trigger('change');
            
            $('#form-edit').prop('action', '/update_bank');
            
        });

    }

    function deleteItem(BankRef){
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
                window.location.href = "/setup/bank_setup/"+BankRef;
            }
        })
    }
</script>


