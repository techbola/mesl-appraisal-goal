@extends('layouts.master')

@push('styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
@endpush

@section('page-title')
  Credit Rating
@endsection

@section('content')
  {{-- Start Main Row --}}
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      {{-- <h3 class="font-title theme-primary m-b-20">Loan Credit Rating</h3> --}}
      @include('errors.list')
      <form action="{{ route('save_loan_rating') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="card-box">
          <div class="card-title">
            Personal Information
          </div>
          @include('loan_rating.block_personal')
        </div>


        <div class="card-box">
          <div class="card-title">
            Application
          </div>
          @include('loan_rating.block_application')
        </div>


        <div class="card-box">
          <div class="card-title">
            Securities
          </div>
          @include('loan_rating.block_securities')
        </div>

        <div class="card-box">
          <div class="card-title">
            Risk & Repayment Sources
          </div>
          @include('loan_rating.block_risk')
        </div>

        <div class="card-box">
          <div class="card-title">
            Considerations
          </div>
          @include('loan_rating.block_considerations')
        </div>

        <input type="hidden" name="Score" value="0">
        <input type="hidden" name="PercentScore" value="0">

        <div class="text-center">
          <input type="submit" value="Submit" class="btn btn-lg btn-info btn-cons text-center">
        </div>

      </form>
    </div>

    <div class="col-md-2" style="margin-top:62px">
      <div class="text-center" style="position:fixed">
        <span class="theme-primary text-uppercase f16" style="font-weight:bold; color:#665;text-shadow:2px 5px 10px #ccc">CREDIT SCORE</span>
        <br>
        <div id="score" class="m-t-10" style="font-size:20px;"></div>
        <div id="percent" class="text-info m-t-25" style="font-size:45px;">0%</div>
      </div>
    </div>

  </div>
  {{-- End Main Row --}}


@endsection

@push('scripts')
  <script src="{{ asset("assets/plugins/autonumeric/autoNumeric.min.js") }}" charset="utf-8"></script>
  {{-- <script src="{{ asset("assets/plugins/autonumeric/AutoNumeric.js") }}" charset="utf-8"></script> --}}

  {{-- Format Amount Field --}}
  <script>
    var amount_AN = new AutoNumeric('#amount', {
        currencySymbol : '₦ ',
        decimalCharacter : '.',
        // digitGroupSeparator : ',',
        unformatOnSubmit: true,
        modifyValueOnWheel: false,
        minimumValue: 0,
        decimalPlaces: 0,
        decimalPlacesRawValue: 0,
    });
    // $('#amount').autoNumeric('init');
  </script>

  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script>
      $(function(){
        var options = {
          todayHighlight: true,
          format: 'yyyy-mm-dd',
          autoclose: true,
        };
        $('.dp').datepicker(options);
      });
    </script>

    <script>
      function calc_rating() {
        var rating = 0;
        var amount = parseInt( amount_AN.getNumericString() );
        console.log(amount);
        // var amount = parseInt( $("input[name='LoanAmount']").val() );
        var Rate = parseInt( $("#Rate").val() );
        var BusinessLine = parseInt( $("#BusinessLine").val() );
        var OfficeAddress = parseInt( $("#OfficeAddress").val() );
        var ResidentialAddress = parseInt( $("#ResidentialAddress").val() );
        var Purpose = parseInt( $("#Purpose").val() );
        var LoanType = parseInt( $("#LoanType").val() );
        var Period = parseInt( $("#Period").val() );
        var BorrowersCheques = parseInt( $("select[name='BorrowersCheques']").val() );
        var GuarantorsCheques = parseInt( $("select[name='GuarantorsCheques']").val() );
        var AdditionalIncome = parseInt( $("select[name='AdditionalIncome']").val() );
        var DeedOfMortgage = parseInt( $("select[name='DeedOfMortgage']").val() );
        var VehicleAgreement = parseInt( $("select[name='VehicleAgreement']").val() );
        var StockHypothecation = parseInt( $("select[name='StockHypothecation']").val() );
        var BankGuarantee = parseInt( $("select[name='BankGuarantee']").val() );
        var ShareCertificate = parseInt( $("select[name='ShareCertificate']").val() );
        var DepositsCertificate = parseInt( $("select[name='DepositsCertificate']").val() );
        var CreditSearchReport = parseInt( $("select[name='CreditSearchReport']").val() );
        var PaymentDefault = parseInt( $("select[name='PaymentDefault']").val() );
        var FundDiversion = parseInt( $("select[name='FundDiversion']").val() );
        var RepaymentPrimary = parseInt( $("select[name='RepaymentPrimary']").val() );
        var RepaymentSecondary = parseInt( $("select[name='RepaymentSecondary']").val() );
        var RepaymentOthers = parseInt( $("select[name='RepaymentOthers']").val() );
        var HasJob = parseInt( $("select[name='HasJob']").val() );
        var SecuritySufficient = parseInt( $("select[name='SecuritySufficient']").val() );
        var InformationConsistent = parseInt( $("select[name='InformationConsistent']").val() );
        var PurposeValue = parseInt( $("select[name='PurposeValue']").val() );
        var JobExperience = parseInt( $("select[name='JobExperience']").val() );

        if (amount >= 50000000) { // 50M and above
          rating += 1;
        } else if (amount >= 20000000 && amount < 50000000 ){ // 20M (inclusive) - 50M
          rating += 2;
        } else if (amount >= 10000000 && amount < 20000000 ){ // 10M (inclusive) - 20M
          rating += 3;
        } else if (amount >= 5000000 && amount < 10000000 ){ // 5M (inclusive) - 10M
          rating += 4;
        } else if (amount >= 0 && amount < 5000000 ){ // 0 (inclusive) - 5M
          rating += 5;
        }

        if(Rate)
          rating += Rate;
        if(BusinessLine)
          rating += BusinessLine;
        if(OfficeAddress)
          rating += OfficeAddress;
        if(ResidentialAddress)
          rating += ResidentialAddress;
        if(Purpose)
          rating += Purpose;
        if(LoanType)
          rating += LoanType;
        if(Period)
          rating += Period;
        if(BorrowersCheques)
          rating += BorrowersCheques;
        if(GuarantorsCheques)
          rating += GuarantorsCheques;
        if(AdditionalIncome)
          rating += AdditionalIncome;
        if(DeedOfMortgage)
          rating += DeedOfMortgage;
        if(VehicleAgreement)
          rating += VehicleAgreement;
        if(StockHypothecation)
          rating += StockHypothecation;
        if(BankGuarantee)
          rating += BankGuarantee;
        if(ShareCertificate)
          rating += ShareCertificate;
        if(DepositsCertificate)
          rating += DepositsCertificate;
        if(CreditSearchReport)
          rating += CreditSearchReport;
        if(PaymentDefault)
          rating += PaymentDefault;
        if(FundDiversion)
          rating += FundDiversion;
        if(RepaymentPrimary)
          rating += RepaymentPrimary;
        if(RepaymentSecondary)
          rating += RepaymentSecondary;
        if(RepaymentOthers)
          rating += RepaymentOthers;
        if(HasJob)
          rating += HasJob;
        if(SecuritySufficient)
          rating += SecuritySufficient;
        if(InformationConsistent)
          rating += InformationConsistent;
        if(PurposeValue)
          rating += PurposeValue;
        if(JobExperience)
          rating += JobExperience;

        var percent = Math.round(rating / 140 * 100);

        $("#score").html(rating + '<span class="text-muted"> / 140</span>');
        $("#percent").text(percent + '%');

        $("input[name='Score']").val(rating);
        $("input[name='PercentScore']").val(percent);
      }
    </script>


@endpush
