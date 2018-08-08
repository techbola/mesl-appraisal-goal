@extends('layouts.master')

@push('styles')
  <link href='https://fonts.googleapis.com/css?family=Jaldi:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('assets/plugins/cd/accordion/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/cd/accordion/style-white.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/loading/progress/loading-bar.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/pages/css/themes/light.css') }}">
@endpush

@section('content')

    {{-- START CARD --}}
    <div class="card card-default m-t-20" style="width: 100%">
    <div class="card-block">
        <div class="invoice padding-50 sm-padding-10">
            <div>
                <div class="pull-left">
                    <img style="width: 150px" alt="" class="invoice-logo" data-src-retina="{{ asset('images/officemate.png') }}" data-src="{{ asset('images/officemate.png') }}" src="{{ asset('images/officemate.png') }}">
                    <address class="m-t-10">
                      {{-- Apple Enterprise Sales --}}
                      {{-- <br>(877) 412-7753. --}}
                      <br>
                    </address>
                </div>
                <div class="pull-right sm-m-t-20">
                    <h2 class="font-montserrat all-caps hint-text">PAYSLIP</h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <br>
            <br>
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-9 col-sm-height sm-no-padding">
                        <p class="small no-margin">Payslip For</p>
                        <h5 class="semi-bold m-t-0">{{ auth()->user()->staff->Fullname }}</h5>
                        <address>                          
                          <br>
                           <strong>Month/Year: </strong> {{ $payslip_detail->PayMonthYear ?? '-' }}
                        </address>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-sm-6">
                  <h5 class="text-primary">Earnings</h5>
                  <table class="table table-bordered table-condensed m-t-10">
                    <thead>
                        <tr>
                            <th class="">Description</th>
                            <th class="text-right">Gross Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="">
                                <p class="text-black">Basic</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Basic,2)) }}</td>
                        </tr>
                        <tr>
                          <td class="">
                                <p class="text-black">Housing</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Housing,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Transport</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Transport,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Furniture</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Furniture,2)) }}</td>
                        </tr>
                        <tr>
                          <td class="">
                                <p class="text-black">Vehicle Mt'ce</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Vehicle,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Driver, Family & Oths.                </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Others,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Lunch & Beverage </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->LunchVoucher,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Dressing </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Dressing,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Prof & Club                    </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->ClubandProfessionalPymt,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Leave Arrears</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->LeaveArrears,2)) }}</td>
                        </tr>
                        <tr>
                          <td class="">
                                <p class="text-black">13th Month Bonus </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Month13Bonus,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Upfront Housing                 </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->UpfrontHousingPymt,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Upfront Furnishing</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Basic,2)) }}</td>
                        </tr>
                       <tr>
                        <td class="">
                                <p class="text-black"> Leave Allowance                    </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Basic,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Telephone Subsidy                  </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Basic,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Other Allowances     </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->OtherAllowances,2)) }}</td>
                        </tr> 
                    </tbody>
                </table>
                </div>
                <div class="col-sm-6">
                  <h5 class="text-primary">Deductions</h5>
                  <table class="table table-condensed table-bordered m-t-10">
                    <thead>
                        <tr>
                            <th class="">Description</th>
                            <th class="text-right">Deducted Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="">
                                <p class="text-black">Tax</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Basic,2)) }}</td>
                        </tr>
                        <tr>
                          <td class="">
                                <p class="text-black">Pension Statutory</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Housing,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">NHF</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->NHF,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Welfare</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Welfare,2)) }}</td>
                        </tr>
                        <tr>
                          <td class="">
                                <p class="text-black">Meal Voucher</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Vehicle,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Upfront Housing                 </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->UpfrontHousingPymt,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Upfront Furnishing</p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->Basic,2)) }}</td>
                        </tr>
                       <tr>
                        <td class="">
                                <p class="text-black"> Co-operative                    </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->CICS,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Staff Loan                 </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->LoanDeduction,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Pension Voluntary        </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->VoluntaryPensionContribution,2)) }}</td>
                        </tr>  
                        <tr>
                          <td class="">
                                <p class="text-black">Car Loan     </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->CarLoan,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Development Levy                    </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->DevelopmentLevy,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Trust Fund                    </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->TrustFund,2)) }}</td>
                        </tr> 
                        <tr>
                          <td class="">
                                <p class="text-black">Other Deductions                    </p>
                            </td>
                            <td class="text-right">{{ nairazify(number_format($payslip_detail->OtherDeductions,2)) }}</td>
                        </tr> 
                    </tbody>
                </table>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="p-l-15 p-r-15">
                <div class="row b-a b-grey">
                    <div class="col-md-2 p-l-15 sm-p-t-15 clearfix sm-p-b-15 d-flex flex-column justify-content-center">
                        <h5 class="font-montserrat all-caps small no-margin hint-text bold">Total Deductions</h5>
                        <h3 class="no-margin"></h3>
                    </div>
                    <div class="col-md-5 clearfix sm-p-b-15 d-flex flex-column justify-content-center">
                        <h5 class="font-montserrat all-caps small no-margin hint-text bold">Total Gross Earnings</h5>
                        <h3 class="no-margin"></h3>
                    </div>
                    <div class="col-md-5 text-right bg-master-darker col-sm-height padding-15 d-flex flex-column justify-content-center align-items-end">
                        <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Net Pay</h5>
                        <h1 class="no-margin text-white">{{ nairazify(number_format($payslip_detail->NetPay, 2)) }}</h1>
                    </div>
                </div>
            </div>
            <hr>
            <div>
                <img src="{{ asset('images/officemate.png') }}" alt="logo" data-src="assets/img/logo.png" data-src-retina="{{ asset('images/officemate.png') }}" style="width: 100px !important">
                <span class="m-l-70 text-black sm-pull-right">+234 000 000 0000</span>
                <span class="m-l-40 text-black sm-pull-right">email@company.com</span>
            </div>
        </div>
    </div>
</div>
    {{-- END CARD --}}

  @endsection

  @push('scripts')
    <script src="{{ asset('assets/plugins/cd/accordion/main.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/plugins/loading/progress/loading-bar.min.js') }}" charset="utf-8"></script>
  @endpush
