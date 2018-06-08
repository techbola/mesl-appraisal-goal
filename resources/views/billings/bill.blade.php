@extends('layouts.master')

@push('styles')
  <style>
    @media print {
  #printPageButton {
    display: none;
  }
}        
  </style>      
@endpush

@section('title')
  Invoice
@endsection

@section('page-title')
  Invoice
@endsection

@section('buttons')
  <a href="{{ route('LeaveRequest') }}" class="btn btn-info btn-rounded pull-right" >Add New Client</a> &nbsp &nbsp
  <a href="{{ route('LeaveRequest') }}" class="btn btn-success btn-rounded pull-right" >Add New Product or Service</a>
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Invoice for <span></span></div>
        <div class="clearfix"></div>
        <hr>
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="margin-bottom: 40px">
              <a href="#" class="btn btn-sm btn-info" title=""  onclick="javascript:window.print()">Print</a>
              <div  style="padding: 20px; border: 1px solid #eee">
                <div style="background: #eee; max-height: 300px">

                  <div class="row" style="padding-top: 10px">
                    <div class="col-md-6">
                      <img src="{{ asset('images/Cavidel_Logo.png') }}" alt="Logo" width="250px">
                    </div>
                    <div class="col-md-3" style="padding: 10px">
                      <h5 style="font-size: 14px; font-weight: 500">+2349067354599<br>
                      support@cavidel.com<br>
                      <span style="color: #2ea1f8">www.cavidel.com</span></h5>
                    </div>
                    <div class="col-md-3" style="padding: 15px; font-size: 12px">
                      <h5 style="font-size: 14px; font-weight: 500">Block D1, Studio Appartment 2, 1004 Estate, Victoria Island. Lagos State.</h5>
                    </div>
                  </div>
              </div>


                  <div class="row" style="padding: 20px">
                    <div class="col-md-6">
                      <h5>Billing To : </h5>
                      <p>Client Name :<br> <span style="font-size: 16px; font-weight: 800; color: #2ea1f8">{{ $client_details->Name }}</span></p>
                      <p>Client Address:<br>  <span style="font-size: 16px; font-weight: 800">{{ $client_details->Address }}</span></p>
                    </div>
                    <div class="col-md-3">
                      <h5>Invoice Number : </h5>
                      <p> {{ $code }}</p>

                      <h5>Date of Issue : </h5>
                      <p>{{ $bill_header->BillingDate }}</p>
                    </div>
                    <div class="col-md-3">
                      <h5>Invoice total : </h5>
                      <h2 style="font-weight: 700">&#8358;{{ number_format($total_bill,2) }}</h2>
                    </div>
                  </div><hr>

                  <div class="row" style="padding: 20px">
                    <table class="table table-hover">
                      <thead>
                        <th style="color: #000">S/N</th>
                        <th style="color: #000">Service</th>
                        <th style="color: #000">Unit Price</th>
                        <th style="color: #000">Qty</th>
                        <th style="color: #000">Amount</th>
                      </thead>
                      <tbody>
                        @foreach($bills as $bill)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td>{{ $bill->Produt_ServiceType }}</td>
                          <td>{{ $bill->UnitPrice }}</td>
                          <td>{{ $bill->Quantity }}</td>
                          <td>{{ $bill->Price }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                       <tfoot>
                        <tr>
                        <td></th>
                        <td></th>
                        <td></th>
                        <td style="font-weight: 800; background: #95cbf5">Tax</th>
                        <td style="font-weight: 800; background: #95cbf5"></th>
                        </tr>
                      </tfoot>
                      <tfoot>
                        <tr>
                          <td></th>
                        <td></th>
                        <td></th>
                        <td style="font-weight: 800">Total</th>
                        <td style="font-weight: 800">&#8358;{{ number_format($total_bill,2) }}</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                  <div class="row" style="padding: 20px">
                    <div style="background: #eee; text-align: center;">
                      <p style="font-weight: bold">officemate by Cavidel Limited</p>
                    </div>
                  </div>

            </div>
        </div>
  	</div>
  	<!-- END PANEL -->
@endsection

@push('scripts')
@endpush

