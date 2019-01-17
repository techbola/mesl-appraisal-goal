@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    @endpush
    @include('errors.list')
    <div class="row">

        <div class="col-sm-6">
            <div class="form-group">
                
                <div class="controls">
                    {{ Form::label('RequestListID', 'Request Type') }}
                    <span class="expense_process hide" style="padding: 0 10px; padding: 0 10px;position: absolute;top: -9px;">
                        [<span class="expense_process_child" style="padding: 0 10px"></span>]
                    </span>
                    
                    {{ Form::select('RequestListID', ['' => 'Select Request'] + $request_list->pluck('Request','RequestListRef')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request']) }}
                </div>
            </div>
        </div>  
        
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Description', 'Description') }}
                    {{ Form::text('Description', null, ['class' => 'form-control', 'placeholder' => 'e.g Finance Project']) }}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ExpenseCategoryID ', 'Expense Category') }}
                    {{ Form::select('ExpenseCategoryID', ['' => 'Select Request'] + $expense_categories->pluck('ExpenseCategory','ExpenseCategoryRef')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Category']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('DepartmentID', 'Department') }}
                    {{ Form::select('DepartmentID', ['' => 'Select Department'] + $departments->pluck('Department','DepartmentRef')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('LotDescriptionID', 'Lot Description') }}
                    {{ Form::select('LotDescriptionID', ['' => 'Select Request'] + $lot_descriptions->pluck('LotDescription','LotDescriptionRef')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('LocationID', 'Lot Description') }}
                    {{ Form::select('LocationID', ['' => 'Select Request'] + $locations->pluck('Location','LocationRef')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Location']) }}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('AnnualBudget', 'Annual Budget') }}
                    {{ Form::text('AnnualBudget', 0, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('MonthlyPlan', 'Monthly Plan') }}
                    {{ Form::text('MonthlyPlan', 0, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('AmountSpent', 'Amount Spent') }}
                    {{ Form::text('AmountSpent', 0, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('YTDPlan', 'YTD Plan') }}
                    {{ Form::text('YTDPlan', 0, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Balance') }}
                    {{ Form::text('Balance', 0, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('MonthlyActual', 'Monthly Actual') }}
                    {{ Form::text('MonthlyActual', 0, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div>
    </div>  <hr>

    <div class="row">
         <div class="col-sm-6 form-group">
            {{ Form::label('BankID', 'Select Bank') }}
            {{ Form::select('BankID', [ '' =>  'Select Bank Account'] + $banks->pluck('BankName', 'BankRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'class'=>"required", 'required']) }}
        </div>
        <div class="col-sm-6 form-group">
            {{ Form::label('GLID', 'Select Expense Account') }}
            {{ Form::select('GLID', [ '' =>  'Select Customer Account'] + $debit_acct_details->pluck('CUST_ACCT', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'class'=>"required", 'required']) }}
        </div>
    </div>

    <div class="clearfix"></div>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('attachment[]', 'Attach Files') }}
                    {{ Form::file('attachment[]',  ['class' => '','multiple' => 'multiple']) }}
                </div>
            </div>
        </div> 
    </div>

    <div class="row">
        <div class="form-group col-sm-12">
            <label>
            {{ Form::checkbox('Conformity') }} By selecting this checkbox, you confirm that the product/service has been delivered to standards and specification.
        </label>
        </div>
    </div>

    <div class="row">    
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Comment', 'Comments') }}
                    {{ Form::textarea('Comment', null, ['class' => 'summernote form-control','rows' => 2, 'placeholder' => 'Description']) }}
                </div>
            </div>
        </div>
    </div>

    

{{-- <hr> --}}


    <!-- action buttons -->
    <div class="row">
        <div class="pull-right">
            {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
				{{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    {{-- <select class="js-data-example-ajax"></select> --}}
    <script>
        $(function(){
			$('.dp').datepicker();

             $("#RequestListID").on('change', function(e) {
                let val = $(e.target).select2().val();
                event.preventDefault();
                $.post('/expense_management/approver_roles', {RequestListID: val}, function(data, textStatus, xhr) {
                    $(".expense_process_child").html(data);
                    $(".expense_process").removeClass('hide');
                });
            });
		});   


    </script>
    @endpush
</link>