{{-- Row 1 --}}
<div class="row">

  <div class="col-md-6">
    <div class="form-group">
      <label>Amount Requested</label>
      <input type="text" name="LoanAmount" class="form-control autonumber" id="amount" placeholder="Enter loan amount" min="10" max="200000000" onkeyup="calc_rating()" required>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Interest Rate (%)</label>
      <select class="full-width" name="Rate" data-init-plugin="select2" onchange="calc_rating()" id="Rate" required>
        <option value="">Select One</option>
        <option value="2">{{ $Rate->Two }}</option>
        <option value="3">{{ $Rate->Three }}</option>
        <option value="4">{{ $Rate->Four }}</option>
        <option value="5">{{ $Rate->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Business Line</label>
      <select class="full-width" name="BusinessLine" data-init-plugin="select2" onchange="calc_rating()" id="BusinessLine" required>
        <option value="">Select One</option>
        <option value="1">{{ $BusinessLine->One }}</option>
        <option value="2">{{ $BusinessLine->Two }}</option>
        <option value="3">{{ $BusinessLine->Three }}</option>
        <option value="5">{{ $BusinessLine->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Office Address</label>
      <select class="full-width" name="OfficeAddress" data-init-plugin="select2" id="OfficeAddress" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $OfficeAddress->One }}</option>
        <option value="2">{{ $OfficeAddress->Two }}</option>
        <option value="3">{{ $OfficeAddress->Three }}</option>
        <option value="4">{{ $OfficeAddress->Four }}</option>
        <option value="5">{{ $OfficeAddress->Five }}</option>
      </select>
    </div>
  </div>

</div>

{{-- Row 2 --}}
<div class="row">

  <div class="col-md-6">
    <div class="form-group">
      <label>Residential Address</label>
      <select class="full-width" name="ResidentialAddress" data-init-plugin="select2" id="ResidentialAddress" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $ResidentialAddress->One }}</option>
        <option value="2">{{ $ResidentialAddress->Two }}</option>
        <option value="3">{{ $ResidentialAddress->Three }}</option>
        <option value="4">{{ $ResidentialAddress->Four }}</option>
        <option value="5">{{ $ResidentialAddress->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Purpose</label>
      <select class="full-width" name="Purpose" data-init-plugin="select2" id="Purpose" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $Purpose->One }}</option>
        <option value="2">{{ $Purpose->Two }}</option>
        <option value="3">{{ $Purpose->Three }}</option>
        <option value="4">{{ $Purpose->Four }}</option>
        <option value="5">{{ $Purpose->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Loan Type / Category</label>
      <select class="full-width" name="LoanType" data-init-plugin="select2" id="LoanType" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $LoanType->One }}</option>
        <option value="2">{{ $LoanType->Two }}</option>
        <option value="3">{{ $LoanType->Three }}</option>
        <option value="4">{{ $LoanType->Four }}</option>
        <option value="5">{{ $LoanType->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Period / Tenor</label>
      <select class="full-width" name="Period" data-init-plugin="select2" id="Period" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $Period->One }}</option>
        <option value="2">{{ $Period->Two }}</option>
        <option value="3">{{ $Period->Three }}</option>
        <option value="4">{{ $Period->Four }}</option>
        <option value="5">{{ $Period->Five }}</option>
      </select>
    </div>
  </div>

</div>
