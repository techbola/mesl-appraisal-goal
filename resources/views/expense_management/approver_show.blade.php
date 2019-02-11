@extends('layouts.master')

@section('title')

@endsection

@push('styles')
<style>
.comment{
padding: 10px;
background: #eee;
border-radius: 3px;
 clear: both;
 margin-bottom: 10px;
}
  .comment *{
    font-family: inherit !important;
    font-size: 13px !important;
  }
</style>
@endpush

@section('content')
  <div class="card-box">
    <div class="card-title">Review Expense Request - <span class="text-primary"></span></div>
     
     <div class="row">
       <div class="col-sm-6">
          {{ Form::model($expense, ['action' => ['ExpenseManagementController@update', $expense->ExpenseManagementRef ], 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form', 'files' => true]) }}
        {{ method_field('PATCH') }}

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
                   
                    
                    {{ Form::select('RequestListID', ['' => 'Select Request'] + $request_list->pluck('Request','RequestListRef')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request', 'disabled']) }}
                </div>
            </div>
        </div>  
        
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Description', 'Description') }}
                    {{ Form::text('Description',null, ['class' => 'form-control', 'placeholder' => 'e.g Finance Project', 'disabled']) }}
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
                    {{ Form::select('ExpenseCategoryID', ['' => 'Select Request'] + $expense_categories->pluck('ExpenseCategory','ExpenseCategoryRef')->toArray() ,$expense->lot_description->expense_category->ExpenseCategoryRef ?? null, ['class' => 'full-width ExpenseCategoryID','data-init-plugin' => "select2", 'data-placeholder' => 'Select Category', 'disabled']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('DepartmentID', 'Department') }}
                    {{ Form::select('DepartmentID', ['' => 'Select Department'] + $departments->pluck('Department','DepartmentRef')->toArray() , $expense->lot_description->department->DepartmentRef ?? null, ['class' => 'full-width DepartmentID','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request', 'disabled']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('LotDescriptionID', 'Lot Description') }}
                    {{ Form::select('LotDescriptionID', ['' => 'Select Request'] + $lot_descriptions->pluck('LotDescription','LotDescriptionRef')->toArray() ,null, ['class' => 'full-width LotDescriptionID','data-init-plugin' => "select2", 'data-placeholder' => 'Select Request', 'disabled']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('LocationID', 'Location') }}
                    {{ Form::select('LocationID', ['' => 'Select Request'] + $locations->pluck('Location','LocationRef')->toArray() ,null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Location', 'disabled']) }}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>

     <div class="row">    
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Comment', 'Comments') }}
                    {{-- {!! Form::textarea('Comment', null, ['class' => ' form-control','rows' => 1null, 'placeholder' => 'Description', 'disabled']) !!} --}}
                    <div class="comment">
                      {!! $expense->Comment !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    
    {{-- @if(auth()->user()->staff->company_department->name == 'Finance & Account') --}}

    <div class="card-section p-l-5">Finance</div>
    <div class="row">

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('AnnualBudget', 'Annual Budget') }}
                    {{ Form::text('AnnualBudget', null, ['class' => 'form-control smartinput', 'placeholder' => '', 'disabled']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('MonthlyPlan', 'Monthly Plan') }}
                    {{ Form::text('MonthlyPlan', null, ['class' => 'form-control smartinput', 'placeholder' => '', 'disabled']) }}
                </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('AmountSpent', 'Amount Spent') }}
                    {{ Form::text('AmountSpent', null, ['class' => 'form-control smartinput', 'placeholder' => '', 'disabled']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('YTDPlan', 'YTD Plan') }}
                    {{ Form::text('YTDPlan', null, ['class' => 'form-control smartinput', 'placeholder' => '', 'disabled']) }}
                </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Balance') }}
                    {{ Form::text('Balance', null, ['class' => 'form-control smartinput', 'placeholder' => '', 'disabled']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('MonthlyActual', 'Monthly Actual') }}
                    {{ Form::text('MonthlyActual', null, ['class' => 'form-control smartinput', 'placeholder' => '', 'disabled']) }}
                </div>
            </div>
        </div>
    {{-- </div>  <hr> --}}

<div class="clearfix"></div>
<div class="card-section p-l-5">Payment Details</div>
    <div class="row"> 
         <div class="col-sm-6 form-group">
            {{ Form::label('BankID', 'Select Bank') }}
            {{ Form::select('BankID', [ '' =>  'Select Bank Account'] + $banks->pluck('BankName', 'BankRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'class'=>"required", 'required', 'disabled']) }}
        </div>


        <div class="form-group col-sm-6">
            <div class="controls">
                {{ Form::label('AccountNo', 'Account Number') }}
                {{ Form::text('AccountNo', null, ['class' => 'form-control', 'placeholder' => '', 'disabled']) }}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('AmountPaid', 'Amount Paid') }}
                    {{ Form::text('AmountPaid', null, ['class' => 'form-control smartinput', 'placeholder' => '', 'disabled']) }}
                </div>
            </div>
        </div>

        <div class="col-sm-6 form-group">
            {{ Form::label('GLID', 'Select Expense Account') }}
            {{ Form::select('GLID', [ '' =>  'Select Customer Account'] + $debit_acct_details->pluck('CUST_ACCT', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'class'=>"required", 'required', 'disabled']) }}
        </div>

    </div>

    {{-- @endif --}}

    <div class="clearfix"></div> <hr>
   
    {{-- @if(auth()->user()->staff->company_department->name == 'Procurement') --}}
    <div class="card-section p-l-5">Procurement Sections</div>
    <div class="row">
         <div class="col-sm-6 form-group">
            {{ Form::label('AmountForApproval', 'Amount For Approval') }}
             {{ Form::text('AmountForApproval', null, ['class' => 'form-control smartinput', 'disabled']) }}
        </div>

        <div class="col-sm-6 form-group">
            {{ Form::label('VendorName', 'Vendor\'s Name') }}
             {{ Form::text('VendorName', null, ['class' => 'form-control', 'placeholder' => 'Enter Vendor Name', 'disabled']) }}
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6 form-group">
            {{ Form::label('VendorBankID', 'Vendor Bank') }}
            {{ Form::select('VendorBankID', [ '' =>  'Select Bank Account'] + $banks->pluck('BankName', 'BankRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'class'=>"required", 'required', 'disabled']) }}
        </div>

        <div class="col-sm-6">
            <div class="">
              {{ Form::label('DeliveryDate','Delivery Date', ['class' => 'form-label']) }}
              <div class="input-group date dp">
                {{ Form::text('DeliveryDate', null, ['class' => 'form-control', 'placeholder' => 'Delivery Date', 'disabled']) }}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
        </div> <div class="clearfix"></div>

        <br>
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('ContractSummary', 'Contract Summary (Fixed Struc. SLA, Exit Clause etc)') }}
                    {{-- {!! Form::textarea('ContractSummary',null, ['class' => ' form-control','rows' => 1null, 'placeholder' => 'Contract Summary', 'disabled']) !!} --}}
                    <div class="comment">
                      {!! $expense->ContractSummary ?? 'No Comment' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    {{-- @endif --}}

    

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

   

      {{ Form::close() }}
       </div>
     </div>



       <div class="col-sm-6" style="border-left: 1px solid #d9d9d9">

         Approvers: <b>{!! $expense->approvers !!}</b> <br> <br>
         @foreach($expense->expense_comments as $exp)
         <div style="position: relative"> <i>{{ $exp->approved_by}} &nbsp; <span class=""> {{ $exp->ApprovedFlag == 1 ? 'Approved' : 'Rejected'}} by: {{ $exp->approver}} @ {{ $exp->approved_at}}</span>: </i>
          <div style="margin: 10px 0">
             {!! $exp->ApprovedFlag == 1 ? '<div class="badge badge-success flags">Approved</div>' : '<div class="flags badge badge-danger">Declined</div>' !!}
           </div>
          <div class="comment">{!! $exp->Comment!!}</div>
         </div> 
              <div><i><b>FILES : &nbsp;</b></i> </div>
              @foreach($exp->files as $file)
                <div class="badge badge-primary">
                  <a href="{{  asset('storage/expense_management_files/'.$file->FileName ) }}" target="_blank"> 
                    {{ $file->FileName }}
                  </a>
                </div>
              @endforeach
              <hr>
              
         @endforeach

        
<form id="form_approve" class="" action="{{ route('approve_expense') }}" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}
         <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Comment', 'Comment') }}
                    {{ Form::textarea('Comment', null, ['class' => 'summernote form-control','rows' => 3, 'placeholder' => 'Purpose of this memo']) }}

                </div>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('attachment[]', 'Attach Files') }}
                    {{ Form::file('attachment[]',  ['class' => '','multiple' => 'multiple']) }}
                </div>
            </div>
        </div> 
        <input type="hidden" name="ExpenseManagementRef" value="{{ $expense->ExpenseManagementRef }}">
        <input type="hidden" name="RequestListID" value="{{ $expense->RequestListID }}">
        <input type="hidden" name="ApproverRoleID" value="{{ $expense->ApproverRoleID }}">
        {{-- {{ method_field('PATCH') }} --}}
      </form>
      <form id="form_reject" class="" action="{{ route('reject_expense') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="ExpenseManagementRef" value="{{ $expense->ExpenseManagementRef }}">
        <input type="hidden" name="RequestListID" value="{{ $expense->RequestListID }}">
        <input type="hidden" name="ApproverRoleID" value="{{ $expense->ApproverRoleID }}">
        {{-- {{ method_field('PATCH') }} --}}
      </form>
         <div class="text-center" style="margin: auto">
      <a class="btn btn-success btn-cons btn-lg m-r-20" onclick="confirm2('Approve Changes?', '', 'form_approve')">Approve</a>
      <a class="btn btn-danger btn-cons btn-lg" onclick="confirm2('Reject Changes?', '', 'form_reject')">Reject</a>

      
    </div>

       </div>

     </div>

  </div>
@endsection
