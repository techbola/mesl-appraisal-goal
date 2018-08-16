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
  Receipt
@endsection

@section('page-title')
  Receipt
@endsection

@section('buttons')

@endsection

@push('styles')
  <style>
    #invoice-template {
      width: 100%;
      text-align: left;
      /*padding: 4rem;*/
    }
    .card-box {
      padding: 3rem;
    }
  </style>
@endpush
@section('content')

    {{-- print --}}

    <div class="text-right m-b-20">
      <button type="button" class="btn btn-complete btn-lg my-1" onclick="print_bill()"><i class="fa fa-paper-plane-o"></i> Print Receipt</button>
    </div>

  	<!-- START PANEL -->
  	<section class="card-box" style="width: 100%">
          <div id="invoice-template" class="card-body">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
              <div class="col-md-6 col-sm-12  text-left">
                <div class="media">
                  <img src="{{ asset("images/$company_details->Logo") }}" alt="company logo" width="120" class="img-responsive">
                  
                </div>
              </div>
              <div class="col-md-6 col-sm-12  text-right">
                <h2>RECEIPT</h2>
                <p class="pb-3"># {{ 'BNKRCPOM'.$cash_entry->CashEntryRef }}</p>
                <ul class="px-0 list-unstyled">
                  <li>Balance Due</li>
                  <li class="lead text-bold-800">{{ nairazify(number_format(0.00, 2)) }}</li>
                </ul>
              </div>
            </div> <hr>
            <!--/ Invoice Company Details -->
            <!-- Invoice Customer Details -->
            <div id="invoice-customer-details" class="row pt-2">
              <div class="col-sm-12  text-left">
                {{-- <p class="text-muted">Bill To</p> --}}
              </div>
              <div class="col-md-6 col-sm-12  text-left">
                <ul class="px-0 list-unstyled">
                  <li class="text-bold-800"> <span class="text-muted m-r-10">Customer Name:</span> {{ $client_details->Customer ?? '-' }}</li>
                  <li><span class="text-muted m-r-10">Email:</span> <span class="text-info">{{ $client_details->Email ?? '-' }}</span></li>
                  <li><span class="text-muted m-r-10">Phone No:</span> <span class="">{{ $client_details->Phone ?? '-' }}</span></li>
                  <li></li>
                </ul>
              </div>
              <div class="col-md-6 col-sm-12  text-right">
                <p>
                  <span class="text-muted m-r-10">Receipt Date</span> {{ nice_date($cash_entry->ValueDate) }}</p>
                <p>
                  <span class="text-muted m-r-10">Account Manager</span> <b>ELOHO Q. OCHUKO</b></p>
                <p>
                  <span class="text-muted m-r-10">Contact Number</span> Company Number Here</p>
              </div>
            </div> <hr>
            <!--/ Invoice Customer Details -->
            <!-- Invoice Items Details -->
            <div id="invoice-items-details" class="pt-2">
              <div class="row">
                <div class="table-responsive col-sm-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th class="text-right">Description</th>
                        <th class="text-right">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <p>{!! $cash_entry->Narration !!}</p>
                        </td>
                        <td class="text-right"></td>
                        <td class="text-right">{{ nairazify(number_format($cash_entry->Amount,2)) }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <h4 class="text-center semi-bold m-t-15 m-b-15">Payments</h4>
            <div id="invoice-items-details" class="pt-2">
              <div class="row">
                <div class="table-responsive col-sm-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-left">Description</th>
                        <th class="text-right">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="text-center" scope="row">1</th>
                        <td>
                          <p>Total Payment received till date</p>
                        </td>
                        <td class="text-right">{{ nairazify(number_format($cash_entry->Amount,2)) }}</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <td></td>
                      <td class="text-right">Outstanding Balance</td>
                      <td class="text-right">{{ nairazify(number_format($cash_entry->Amount,2)) }}</td>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <!-- Invoice Footer -->
            <div id="invoice-footer" class="m-t-100">
              <b>Amount in words</b>
              <h5>
                <b>{{ ucwords($amount_in_words) }}</b>
              </h5> <br><br>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="row">
                    <div class="col-sm-5 col-xs-6">
                      <div class="text-center">
                        <p>The Client</p> 
                        
                        <div class="rule">
                          <hr>
                        </div>

                        <h5 class="semi-bold">{{ $client_details->Customer ?? '-' }}</h5>

                        {{-- <p class="text-muted">Managing Director</p> --}}
                      </div>
                    </div>

                    <div class="col-sm-5 col-xs-6 col-md-offset-1">
                      <div class="text-center">
                        <p>Official Signature</p>
                        
                        <div class="rule">
                          <hr>
                        </div>

                        <h5 class="semi-bold">Motunrayo Awoniyi (Accountant)</h5>

                        {{-- <p class="text-muted">Managing Director</p> --}}
                      </div>
                    </div>


                  </div>
                </div>
                
              </div>
            </div>
            <!--/ Invoice Footer -->
          </div>
        </section>
  	<!-- END PANEL -->
@endsection

@push('scripts')
<script src="{{ asset('js/jquery-printme.min.js') }}"></script>
<script>
  var print_options = {
    "path": ["{{ asset('css/printmemo.css') }}"]
  }
  function print_bill() {
        return $(".card-box").printMe(print_options); 
    }
</script>
@endpush




