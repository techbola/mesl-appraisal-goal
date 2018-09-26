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
                {{ Form::label('GLIDDebit', 'Debit') }}
                {{ Form::select('GLIDDebit', [ '' =>  'Select Customer Account'] + $debit_acct_details->pluck('CUST_ACCT', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'required']) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('GLIDCredit', 'Credit') }}
                {{ Form::select('GLIDCredit', [ '' =>  'Select Customer Account'] + $credit_acct_details->pluck('CUST_ACCT', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'required']) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Amount', 'Amount' ) }}
                {{ Form::text('Amount', null, ['class' => 'form-control smartinput', 'placeholder' => 'Enter Amount', 'required']) }}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('ValueDate', 'Value Date') }}
                <div class="input-group date dp-date-value">
                    {{ Form::text('ValueDate', null, ['class' => 'form-control', 'placeholder' => 'Value Date', 'required']) }}
                    <span class="input-group-addon">
                        <i class="fa fa-calendar">
                        </i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                <label for="">Post Date</label>
                <input type="text" name="PostDate" value="{{$configs->TradeDate}}" class="form-control" readonly="">
            </div>
        </div>
    </div>
</div>


 
<div class="row">
 <!--   <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Bank Slip No', 'BankSlipNo' ) }}
                {{ Form::text('BankSlipNo', null, ['class' => 'form-control', 'placeholder' => 'Enter Bank Slip No']) }}
            </div>
        </div>
    </div> -->

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Narration', 'Narration' ) }}
                {{ Form::textarea('Narration', null, ['class' => 'form-control', 'placeholder' => 'Enter Narration', 'required']) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{ Form::hidden('PostingTypeID', 17, ['class' => 'form-control', 'placeholder' => 'Account Type']) }}

</div>

<div class="row">
    <div class="pull-right">
        {{ Form::hidden('CurrencyID',1) }}
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
            autoclose:true,
            format: 'yyyy-mm-dd'
        };
         $('.dp').datepicker({autoclose:true});
         $('.dp-value-date').datepicker({autoclose:true, format: 'yyyy-mm-dd', startDate: '2018-01-01'});

        var GLIDDebit = $("#GLIDDebit");
    GLIDDebit.change(function(event) {
        event.preventDefault();
        var GLID = $(this).prop('value');
        $.ajax({
            url: '/fetchAccountsForGL',
            type: 'POST',
            data: {GLID: GLID},
        })
        .done(function(data) {
            console.log(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

    });
    })
</script>
@endpush
