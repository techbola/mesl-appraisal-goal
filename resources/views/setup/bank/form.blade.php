    {{ csrf_field() }}
    <div class="row">
         <div class="col-md-6">
             <div class="controls">
                 <div class="form-group">
                     {{ Form::label('BankName', 'Bank name' ) }}
                     {{ Form::text('BankName', null, ['class' => 'form-control', 'placeholder' => 'Add Bank Name', 'required']) }}
                 </div>
             </div>
         </div>

         <div class="col-md-6">
             <div class="controls">
                 <div class="form-group">
                     {{ Form::label('AccountName', 'Account Name' ) }}
                     {{ Form::text('AccountName', null, ['class' => 'form-control', 'placeholder' => 'Add account name']) }}
                 </div>
             </div>
         </div>
    </div>

    <div class="row">
         <div class="col-md-4">
             <div class="controls">
                 <div class="form-group">
                     {{ Form::label('AccountNumber', 'Account Number' ) }}
                     {{ Form::text('AccountNumber', null, ['class' => 'form-control', 'placeholder' => 'Add account number']) }}
                 </div>
             </div>
         </div>

         <div class="col-md-4">
             <div class="controls">
                 <div class="form-group">
                     {{ Form::label('AccountOfficerName', 'Account Officer' ) }}
                     {{ Form::text('AccountOfficerName', null, ['class' => 'form-control', 'placeholder' => 'Add Account Officer']) }}
                 </div>
             </div>
         </div>

         <div class="col-md-4">
             <div class="controls">
                 <div class="form-group">
                     {{ Form::label('AccountOfficerPhone', 'Account Officer mobile' ) }}
                     {{ Form::text('AccountOfficerPhone', null, ['class' => 'form-control', 'placeholder' => 'Add Account Officer number' ]) }}
                 </div>
             </div>
         </div>
    </div>

    <div class="row">
         <div class="col-md-4">
             <div class="controls">
                 <div class="form-group">
                     {{ Form::label('Branch', 'Branch' ) }}
                     {{ Form::text('Branch', null, ['class' => 'form-control', 'placeholder' => 'Add Branch']) }}
                 </div>
             </div>
         </div>

         <div class="col-md-4">
             <div class="controls">
                 <div class="form-group">
                     {{ Form::label('SortCode', 'Sort Code' ) }}
                     {{ Form::text('SortCode', null, ['class' => 'form-control', 'placeholder' => 'Add Sort Code']) }}
                 </div>
             </div>
         </div>

         <div class="col-md-4">
             <div class="controls">
                 <div class="form-group">
                     {{ Form::label('CurrencyID', 'Currency' ) }}
                     <select name="CurrencyID" class="full-width" data-init-plugin="select2">
                         <option value=" ">Select Currency</option>
                         @foreach($currency as $kudi)
                             <option value="{{ $kudi->CurrencyRef }}">{{ $kudi->Currency }}</option>
                         @endforeach
                     </select>
                 </div>
             </div>
         </div>
    </div>

    <div class="row">
         <div class="pull-right">
             <button class="btn btn-info" type="submit">Submit</button>
         </div>
    </div>