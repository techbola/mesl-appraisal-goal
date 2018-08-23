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
      <a target="_blank" href="{{ route('print_receipt.download', ['ref' => $cash_entry->CashEntryRef,'client_id' => $client_details->CustomerRef]) }}" class="btn btn-sm btn-secondary my-1 m-r-10"><i class="fa fa-share-square"></i> Export PDF</a>
      <a href="{{ route('send_receipt', ['ref' => $cash_entry->CashEntryRef,'client_id' => $client_details->CustomerRef]) }}" class="btn btn-sm  my-1"><i class="fa "></i> Send Receipt</a>
    </div>

  	<!-- START PANEL -->
  	<div id="print-area">
     <section class="card-box" style="width: 100%">
         @include('receipts.template')
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


</script>
@endpush




