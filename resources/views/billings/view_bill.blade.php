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
  <a href="{{ route('Add_Client_Document', [$client_details->ClientRef]) }}" class="btn btn-info btn-rounded pull-right" >Add New Document</a>
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Bill List for <span style="color: #2a9df5">{{ $client_details->Name }}</span></div><div class="clearfix"></div>
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
              @foreach($client_details as $client_detail)NotificationBilling
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $client_detail->GroupID }}</td>{id}/{billcode}
                <td>{{ $client_detail->BillingDate }}</td>
                <td><a href="{{ route('NotificationBilling',[$investigation->DocRef]) }}" class="btn btn-sm btn-info"></a>Add Item</td>
                <td><a href="#" class="btn btn-sm btn-success"></a>View Bill</td>
                
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


