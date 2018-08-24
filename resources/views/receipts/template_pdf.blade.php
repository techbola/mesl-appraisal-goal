 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>
      @if(View::hasSection('title'))
        OfficeMate - @yield('title')
      @else
          OfficeMate
      @endif
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
     <meta charset="utf-8">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <link class="main-stylesheet" href="{{ asset('pages/css/pages.css') }}" rel="stylesheet" type="text/css" />

    {{-- Custom --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/white.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/printmemo.css') }}" media="screen">
  </head>
    <body>
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
                  <li></li>
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
                  <table class="table">
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
            <div id="invoice-footer" class="m-t-30">
              <span>Total Payments Received Till Date : </span>
              <span class="semi-bold"> <b>{!! nairazify(number_format($cash_entry->PaymentToDate, 2)) ?? '-' !!}</b></span> <br>

              <span>Outstanding Balance : </span>
              <span class="semi-bold"> <b>{!! nairazify(number_format($cash_entry->OutstandingBalance, 2)) ?? '-' !!}</b></span> <br>
              <span>Terms : </span>
              <span> {!! $cash_entry->Terms ?? '-' !!}</span> <br>

              <span>Amount in words : </span>
              <span>
                <b>{{ ucwords($amount_in_words) ?? '-'  }} Naira Only</b>
              </span> <br>
              <span>Bank transfer to : </span>
              <span>
                <b>{{ ucwords($cash_entry->gl_debit->Description) ?? '-' }}</b>
              </span> <br> 
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
        </body>
        </html>