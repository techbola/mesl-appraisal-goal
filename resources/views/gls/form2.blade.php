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
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('CustomerID', 'Customer') }}
                {{ Form::select('CustomerID', [ '' =>  'Select Customer'] + $customer_details->pluck('CUST_ACCT', 'CustomerRef')->toArray(),null, ['class'=> "full-width", 'id' => 'mySelect', 'onchange' =>'myFunction()', 'data-init-plugin' => "select2"]) }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('BranchID', 'Branch') }}
                {{ Form::select('BranchID', [ '' =>  'Select Branch'] + $branches->pluck('Branch', 'BranchRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Account Officer' ) }}
                {{ Form::select('StaffID', [ '' =>  'Select Staff'] + $staff->pluck('StaffName', 'StaffRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('LoanInterestRate', 'Interest Rate (%)') }}
                {{ Form::text('LoanInterestRate', null, ['class' => 'form-control', 'placeholder' => 'Loan Interest Rate']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('FrequencyID', 'Frequency') }}
                {{ Form::select('FrequencyID', [ '' =>  'Select Frequency'] + $frequencies->pluck('Frequency', 'FrequencyRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
              <div class="controls">
                  {{ Form::label('LoanTypeID', 'Loan Type') }}
              {{ Form::select('LoanTypeID', [ '' =>  'Select Loan Type'] + $loan_types->pluck('LoanType', 'LoanTypeRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
              </div>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Booking Date' ) }}
                    <div class="input-group date dp">
                        {{ Form::text('LoanDate', null, ['class' => 'form-control', 'placeholder' => 'Loan Date']) }}
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
                    {{ Form::label('Amount' ) }}
                {{ Form::text('LoanAmount', null, ['class' => 'form-control', 'placeholder' => 'Enter Loan Amount']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('First Payment Date' ) }}
                    <div class="input-group date dp">
                        {{ Form::text('LoanFirstPymntDate', null, ['class' => 'form-control', 'placeholder' => 'First Payment Date']) }}
                        <span class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Management Fee (%)' ) }}
                {{ Form::text('LoanManagementFee', null, ['class' => 'form-control', 'placeholder' => 'Enter Managing Fee']) }}
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Processing Fee (%)' ) }}
                {{ Form::text('LoanProcessingFee', null, ['class' => 'form-control', 'placeholder' => 'Enter Processing Fee']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Application Fee (&#8358;)' ) }}
                {{ Form::text('LoanApplicationFee', null, ['class' => 'form-control', 'placeholder' => 'Enter Loan Application Fee']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Repayment Type ' ) }}
                        {{ Form::select('LoanRePymntTypeID', [ '' =>  'Select Loan RePayment Type'] + $loanrepaymenttype->pluck('LoanRePymntType', 'LoanRePymntTypeRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Number Of Payment', 'Duration') }}
                    {{ Form::text('LoanNoOfPymnt', null, ['class' => 'form-control', 'placeholder' => 'Loan No Of Payment']) }}
                </div>
            </div>
        </div>
    </div>
</link>
<div>
    {{ Form::hidden('BeneficiaryGLID', null, ['class' => 'form-control', 'id' =>'demo']) }}
       {{ Form::hidden('AccountTypeID', 2, ['class' => 'form-control']) }}
       {{ Form::hidden('CurrencyID', 1, ['class' => 'form-control']) }}
</div>
<!-- action buttons -->
<div class="row">
    <div class="pull-right">
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
<script>
    function myFunction() {
        var x = document.getElementById("mySelect").value;
        document.getElementById("demo").value = x;
    }
</script>
@endpush
