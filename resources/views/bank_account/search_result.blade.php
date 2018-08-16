@extends('layouts.master')

@section('title')
  Bank Account
@endsection

@section('page-title')
  Bank Account
@endsection

@section('buttons')
   <button class="btn btn-sm btn-info pull-right" id="add_account_button" data-toggle="modal" data-target="#new_project">New Bank Account</button>
@endsection

@section('content')
 
  <!-- START PANEL -->
  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Search Bank Account</div>
    </div>
       <div class="row">
        {{ Form::open(['action' => 'BankAccountController@search_bank_account', 'autocomplete' => 'off', 'role' => 'form']) }}
               <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('BankAccount', 'Enter Bank Name' ) }}
                            {{ Form::text('BankAccount', null, ['class' => 'form-control', 'id'=>'bank', 'placeholder' => 'Enter Bank Account', 'required']) }}
                        </div>
                    </div>
                    {{ Form::submit('Search', ['class'=>'btn btn-lg btn-info pull-right']) }}
               </div><br>
               
        {{ Form::close() }}
       </div>    
  </div>
  <!-- END PANEL -->

   <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Search Account Balance</div>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>

      <table class="table tableWithSearch table-striped table-bordered">
      <thead>
        <th>BankName</th>
        <th>BankAccountCode</th>
        <th>AccountType</th>
        <th>Currency</th>
        <th>AccountNumber</th>
        <th>BankAddress</th>
        <th>AccountOfficerName</th>
        <th>AccountOfficerNumber</th>
        <th>GLIdentifier</th>
        <th>Actions</th>
      </thead>
      <tbody id="bank_account_body">
        @foreach($results as $result)
        <tr>
            <td>{{ $result->BankName }}</td>
            <td>{{ $result->BankAccountCode }}</td>
            <td>{{ $result->AccountType }}</td>
            <td>{{ $result->Currency }}</td>
            <td>{{ $result->AccountNumber }}</td>
            <td>{{ $result->BankAddress }}</td>
            <td>{{ $result->AccountManager }}</td>
            <td>{{ $result->AccountOfficerNumber }}</td>
            <td>{{ $result->GLIdentifier }}</td>
            <td>
              <a href="#"><span class="glyphicon glyphicon-edit edit_account_button" aria-hidden="true" data-id="{{ $result->BankAccountRef }}"  data-toggle="modal" data-target="#new_project"></span></a> |  <a href="#"><span class="glyphicon glyphicon-trash text-danger" aria-hidden="true"></span></a>              
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    
  </div>
  <div class="modal fade slide-up" id="new_project" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5 id="title"></h5>
                <div class="modal-body">
                    <div id="bank_account_div"  class="hide">
                         <form id="bank_account_form">
                            {{ csrf_field() }}
                            @include('bank_account.bank_account_form')
                         </form>
                    </div>

                    <div id="edit_bank_account_div" class="hide">
                         <form id="edit_bank_account_form">
                            {{ csrf_field() }}
                            @include('bank_account.bank_account_edit_form')
                         </form>
                    </div>
                </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
</div>

@endsection


@push('scripts')
  <script>
      $('#add_account_button').click(function(event) {
          $('#title').html('Add New Bank Account Form');
          $('#bank_account_div').removeClass('hide');
          $('#edit_bank_account_div').addClass('hide');
      });

      $('.edit_account_button').click(function(event) {
          $('#title').html('Edit Bank Account Form');
          $('#bank_account_div').addClass('hide');
          $('#edit_bank_account_div').removeClass('hide');
          var id = $(this).data('id');

          $.get('/get_bank_account_details/'+id, function(data, status) {
            console.log(data);
                  $('#edit_BankName').val(data.BankName);
                  $('#edit_BankAccountCode').val(data.BankAccountCode);
                  $('#edit_AccountType').val(data.AccountType);
                  $('#new_project select[name="CurrencyID"]').val(data.CurrencyID).trigger('change');
                  $('#edit_AccountNumber').val(data.AccountNumber);
                  $('#edit_AccountOfficerNumber').val(data.AccountOfficerNumber);
                  $('#new_project select[name="AccountOfficerName"]').val(data.AccountOfficerName).trigger('change');
                  $('#edit_BankAddress').val(data.BankAddress);
                  $('#edit_BankAccountRef').val(data.BankAccountRef);
          });
      });
  </script>
@endpush
