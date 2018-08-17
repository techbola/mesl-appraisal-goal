<div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" class="form-control" id="edit_BankName" name="BankName" placeholder="Enter Bank NAme" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bank Account Code</label>
                    <input type="text" class="form-control" id="edit_BankAccountCode" name="BankAccountCode" placeholder="Enter Bank Account Code" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Account Type</label>
                    <input type="text" class="form-control" id="edit_AccountType" name="AccountType" placeholder="Enter Account Type" required>
                  </div>
                </div>

                <div class="col-md-6">
                 <div class="form-group">
                 {{ Form::label('Currency') }}
                    {{ Form::select('CurrencyID', [''=>'Select Currency'] + $currencies->pluck('Currency', 'CurrencyRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Currency", 'id'=>'edit_CurrencyID', 'data-init-plugin' => "select2", 'required']) }}
                 </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Account Number</label>
                    <input type="text" class="form-control" id="edit_AccountNumber" name="AccountNumber" placeholder="Enter Account Number" required>
                  </div>
                </div>

                <div class="col-md-6">
                 <div class="form-group">
                 {{ Form::label('Account Officer Name') }}
                    {{ Form::select('AccountOfficerName', [''=>'Select Currency'] + $acct_mgrs->pluck('AccountManager', 'AccountMgrRef')->toArray(),null, ['class'=> "full-width", 'id'=>'edit_AccountOfficerName', 'data-placeholder' => "Select Account Officer Name", 'data-init-plugin' => "select2", 'required']) }}
                 </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Account Officer Number</label>
                    <input type="text" class="form-control" id="edit_AccountOfficerNumber" name="AccountOfficerNumber" placeholder="Enter Account Officer Number" required>
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="form-group">
                    <label>BankAddress</label>
                    <textarea class="form-control" id="edit_BankAddress" name="BankAddress" rows=3 required></textarea>
                  </div>
                </div>
                <input type="hidden" name="BankAccountRef" id="edit_BankAccountRef">

              </div>
              <button type="submit" id="submit_edit_bank_account" class="btn btn-info btn-form pull-right">Save</button>

              @push('scripts')
                <script>
                  $('#submit_edit_bank_account').click(function(event) {
                    $.post('/submit_bank_account_edit', $('#edit_bank_account_form').serialize(), function(data, status) {
                     if(status == 'success')
                     {
                       var search_name = $('#bank').val();
                       $.get('/get_searched_bank_account/' +search_name, function(data, status) {
                          if (status == 'success')
                           {
                            $('#bank_account_body').html(' ');
                            $.each(data, function(index, val) {
                            $('#bank_account_body').append(`
                                <tr>
                                   <td>${val.BankName}</td>
                                   <td>${val.BankAccountCode}</td>
                                   <td>${val.AccountType}</td>
                                   <td>${val.CurrencyID}</td>
                                   <td>${val.AccountNumber}</td>
                                    <td>${val.BankAddress}</td>
                                     <td>${val.AccountManager}</td>
                                   <td>${val.AccountOfficerNumber}</td>
                                   <td>${val.GLIdentifier}</td>
                                   <td>
                                      <td>
              <a href="#"><span class="glyphicon glyphicon-edit edit_account_button" aria-hidden="true" data-id="${val.BankAccountRef}"  data-toggle="modal" data-target="#new_project"></span></a> |  <a href="#"><span class="glyphicon glyphicon-trash text-danger" aria-hidden="true"></span></a>              
            </td>
                                   </td>
                                </tr> 
                              `);
                         });
                           }
                       });
                       $('#new_project').modal('toggle');
                     }
                    });
                    return false;
                  });
                </script>
              @endpush