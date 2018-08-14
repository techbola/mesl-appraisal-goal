@extends('layouts.master')

@push('styles')
  <style>
  @media print {
    #printPageButton {
      display: none;
    }
    #bill-box{
      background: #eee;
      border: 1px solid #eee;
      padding: 10px;
    }

    img {
max-width: 500px;
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

@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Invoice for <span></span></div>
        <div class="clearfix"></div>
        <hr>
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="margin-bottom: 40px">
              <a href="#" class="btn btn-sm btn-info" title=""  onclick="print_bill()">Print</a>
              <div id="bill-box"  style="padding: 20px; border: 1px solid #eee">
                <div style="background: #eee; max-height: 300px">

                  <div class="row" style="padding-top: 10px">
                    <div class="col-md-6">
                      <img src="{{ asset("images/$company_details->Logo") }}" alt="Logo" width="250px">
                    </div>
                    <div class="col-md-3" style="padding: 10px">
                      <h5 style="font-size: 14px; font-weight: 500">{{ $company_details->Phone }}<br>
                      {{ $company_details->Email }}<br>
                      <span style="color: #2ea1f8">{{ $company_details->Website }}</span></h5>
                    </div>
                    <div class="col-md-3 pr-fl" style="padding: 15px; font-size: 12px">
                      <h5 style="font-size: 14px; font-weight: 500">{{ $company_details->Address }}</h5>
                    </div>
                  </div>
              </div>


                  <div class="row" style="padding: 20px">
                    <div class="col-md-6">
                      <h5>Billing To : </h5>
                      <p>Client Name :<br> <span style="font-size: 16px; font-weight: 800; color: #2ea1f8">{{ $client_details->Customer }}</span></p>
                      <p>Client Address:<br>  <span style="font-size: 16px; font-weight: 800">{{ $client_details->AddressLine1 }}</span></p>
                    </div>
                    <div class="col-md-3">
                      <h5>Invoice Number : </h5>
                      <p> {{ $code }}</p>

                      <h5>Date of Issue : </h5>
                      <p>{{ $bill_header->BillingDate }}</p>
                    </div>
                    <div class="col-md-3">
                      <h5>Invoice total : </h5>
                      <h2 style="font-weight: 700">&#8358;{{ number_format($tot,2) }}</h2>
                    </div>
                  </div><hr>

                  <div class="row" style="padding: 20px">
                    <table class="table table-hover table-bordered">
                      <thead>
                        <th style="color: #000; text-align: center; color: #000 !important">S/N</th>
                        <th style="color: #000; text-align: center; color: #000 !important">Service</th>
                        <th style="color: #000; text-align: center; color: #000 !important">Unit Price</th>
                        <th style="color: #000; text-align: center; color: #000 !important">Qty</th>
                        <th style="color: #000; text-align: center; color: #000 !important">Discount</th>
                        <th style="color: #000; text-align: center; color: #000 !important">Amount</th>
                      </thead>
                      <tbody>
                        @foreach($bills as $bill)
                        <tr>
                          <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                          <td style="text-align: center;">{{ $bill->Produt_ServiceType }}</td>
                          <td style="text-align: center;">&#8358;{{ number_format($bill->UnitPrice, 2) }}</td>
                          <td style="text-align: center;">{{ $bill->Quantity }}</td>
                          <td style="text-align: center;">{{ number_format($bill->Discount, 2)  }}</td>
                          <td style="text-align: center;">&#8358;{{ number_format($bill->Price, 2) }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <td></th>
                        
                          <td></th>
                          <td></th>
                            <th></th>
                            <td style="font-weight: 800; text-align: center;">Total Amount</th>
                        <td style="font-weight: 800; text-align: center;">&#8358;{{ number_format($tot ,2) }}</th>
                        </tr>
                      </tfoot>
                      <tfoot>
                        <tr>
                          <td></th>
                        <td style="font-weight: 800; text-align: center;">Total</th>
                          <td></th>
                          <td></th>
                          <td style="font-weight: 800; text-align: center;">&#8358;{{ number_format($total_discount,2) }}</th>
                        <td style="font-weight: 800; text-align: center;">&#8358;{{ number_format($total_bill,2) }}</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                  <div class="row" style="padding: 30px">
                    <h3>Bill Narration :</h3>
                    <?php $id=1; ?>
                    @foreach($bills as $bill)
                    <span style="font-size: 16px">{{ $id++ }}.   {!! $bill->Narration !!}</span>
                    @endforeach
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
<script src="{{ asset('js/jquery-printme.min.js') }}"></script>
<script>
  var print_options = {
    "path": ["{{ asset('css/printmemo.css') }}"]
  }
  function print_bill() {
        return $("#bill-box").printMe(print_options); 
    }
</script>
@endpush


