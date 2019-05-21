@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    <style>
        .form-add-more{
            width: 20px;
            height: 20px;
            line-height: 20px;
            border-radius: 50%;
            text-align: center;
            padding: 0 !important;
            cursor: pointer;
        }
    </style>
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
                    {{ Form::label('RequestListID', 'Request Type') }} <span style="padding: 0 !important" class="form-add-more add-expense-request badge badge-success" data-toggle="modal" data-target="expense_request_setup"><i class="fa fa-plus"></i></span>


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
                    {{ Form::label('LotDescriptionID', 'Lot Description') }}
                    {{ Form::select('LotDescriptionID', ['' => 'Select Request'] + $lot_descriptions->pluck('LotDescription','LotDescriptionRef')->toArray() ,null, ['class' => 'full-width LotDescriptionID','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request']) }}
                </div>
            </div>
        </div>

        {{-- <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('DepartmentID', 'Department') }}
                    {{ Form::select('DepartmentID', ['' => 'Select Department'] + $departments->pluck('Department','DepartmentRef')->toArray() ,null, ['class' => 'full-width DepartmentID','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request']) }}
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row">


       {{--  <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('LocationID', 'Location') }}
                    {{ Form::select('LocationID', ['' => 'Select Request'] + $locations->pluck('Location','LocationRef')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Location']) }}
                </div>
            </div>
        </div> --}}
        <div class="clearfix"></div>
    </div>

    <hr>


    @if(auth()->user()->staff->department->Departmemt == 'Finance & Account')

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

    @if(auth()->user()->staff->department->Department == 'Procurement')
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

    {{-- Expense request modal --}}
    <div class="modal fade" id="expense_request_setup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Request</h4>
            </div>
            <div class="modal-body">
                <form id="expense-request-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="controls">
                                <div class="form-group">
                                    {{ Form::label('Request', 'Request' ) }}
                                    {{ Form::text('Request', null, ['class' => 'form-control', 'placeholder' => 'Add Request type']) }}
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
            </div>
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
                //  $('#DepartmentID').empty();
                //   $.get('/expense_management/fetch-departments/'+val, function(data) {
                //     $('#DepartmentID').append(`<option value="">Select Department</option>`);
                //     $.each(data, function(index, val) {
                //          $('#DepartmentID').append(`<option value="${val.DepartmentRef}">${val.Department}</option>`);
                //     });

                // });

                $('.LotDescriptionID').empty();
                  $.get('/expense_management/fetch-lots/'+val, function(data) {
                    $('.LotDescriptionID').append(`<option value="">Select Lot Description</option>`);
                    $.each(data, function(index, val) {
                         $('.LotDescriptionID').append(`<option value="${val.LotDescriptionRef}">${val.LotDescription}</option>`);
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

        <script>
                $('.add-expense-request').click(function(e){
                e.preventDefault();
                $('#expense_request_setup').show();
                $('#expense_request_setup').modal('show');

                alert('Okay');

            });

            var form1 = $("#expense-request-form");
                form1.submit(function(e) {
                e.preventDefault();
                $.post('/add_expense_request', {
                    Request: $('#Request').val()
                }, function(data, textStatus, xhr) {
                    if(data.success === true){
                    $('#Request').append('<option selected value="'+ data.data.RequestListRef +'">' +  data.data.RequestListRef +'</option>');
                    $('#expense_request_setup').modal('hide');
                    swal(
                        'Success',
                        data.data.Request + ' was added to the list',
                        'success'
                    )
                        $('#Request').val('');

                    } else {
                    swal(
                        'error',
                        data.data.Request + ' has already been taken.',
                        'error'
                    )
                }
                });
            });
        </script>

    @endpush
</link>
