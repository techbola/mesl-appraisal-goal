<div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" class="form-control" name="BankName" placeholder="Enter Bank NAme" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bank Account Code</label>
                    <input type="text" class="form-control" name="BankAccountCode" placeholder="Enter Bank Account Code" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Account Type</label>
                    <input type="text" class="form-control" name="AccountType" placeholder="Enter Account Type" required>
                  </div>
                </div>

                <div class="col-md-6">
                 <div class="form-group">
                 {{ Form::label('Currency') }}
                    {{ Form::select('CurrencyID', [''=>'Select Currency'] + $currencies->pluck('Currency', 'CurrencyRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Currency", 'data-init-plugin' => "select2", 'required']) }}
                 </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Account Number</label>
                    <input type="text" class="form-control" name="AccountNumber" placeholder="Enter Account Number" required>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Account Officer Number</label>
                    <input type="text" class="form-control" name="AccountOfficerNumber" placeholder="Enter Account Officer Number" required>
                  </div>
                </div>

                <div class="col-md-6">
                 <div class="form-group">
                 {{ Form::label('Account Officer Name') }}
                    {{ Form::select('AccountOfficerName', [''=>'Select Currency'] + $acct_mgrs->pluck('AccountManager', 'AccountMgrRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Account Officer Name", 'data-init-plugin' => "select2", 'required']) }}
                 </div>
                </div>


                <div class="col-md-12">
                  <div class="form-group">
                    <label>BankAddress</label>
                    <textarea class="form-control" name="BankAddress" rows=3 required></textarea>
                  </div>
                </div>

              </div>
              <button type="submit" id="submit_bank_account" class="btn btn-info btn-form pull-right">Submit</button>

              @push('scripts')
                <script>
                  $('#submit_bank_account').click(function(event) {
                    $.post('/submit_bank_account', $('#bank_account_form').serialize(), function(data, status) {
                      if(status == 'success')
                      {
                        $('#new_project').modal('toggle');
                        alert('jesus');
                      }
                    });
                    return false;
                  });
                </script>
              @endpush