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

    .address{
      display: block;
      clear: both;
    }

    img {
    max-width: 500px;
    }

}  
.card-box * {
      font-size: 18px !important;
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
      <button type="button" class="btn btn-sm btn-complete my-1 m-r-10" onclick="print_bill()"><i class="fa fa-paper-plane-o"></i> Print Receipt</button>
      <a href="#" onclick="makePDF()"  class="btn btn-sm btn-secondary my-1 m-r-10" ><i class="fa fa-share-square"></i> Export PDF</a>
      <a href="{{ route('send_receipt', ['ref' => $cash_entry->CashEntryRef,'client_id' => $client_details->CustomerRef]) }}" class="btn btn-sm  my-1"><i class="fa "></i> Send Receipt</a>
    </div>

  	<!-- START PANEL -->
  	<div id="print-area">
     <section class="card-box" style="width: 100%">
          <div id="invoice-template" class="card-body">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
              <div class="col-md-6 col-sm-12  text-left">
                @if(!is_null($cash_entry->BrandID))
                  <div class="media">
                  <img style="margin: 0 !important" src="{{ asset("images/logos/".$cash_entry->brand->LogoLocation) }}" alt="company logo" width="170px" class=" logo"> 
                </div>
                @else
                <div class="media">
                  <img style="margin: 0 !important" src="{{ asset("images/logos/lekkigardens.jpg") }}" alt="company logo" width="170px" class=" logo">
                  <div class="m-t-25">
                    {{-- {!! str_replace(',', ',<br>', $narrations->brand->Address) !!} --}}
                  </div>
                </div>
                @endif
                <div class="m-t-25 address">
                    {!! str_replace(',', ',<br>', $cash_entry->brand->Address ?? '-') !!}
                  </div>
              </div>
              <div class="col-md-6 col-sm-12  text-right">
                <h2>RECEIPT</h2>
                <p class="pb-3"># {{ 'BNKRCPOM'.$cash_entry->CashEntryRef }}</p>
                <ul class="px-0 list-unstyled hide">
                  <li>Balance Due</li>
                  <li class="lead text-bold-800">{{-- nairazify(number_format(0.00, 2)) --}}</li>
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
                  <li><span class="text-muted m-r-10">Email:</span> <span class="text">{{ $client_details->Email ?? '-' }}</span></li>
                  <li><span class="text-muted m-r-10">Phone No:</span> <span class="">{{ $client_details->Phone ?? '-' }}</span></li>
                   <li>
                    <span class="text-muted m-r-10">Address:</span> <span class="">{{ $client_details->Address ?? '-' }}</span>
                   </li>
                </ul>
              </div>
              <div class="col-md-6 col-sm-12  text-right">
                <p>
                  <span class="text-muted m-r-10">Receipt Date</span> {{ nice_date($cash_entry->ValueDate) }}</p>
                <p>
                  <span class="text-muted m-r-10">Account Manager</span> <b>{{ $client_details->account_manager->AccountManager ?? 'Somebody Here' }}</b></p>
                <p>
                  <span class="text-muted m-r-10">Contact Number</span>{{ $client_details->account_manager->MobileNumber ?? '-' }}</p>
              </div>
            </div> <hr>
            <!--/ Invoice Customer Details -->
            <!-- Invoice Items Details -->
            
            <div id="invoice-items-details" class="pt-2">
              <div class="row">
                <div class="table-responsive col-sm-12">
                  <table class="table ">
                    <thead>
                      <tr>
                        <th width="40%" class="text-left">Product(s)</th>
                        <th class="text-left">Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style="width: 40%">
                          <p>{!! $cash_entry->product->ProductCategory ?? '-' !!}</p>
                        </td>
                        <td>{!! $cash_entry->Description ?? '-' !!}</td>
                      </tr>
                    </tbody>
                    {{-- <tfoot>
                      <td></td>
                      <td class="text-right"><b>TOTAL</b></td>
                      <td class="text-right"><b>{{ nairazify(number_format($cash_entry->Amount,2)) }}</b></td>
                    </tfoot> --}}
                  </table>
                </div>
              </div>
            </div>

            <h4 class="text-center semi-bold m-t-15 m-b-15"></h4>
            <div id="invoice-items-details" class="pt-2">
              <div class="row">
                <div class="table-responsive col-sm-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">S/N</th>
                        <th class="text-left">Description</th>
                        <th class="text-right">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="text-center" scope="row">1</th>
                        <td>
                          <p>{!! $narrations->Narration ?? $cash_entry->Narration !!}</p>
                        </td>
                        <td class="text-right">{{ nairazify(number_format($cash_entry->Amount,2)) }}</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <td></td>
                      <td class="text-right"><b>TOTAL</b></td>
                      <td class="text-right"><b>{{ nairazify(number_format($cash_entry->Amount,2)) }}</b></td>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <!-- Invoice Footer -->
            <div id="invoice-footer" class="m-t-100">
              <span>Mode of Payment : </span>
              <span> {!! $cash_entry->ModeOfPayment ?? '-' !!}</span> <br>
              <span>Total Payments Received Till Date : </span>
              <span class="semi-bold"> <b>{!! nairazify(number_format($cash_entry->PaymentToDate, 2)) ?? '-' !!}</b></span> <br><br>

              <span>Outstanding Balance : </span>
              <span class="semi-bold"> <b>{!! nairazify(number_format($cash_entry->OutstandingBalance, 2)) ?? '-' !!}</b></span> <br><br>
              <span>Terms : </span>
              <span> {!! $cash_entry->Terms ?? '-' !!}</span> <br>

              <span>Amount in words : </span>
              <span>
                <b>{{ ucwords($amount_in_words) ?? '-'  }} Naira Only</b>
              </span> <br>
              <span>Bank transfer to : </span>
              <span>
                <b>{{ ucwords($cash_entry->gl_debit->Description) ?? '-' }}</b>
              </span> <br> <br><br>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="row">
                    <div class="col-sm-5 col-xs-6">
                      <div class="text-center">
                        {{-- <p>The Client</p>  --}}
                        
                        <div class="rule" style="height: 70px; border-bottom: 1px solid #eee; margin-right: 10px">
                          {{-- <img src="{{ asset('images/signature-scan.png') }}" width="100"  alt="sample signature"> --}}
                          {{-- <hr> --}}
                        </div>

                        <h5 class="semi-bold">{{ $client_details->Customer ?? '-' }}</h5>

                        {{-- <p class="text-muted">Managing Director</p> --}}
                      </div>
                    </div>

                    <div class="col-sm-5 col-xs-6 col-md-offset-1">
                      <div class="text-center">
                       @if(!is_null($cash_entry->SignatoryID))
                        @if($cash_entry->signatory->SignatureLocation != null)                       
                        <div class="rule" style="height: 70px; border-bottom: 1px solid #eee; margin-right: 10px">
                          <img src="{{ asset("images/".$cash_entry->signatory->SignatureLocation) }}" width="100"  alt="sample signature">
                        </div>
                        @else
                        <div class="rule" style="height: 70px; border-bottom: 1px solid #eee">
                          <img src="{{ asset("images/signature-scan.png") }}" width="100"  alt="sample signature">
                          <hr>
                        </div>
                        @endif

                       
                       @endif
                       @if(!is_null($cash_entry->SignatoryID))
                        <h5 class="semi-bold">{{ $cash_entry->signatory->fullName }} (Accountant)</h5>
                        @else
                         <div class="rule" style="height: 70px">
                          
                          {{-- <hr> --}}
                        </div>
                        <h5 class="semi-bold">No Signatory (Accountant)</h5>
                       @endif

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
    </div>
  	<!-- END PANEL -->
@endsection

@push('scripts')

<script src="{{ asset('js/jquery-printme.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="{{ asset('js/jspdf.debug.js') }}"></script>
<script src="{{ asset('js/from-html.js') }}"></script>
<script>
  var print_options = {
    "path": ["{{ asset('css/printmemo.css') }}"]
  }
  function print_bill() {
        return $(".card-box").printMe(print_options); 
  }

  //  export to pdf



  // This code is collected but useful, click below to jsfiddle link.
function makePDF() {

    var quotes = document.getElementById('invoice-template');

    html2canvas(quotes, {
        onrendered: function(canvas) {
        //! MAKE YOUR PDF
        var pdf = new jsPDF('p', 'pt', 'letter');
        // pdf.setFontSize(16);

        for (var i = 0; i <= quotes.clientHeight/980; i++) {
            //! This is all just html2canvas stuff
            var srcImg  = canvas;
            var sX      = 0;
            var sY      = 0*i; // start 980 pixels down for every new page
            var sWidth  = 3000;
            var sHeight = 2700;
            var dX      = 0;
            var dY      = 0;
            var dWidth  = 3000;
            var dHeight = 2700;

            window.onePageCanvas = document.createElement("canvas");
            onePageCanvas.setAttribute('width', 3000);
            onePageCanvas.setAttribute('height', 2700);
            var ctx = onePageCanvas.getContext('2d');
            // details on this usage of this function: 
            // https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial/Using_images#Slicing
            ctx.drawImage(srcImg,sX,sY);

            // document.body.appendChild(canvas);
            var canvasDataURL = onePageCanvas.toDataURL("image/png", 0.2);

            var width         = onePageCanvas.width;
            var height        = onePageCanvas.clientHeight;

            //! If we're on anything other than the first page,
            // add another page

            //! now we add content to that page!
            
            pdf.setFontSize(14);
            pdf.addImage(canvasDataURL, 'PNG', 40, 40, (width*.42), (height*.62));
        }
        //! after the for loop is finished running, we save the pdf.
        pdf.save('Receipt.pdf');
    }
  });
}

</script>
@endpush




