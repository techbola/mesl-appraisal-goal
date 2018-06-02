<div class="row">

  <div class="col-md-6">
    <div class="form-group">
      <label>Default In Payment</label>
      <select class="full-width" name="PaymentDefault" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $PaymentDefault->One }}</option>
        <option value="2">{{ $PaymentDefault->Two }}</option>
        <option value="3">{{ $PaymentDefault->Three }}</option>
        <option value="4">{{ $PaymentDefault->Four }}</option>
        <option value="5">{{ $PaymentDefault->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Diversion Of Fund</label>
      <select class="full-width" name="FundDiversion" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $FundDiversion->One }}</option>
        <option value="2">{{ $FundDiversion->Two }}</option>
        <option value="3">{{ $FundDiversion->Three }}</option>
        <option value="4">{{ $FundDiversion->Four }}</option>
        <option value="5">{{ $FundDiversion->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Repayment Source (Primary)</label>
      <select class="full-width" name="RepaymentPrimary" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $RepaymentPrimary->One }}</option>
        <option value="2">{{ $RepaymentPrimary->Two }}</option>
        <option value="3">{{ $RepaymentPrimary->Three }}</option>
        <option value="4">{{ $RepaymentPrimary->Four }}</option>
        <option value="5">{{ $RepaymentPrimary->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Repayment Source (Secondary)</label>
      <select class="full-width" name="RepaymentSecondary" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $RepaymentSecondary->One }}</option>
        <option value="2">{{ $RepaymentSecondary->Two }}</option>
        <option value="3">{{ $RepaymentSecondary->Three }}</option>
        <option value="4">{{ $RepaymentSecondary->Four }}</option>
        <option value="5">{{ $RepaymentSecondary->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Repayment Source (Others)</label>
      <select class="full-width" name="RepaymentOthers" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $RepaymentOthers->One }}</option>
        <option value="2">{{ $RepaymentOthers->Two }}</option>
        <option value="3">{{ $RepaymentOthers->Three }}</option>
        <option value="4">{{ $RepaymentOthers->Four }}</option>
        <option value="5">{{ $RepaymentOthers->Five }}</option>
      </select>
    </div>
  </div>

</div>
