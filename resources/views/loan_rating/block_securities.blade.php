 required<div class="row">

  <div class="col-md-6">
    <div class="form-group">
      <label>Borrowers Post Dated Cheques</label>
      <select class="full-width" name="BorrowersCheques" data-init-plugin="select2" name="BorrowersCheques" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $BorrowersCheques->One }}</option>
        <option value="2">{{ $BorrowersCheques->Two }}</option>
        <option value="3">{{ $BorrowersCheques->Three }}</option>
        <option value="4">{{ $BorrowersCheques->Four }}</option>
        <option value="5">{{ $BorrowersCheques->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Guarantors Post Dated Cheques</label>
      <select class="full-width" name="GuarantorsCheques" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $GuarantorsCheques->One }}</option>
        <option value="2">{{ $GuarantorsCheques->Two }}</option>
        <option value="3">{{ $GuarantorsCheques->Three }}</option>
        <option value="4">{{ $GuarantorsCheques->Four }}</option>
        <option value="5">{{ $GuarantorsCheques->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Additional Source Of Income Guarantee</label>
      <select class="full-width" name="AdditionalIncome" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $AdditionalIncome->One }}</option>
        <option value="2">{{ $AdditionalIncome->Two }}</option>
        <option value="3">{{ $AdditionalIncome->Three }}</option>
        <option value="4">{{ $AdditionalIncome->Four }}</option>
        <option value="5">{{ $AdditionalIncome->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Deed Of Mortgage</label>
      <select class="full-width" name="DeedOfMortgage" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $DeedOfMortgage->One }}</option>
        <option value="2">{{ $DeedOfMortgage->Two }}</option>
        <option value="3">{{ $DeedOfMortgage->Three }}</option>
        <option value="4">{{ $DeedOfMortgage->Four }}</option>
        <option value="5">{{ $DeedOfMortgage->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Vehicle Sales Purchase Agreement</label>
      <select class="full-width" name="VehicleAgreement" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $VehicleAgreement->One }}</option>
        <option value="2">{{ $VehicleAgreement->Two }}</option>
        <option value="3">{{ $VehicleAgreement->Three }}</option>
        <option value="4">{{ $VehicleAgreement->Four }}</option>
        <option value="5">{{ $VehicleAgreement->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Stock Hypothecation</label>
      <select class="full-width" name="StockHypothecation" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $StockHypothecation->One }}</option>
        <option value="2">{{ $StockHypothecation->Two }}</option>
        <option value="3">{{ $StockHypothecation->Three }}</option>
        <option value="4">{{ $StockHypothecation->Four }}</option>
        <option value="5">{{ $StockHypothecation->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Bank Guarantee</label>
      <select class="full-width" name="BankGuarantee" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="0">{{ $BankGuarantee->Zero }}</option>
        <option value="5">{{ $BankGuarantee->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Share Certificate</label>
      <select class="full-width" name="ShareCertificate" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $ShareCertificate->One }}</option>
        <option value="2">{{ $ShareCertificate->Two }}</option>
        <option value="3">{{ $ShareCertificate->Three }}</option>
        <option value="4">{{ $ShareCertificate->Four }}</option>
        <option value="5">{{ $ShareCertificate->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Deposits Certificate</label>
      <select class="full-width" name="DepositsCertificate" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $DepositsCertificate->One }}</option>
        <option value="2">{{ $DepositsCertificate->Two }}</option>
        <option value="3">{{ $DepositsCertificate->Three }}</option>
        <option value="4">{{ $DepositsCertificate->Four }}</option>
        <option value="5">{{ $DepositsCertificate->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Credit Search Report</label>
      <select class="full-width" name="CreditSearchReport" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $CreditSearchReport->One }}</option>
        <option value="2">{{ $CreditSearchReport->Two }}</option>
        <option value="3">{{ $CreditSearchReport->Three }}</option>
        <option value="4">{{ $CreditSearchReport->Four }}</option>
        <option value="5">{{ $CreditSearchReport->Five }}</option>
      </select>
    </div>
  </div>

</div>
