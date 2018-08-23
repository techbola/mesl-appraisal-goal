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

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="logout-url" content="{{ route('logout-url') }}">
    <meta name="timeout-url" content="{{ route('timeout-url') }}">

    <link rel="apple-touch-icon" href="{{ asset('pages/ico/60.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('pages/ico/76.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('pages/ico/120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('pages/ico/152.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />

    {{-- <link href="{{ asset('css/uikit.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/boostrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"> --}}

    <link href="{{ asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('assets/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.css') }}">
 {{-- <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}

     <link href="{{ asset('assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />
     <link href="{{ asset('pages/css/pages-icons.css') }}" rel="stylesheet" type="text/css">
     <link class="main-stylesheet" href="{{ asset('pages/css/pages.css') }}" rel="stylesheet" type="text/css" />
     {{-- Animate --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/animate/animate.min.css') }}">
    <link href="{{ asset('assets/plugins/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />

    {{-- Custom --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/white.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
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
        </body>
        </html>