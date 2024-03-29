@extends('layouts.master')

@section('title')
  Import Bank Transactions
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Import Bank Transactions</div>
    <form action="{{ route('store_import') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Select Bank Account</label>
            <select id="bank" class="form-control select2" name="bank" data-init-plugin="select2" required>
              <option value="">Select Bank</option>
              @foreach ($banks as $bank)
                <option value="{{ $bank->BankAccountRef }}">{{ $bank->BankName }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {{-- <label for="">Select Account Number</label>
            <select class="form-control select2" name="account_number" data-init-plugin="select2">
              <option value="">Account Number</option>
              @foreach ($banks as $bank)
                <option value="{{ $bank->BankAccountRef }}">{{ $bank->AccountNumber }}</option>
              @endforeach
            </select> --}}
            <label>Account Number</label>
            <input id="account_no" type="text" name="account_no" value="" class="form-control" placeholder="Account number" disabled>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label>Upload Excel File</label>
            <input type="file" name="file" class="form-control filestyle" placeholder="" data-buttonname="btn-info" data-buttonBefore="true">
          </div>
        </div>

      </div>

      <div class="m-t-10 btn-form">
        <input type="submit" class="btn btn-info" value="Upload">
      </div>

    </form>
  </div>

  @if (session('staging') == '1')
    <div class="card-box">
      <div class="card-title pull-left">Confirm Import Data</div>
      <div class="pull-right">
        <a href="{{ url()->current() }}" class="btn btn-inverse btn-lg">Cancel</a>
        <a href="#" class="btn btn-success btn-cons btn-lg m-l-10" onclick="confirm2('Are you sure you want to import this data?', '', 'complete_import')">Proceed</a>
        <form class="hidden" id="complete_import" action="{{ route('complete_import') }}" method="post" onsubmit="$('#spinner').show()">
          {{ csrf_field() }}
        </form>
      </div>
      <div class="clearfix"></div>
      <table class="table table-bordered">
        <thead>
          <th width="5%">TransactionRef</th>
          <th width="10%">Post Date</th>
          <th>Reference</th>
          <th width="10%">Value Date</th>
          <th>Debit</th>
          <th>Credit</th>
          <th>Balance</th>
          <th>Narration</th>
          <th>Bank</th>
          <th>Account Number</th>
        </thead>

        <tbody>
          @foreach ($staging as $stage)
            <tr>
              <td>{{ $stage->TransactionRef }}</td>
              <td>{{ $stage->PostDate }}</td>
              <td>{{ $stage->Reference }}</td>
              <td>{{ $stage->ValueDate }}</td>
              <td>{{ $stage->Debit }}</td>
              <td>{{ $stage->Credit }}</td>
              <td>{{ $stage->Balance }}</td>
              <td>{{ $stage->Narration }}</td>
              <td>{{ $stage->Bank }}</td>
              <td>{{ $stage->AccountNumber }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>


    </div>
  @endif
@endsection

@push('scripts')
  <script>
    $('#bank').on('change', function(){
      $('#spinner').show();
      $.get('/bank_txn/get_account_no/'+ $('#bank').val(), function(data, status){
        // console.log(data);
        $('#account_no').val(data);
        $('#spinner').hide();
      });
    });
  </script>
@endpush
