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
                {{ Form::label('GLIDDebit', 'Bank Account') }}
                {{-- {{ Form::select('GLIDDebit', [ '' =>  'Select Bank Account'] + $customer_details->pluck('CUST_ACCT', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }} --}}

                <select name="GLIDDebit" id="GLIDDebit" class="full-width" data-init-plugin="select2">
                    @foreach( $customer_details as $c)
                    <option value="{{ $c->GLRef }}">{{ $c->CUST_ACCT }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
            <label for="">Post Date</label>
            <input type="text" name="PostDate" value="{{$configs->TradeDate}}" class="form-control" readonly="">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('ValueDate', 'Value Date') }}
                <div class="input-group date dp">
                    {{ Form::text('ValueDate', null, ['class' => 'form-control', 'placeholder' => 'Value Date']) }}
                    <span class="input-group-addon">
                        <i class="fa fa-calendar">
                        </i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Amount', 'Amount' ) }}
                {{ Form::text('Amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Amount']) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('StaffID', 'Depositor Name' ) }}
                {{ Form::select('StaffID', [ '' =>  'Select Staff Name'] + $staff->pluck('StaffName', 'StaffRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

     <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('BankSlipNo', 'Bank Slip Number' ) }}
                {{ Form::text('BankSlipNo', null, ['class' => 'form-control', 'placeholder' => 'Enter Bank Slip Number']) }}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('CompanySlipNo', 'Company Slip Number' ) }}
                {{ Form::text('CompanySlipNo', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Slip Number']) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Narration', 'Narration' ) }}
                {{ Form::textarea('Narration', null, ['class' => 'form-control', 'placeholder' => 'Enter Narration']) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
{{ Form::hidden('PostingTypeID', 1, ['class' => 'form-control', 'placeholder' => 'Post Date']) }}
    {{ Form::hidden('GLIDCredit', 236, ['class' => 'form-control', 'placeholder' => 'Post Date']) }}
</div>

<div class="row">
    <div class="pull-right">
        {{ Form::hidden('CurrencyID',4) }}
        {{ Form::hidden('InputterID',auth()->user()->id) }}
        {{ Form::hidden('ModifierID',auth()->user()->id) }}
        {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
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

