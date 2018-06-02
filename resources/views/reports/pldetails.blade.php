@extends('layouts.master')

@section('title')
  Profit & Loss
@endsection

@section('content')

  <style>

    table tbody tr td {
      /* font-size: 15.5px !important; */
    }
  </style>

  <div class="panel panel-default" id="print-content">
    <div class="panel-heading">
      <h3 class="panel-title">Profit & Loss Details For "{{ $category->AccountCategory }}"</h3>
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
      @foreach ($data as $pl)
        <tr>
          {{-- <td>{{ $pl->AccountCategoryRef }}</td> --}}
          <td>{{ $pl->AccountCategory }}</td>
          <td>{{ $pl->PostDate }}</td>
          <td>{{ $pl->ValueDate }}</td>
          <td>{{ $pl->Description }}</td>
          <td>{{ number_format($pl->Amount) }}</td>
          <td>{{ $pl->Narration }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
    </div>
  </div>

@endsection
