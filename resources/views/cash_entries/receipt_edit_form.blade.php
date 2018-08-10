<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('GLIDDebit', 'Debit') }}
                {{ Form::select('GLIDDebit', [ '' =>  'Select Customer Account'] + $debit_acct_details->pluck('CUST_ACCT', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('GLIDCredit', 'Credit') }}
                {{ Form::select('GLIDCredit', [ '' =>  'Select Customer Account'] + $credit_acct_details->pluck('CUST_ACCT', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Amount', 'Amount' ) }}
                {{ Form::text('Amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Amount']) }}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
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
    <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Bank Slip No', 'BankSlipNo' ) }}
                {{ Form::text('BankSlipNo', null, ['class' => 'form-control', 'placeholder' => 'Enter Bank Slip No']) }}
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Narration', 'Narration' ) }}
                {{ Form::textarea('Narration', null, ['class' => 'form-control', 'placeholder' => 'Enter Narration', 'rows'=>'1']) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{ Form::hidden('PostingTypeID', 14, ['class' => 'form-control', 'placeholder' => 'Account Type']) }}

</div>

        {{ Form::hidden('CurrencyID',1) }}
        {{ Form::hidden('InputterID',auth()->user()->id) }}
        {{ Form::hidden('ModifierID',auth()->user()->id) }}
        {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete pull-right'  ]) }}