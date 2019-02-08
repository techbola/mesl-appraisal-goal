@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    @endpush


    {{-- MODALS --}}
        <!-- Create Modal -->
       

    @include('errors.list')

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('LotDescription', 'Description') }}
                    {{ Form::text('LotDescription', null, ['class' => 'form-control', 'placeholder' => 'e.g Finance Project']) }}
                </div>
            </div>
        </div>
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
                    {{ Form::select('DepartmentID', ['' => 'Select Department'] + $departments->pluck('name','id')->toArray() ,null, ['class' => 'full-width DepartmentID','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request']) }}
                </div>
            </div>
        </div>
    </div>

      
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
                    {{ Form::label('MonthlyBudget', 'Monthly Budget') }}
                    {{ Form::text('MonthlyBudget', null, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
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
                    {{ Form::label('MTDActual', 'MTD Actual') }}
                    {{ Form::text('MTDActual', null, ['class' => 'form-control smartinput', 'placeholder' => '']) }}
                </div>
            </div>
        </div>
    </div>  <hr>




    

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
                         $('#DepartmentID').append(`<option value="${val.id}">${val.name}</option>`);
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