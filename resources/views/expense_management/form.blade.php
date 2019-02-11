@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    @endpush


    {{-- MODALS --}}
        <!-- Create Modal -->
        <div class="modal fade slide-up disable-scroll" id="new_doc" role="dialog" aria-hidden="false">
            <div class="modal-dialog ">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="modal-header clearfix text-left">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                            </button>
                            <h5>Upload New Document</h5>
                        </div>
                        <div class="modal-body">
                            {{-- <form action="{{ route('document_store') }}" method="post" enctype="multipart/form-data"> --}}
                                {{ csrf_field() }}
                                @include('documents.form_for_expense')
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @include('errors.list')

    <div class="row">
        <div class="form-group">
            <span class="expense_process hide" style="padding: 0 10px">
                [<span class="expense_process_child" style="padding: 0 10px"></span>]
            </span>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('RequestListID', 'Request Type') }}
                   
                    
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
                    {{ Form::select('ExpenseCategoryID', ['' => 'Select Request'] + $expense_categories->pluck('ExpenseCategory','ExpenseCategoryRef')->toArray() ,null, ['class' => 'full-width ExpenseCategoryID','data-init-plugin' => "select2", 'data-placeholder' => 'Select Category']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('DepartmentID', 'Department') }}
                    {{ Form::select('DepartmentID', ['' => 'Select Department'] + $departments->pluck('Department','DepartmentRef')->toArray() ,null, ['class' => 'full-width DepartmentID','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('LotDescriptionID', 'Lot Description') }}
                    {{ Form::select('LotDescriptionID', ['' => 'Select Request'] + $lot_descriptions->pluck('LotDescription','LotDescriptionRef')->toArray() ,null, ['class' => 'full-width LotDescriptionID','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('LocationID', 'Location') }}
                    {{ Form::select('LocationID', ['' => 'Select Request'] + $locations->pluck('Location','LocationRef')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Location']) }}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <hr>

    
    @if(auth()->user()->staff->company_department->name == 'Finance & Account')

   {{--  <div class="card-section p-l-5">Finance</div>
    <div class="row">

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('AnnualBudget', 'Annual Budget') }}
                    {{ Form::text('AnnualBudget', null, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('MonthlyPlan', 'Monthly Plan') }}
                    {{ Form::text('MonthlyPlan', null, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('AmountSpent', 'Amount Spent') }}
                    {{ Form::text('AmountSpent', null, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('YTDPlan', 'YTD Plan') }}
                    {{ Form::text('YTDPlan', null, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Balance') }}
                    {{ Form::text('Balance', null, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('MonthlyActual', 'Monthly Actual') }}
                    {{ Form::text('MonthlyActual', null, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div>
    </div>  <hr> --}}

<div class="clearfix"></div>
<div class="card-section p-l-5">Payment Details</div>
    <div class="row"> 
         <div class="col-sm-4 form-group">
            {{ Form::label('BankID', 'Select Bank') }}
            {{ Form::select('BankID', [ '' =>  'Select Bank Account'] + $banks->pluck('BankName', 'BankRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'class'=>"required", 'required']) }}
        </div>


        <div class="form-group col-sm-4">
            <div class="controls">
                {{ Form::label('AccountNo', 'Account Number') }}
                {{ Form::text('AccountNo', null, ['class' => 'form-control', 'placeholder' => '']) }}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('AmountPaid', 'Amount Paid') }}
                    {{ Form::text('AmountPaid', null, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div> <div class="clearfix"></div>

        <div class="col-sm-6 form-group">
            {{ Form::label('GLID', 'Select Expense Account') }}
            {{ Form::select('GLID', [ '' =>  'Select Customer Account'] + $debit_acct_details->pluck('CUST_ACCT', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'class'=>"required", 'required']) }}
        </div>

    </div>

    @endif

    <div class="clearfix"></div> <hr>
   
    @if(auth()->user()->staff->company_department->name == 'Procurement')
    <div class="card-section p-l-5">Procurement Sections</div>
    <div class="row">
         <div class="col-sm-4 form-group">
            {{ Form::label('AmountForApproval', 'Amount For Approval') }}
             {{ Form::text('AmountForApproval', null, ['class' => 'form-control smartinput']) }}
        </div>

        <div class="col-sm-4 form-group">
            {{ Form::label('VendorName', 'Vendor\'s Name') }}
             {{ Form::text('VendorName', null, ['class' => 'form-control', 'placeholder' => 'Enter Vendor Name']) }}
        </div>

        <div class="col-sm-4 form-group">
            {{ Form::label('VendorBankID', 'Vendor Bank') }}
            {{ Form::select('VendorBankID', [ '' =>  'Select Bank Account'] + $banks->pluck('BankName', 'BankRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'class'=>"required", 'required']) }}
        </div>

        <div class="col-sm-4">
            <div class="">
              {{ Form::label('DeliveryDate','Delivery Date', ['class' => 'form-label']) }}
              <div class="input-group date dp">
                {{ Form::text('DeliveryDate', null, ['class' => 'form-control', 'placeholder' => 'Delivery Date']) }}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
        </div> <div class="clearfix"></div>

        <br>
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ContractSummary', 'Contract Summary (Fixed Struc. SLA, Exit Clause etc)') }}
                    {{ Form::textarea('ContractSummary', null, ['class' => 'summernote form-control','rows' => 2, 'placeholder' => 'Description']) }}
                </div>
            </div>
        </div>
    </div>
    <hr>
    @endif

    

    <div class="">
        {{-- <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('attachment[]', 'Attach Files') }}
                    {{ Form::file('attachment[]',  ['class' => '','multiple' => 'multiple']) }}
                </div>
            </div>
        </div> --}} 
        <button class="btn btn-info" data-toggle="modal" data-target="#new_doc" type="button">Upload Documents</button>
    </div> <br>

    {{-- <div class="row">
        <div class="form-group col-sm-12">
            <label>
            {{ Form::checkbox('Conformity') }} By selecting this checkbox, you confirm that the product/service has been delivered to standards and specification.
        </label>
        </div>
    </div> --}}

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
            @if(!isset($show_button))
            {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
            @endif
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
                console.log(e)
                let val = $(e.target).select2().val();
                event.preventDefault();
                $.post('/expense_management/approver_roles', {RequestListID: val}, function(data, textStatus, xhr) {
                    $(".expense_process_child").html(data);
                    $(".expense_process").removeClass('hide');
                });
            });

             $(".ExpenseCategoryID").on('change', function(e) {
                // console.log('stuff')
                 e.preventDefault();
                 let val = $(e.target).select2().val();
                 $('#DepartmentID').empty();
                  $.get('/expense_management/fetch-departments/'+val, function(data) {
                    $('#DepartmentID').append(`<option value="">Select Department</option>`);
                    $.each(data, function(index, val) {
                         $('#DepartmentID').append(`<option value="${val.DepartmentRef}">${val.Department}</option>`);
                    });
                     
                });
             });


             $(".DepartmentID").on('change', function(e) {
                // console.log('stuff')
                 e.preventDefault();
                 let val = $(e.target).select2().val();
                 $('.LotDescriptionID').empty();
                  $.get('/expense_management/fetch-lots/'+val, function(data) {
                    $('.LotDescriptionID').append(`<option value="">Select Lot Description</option>`);
                    $.each(data, function(index, val) {
                         $('.LotDescriptionID').append(`<option value="${val.LotDescriptionRef}">${val.LotDescription}</option>`);
                    });
                     
                });
             });


		}); 

    </script>
    @endpush
</link>