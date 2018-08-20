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
            <select class="form-control select2" name="bank" data-init-plugin="select2">
              <option value="">Select Bank</option>
              @foreach ($banks as $bank)
                <option value="{{ $bank->BankAccountRef }}">{{ $bank->BankName }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Select Account Number</label>
            <select class="form-control select2" name="account_number" data-init-plugin="select2">
              <option value="">Account Number</option>
              @foreach ($banks as $bank)
                {{-- <option value="{{ $bank->BankAccountRef }}">{{ $bank->AccountNumber }}</option> --}}
                <option value="{{ $bank->BankAccountRef }}">{{ $bank->AccountNumber }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
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

      <div class="">
        <a href="{{ url()->current() }}" class="btn btn-info">Cancel</a>
        <a href="#" class="btn btn-success m-l-20">Import</a>
      </div>
    </div>
  @endif
@endsection
