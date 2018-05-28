@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
<style>
    textarea {
        max-height: 50px;
        resize: none;
    }
</style>
@endpush
@include('errors.list')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('CustomerID', 'Customer') }}
                {{ Form::select('CustomerID', [ '' =>  'Select Customer'] + $customers->pluck('Customer', 'CustomerRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('AccountTypeID', 'Account Type') }}
                {{ Form::select('AccountTypeID', [ '' =>  'Select Account Type'] + $account_types->pluck('AccountType', 'AccountTypeRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('CurrencyID', 'Currency') }}
                {{ Form::select('CurrencyID', [ '' =>  'Select Currency'] + $currencies->pluck('Currency', 'CurrencyRef')->toArray(),'1', ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('BranchID', 'Branch') }}
                {{ Form::select('BranchID', [ '' =>  'Select Branch'] + $branches->pluck('Branch', 'BranchRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Description', 'Naration') }}
               {{ Form::textarea('Description', null, ['class' => 'form-control', 'placeholder' => 'Naration']) }}
            </div>
        </div>
    </div>
</div>


<!-- action buttons -->
<div class="row">
    <div class="pull-right">
        {{ Form::hidden('InputterID',auth()->user()->id) }}
        {{ Form::hidden('ModifierID',auth()->user()->id) }}
        {{ Form::submit( $buttonText, [ 'class' => 'btn btn-info' ]) }}
        {{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
    </div>
</div>
@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>
<script>
    $(function(){
        var options = {
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        };
        $('.dp').datepicker({autoclose:true});
    })
</script>
@endpush
