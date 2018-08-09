@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
@endpush
@include('errors.list')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('CustomerID', 'Customer') }}
                {{ Form::select('CustomerID', [ '' =>  'Select Customer'] + $customers->pluck('Customer', 'CustomerRef')->toArray(),null, ['class'=> "full-width", 'id'=> "edit_customer_ref", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('AccountTypeID', 'Account Type') }}
                {{ Form::select('AccountTypeID', [ '' =>  'Select Account Type'] + $account_types->pluck('AccountType', 'AccountTypeRef')->toArray(),null, ['class'=> "full-width", 'id'=> "edit_account_ref", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('CurrencyID', 'Currency') }}
                {{ Form::select('CurrencyID', [ '' =>  'Select Currency'] + $currencies->pluck('Currency', 'CurrencyRef')->toArray(),'1', ['class'=> "full-width", 'id'=> "edit_currency", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('BranchID', 'Branch') }}
                {{ Form::select('BranchID', [ '' =>  'Select Branch'] + $branches->pluck('Branch', 'BranchRef')->toArray(),null, ['class'=> "full-width", 'id'=> "edit_branch", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Description', 'Naration') }}
               {{ Form::textarea('Description', null, ['class' => 'form-control', 'id'=> "edit_desc", 'placeholder' => 'Naration']) }}
            </div>
        </div>
    </div>
</div>


<!-- action buttons -->
<div class="row">
    <div class="pull-right">
        <input type="hidden" name="GLRef" id="gl_ref">
        {{ Form::hidden('InputterID',auth()->user()->id) }}
        {{ Form::hidden('ModifierID',auth()->user()->id) }}
        <input type="submit" class="btn btn-info" id="submit_gl_edit">
    </div>
</div>

@push('scripts')
    <script>
        function get_general_ledger_details(id)
        {
            var ref = id;
            $.get('/general_ledger_details/' +ref, function(data, status) {
                console.log(data);
                $('#edit2 select[name="CustomerID"]').val(data.CustomerID).trigger('change');
                $('#edit2 select[name="AccountTypeID"]').val(data.AccountTypeID).trigger('change');
                $('#edit2 select[name="CurrencyID"]').val(data.CurrencyID).trigger('change');
                $('#edit2 select[name="BranchID"]').val(data.BranchID).trigger('change');
                $('#edit2 #edit_desc').val(data.Description);
                $('#edit2 #gl_ref').val(data.GLRef);
            });
        }

        // function  submit_gl_edit()
        // {
        //     alert('Jusus');
        //     return false;
        // }

        $('#submit_gl_edit').click(function(event) {
            $.post('/gl_edit_post', $('#submit_gl_edit_form').serialize(), function(data, status) {
                if (status == 'success') 
                {
                    $('#gl_table_body').html(' ');
                    $.each(data, function(index, val) {
                        $('#gl_table_body').append(`
                    <tr>
                        <td>${val.GLRef }</td>
                         <td>${val.Desc}</td>
                        <td>${val.Currency}</td>
                        <td>${val.BookBalance }</td>
                       
                        <td class="actions">
                            <a href="#" class="btn btn-lg btn-primary" id="edit2" onclick="get_general_ledger_details(${val.GLRef })" data-target="#edit2" data-toggle="modal"  title="">Edit GL</a>
                        </td>
                    </tr>
                            `);
                    });
                }
            });
            $('#edit2').modal('toggle');
             return false;
        });
    </script>
@endpush

