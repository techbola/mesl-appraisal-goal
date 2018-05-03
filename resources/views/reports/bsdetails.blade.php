@extends('layouts.master')

@section('title')
  Balance Sheet
@endsection

@section('content')

  <style>

    table tbody tr td {
      /* font-size: 15.5px !important; */
    }
  </style>

  <div class="panel panel-default" id="print-content">
    <div class="panel-heading">
      <h3 class="panel-title">Balance Sheet Details For "{{ $category->AccountCategory }}"</h3>
    </div>
    <div class="panel-body">
      <table class="table tableWithSearch table-striped">
    <thead>
      <tr>
        {{-- <th>Ref</th> --}}
        <th>Account Category</th>
        <th width="15%">Post Date</th>
        <th width="15%">Value Date</th>
        <th width"20%">Description</th>
        <th>Amount (&#8358;)</th>
        <th width="20%">Narration</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $bs)
        <tr>
          {{-- <td>{{ $bs->AccountCategoryRef }}</td> --}}
          <td>{{ $bs->AccountCategory }}</td>
          <td>{{ $bs->PostDate }}</td>
          <td>{{ $bs->ValueDate }}</td>
          <td>{{ $bs->Description }}</td>
          <td>{{ number_format($bs->Amount) }}</td>
          <td>{{ $bs->Narration }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
    </div>
  </div>

@endsection
