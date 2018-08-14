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
                    <th>Billing Code</th>
                    <th>Billing Date</th>
                    <th>Add to bill</th>
                    <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bill_details as $bill_detail)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $bill_detail->GroupID }}</td>
                <td>{{ $bill_detail->BillingDate }}</td>
                <td><a href="{{ route('NotificationBilling',[$client_details->CustomerRef, $bill_detail->GroupID]) }}" class="btn btn-sm btn-info">Add Item</a></td>
                <td><a href="{{ route('Bill',[$client_details->CustomerRef, $bill_detail->GroupID]) }}" class="btn btn-sm btn-success">View Bill</a></td>
                
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


