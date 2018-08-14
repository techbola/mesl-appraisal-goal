@extends('layouts.master')

@push('styles')

@endpush

@section('title')
  Client Bill list
@endsection

@section('page-title')
  Client Bill list
@endsection

@section('buttons')

@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Receipt for <span style="color: #2a9df5"> {{ $client_details->Customer }}</span></div><div class="clearfix"></div>
        <div class="row">
          <table class="table tabel-hover table-striped">
            <thead>
              <tr>
                <th></th>
                    <th>Receipt Date</th>
                    <th>Amount</th>
                    <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($cash_details as $cash_detail)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $cash_detail->PostDate }}</td>
                <td>{{ nairazify(number_format($cash_detail->Amount, 2)) }}</td>
                <td><a href="{{ route('print_receipt', [$cash_detail->CashEntryRef, $client_details->CustomerRef]) }}" class="btn btn-sm btn-success">View Receipt</a></td>
                
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  	</div>
  	<!-- END PANEL -->
@endsection

@push('scripts')
 
@endpush


