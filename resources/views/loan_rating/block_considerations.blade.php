<div class="row">

  <div class="col-md-6">
    <div class="form-group">
      <label>Do They Have A Job?</label>
      <select class="full-width" name="HasJob" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="0">{{ $HasJob->Zero }}</option>
        <option value="5">{{ $HasJob->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Is The Security Sufficient?</label>
      <select class="full-width" name="SecuritySufficient" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="2">{{ $SecuritySufficient->Two }}</option>
        <option value="3">{{ $SecuritySufficient->Three }}</option>
        <option value="4">{{ $SecuritySufficient->Four }}</option>
        <option value="5">{{ $SecuritySufficient->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Is The Information Provided During Interview Consistent With Record of Facts?</label>
      <select class="full-width" name="InformationConsistent" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $InformationConsistent->One }}</option>
        <option value="2">{{ $InformationConsistent->Two }}</option>
        <option value="3">{{ $InformationConsistent->Three }}</option>
        <option value="4">{{ $InformationConsistent->Four }}</option>
        <option value="5">{{ $InformationConsistent->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>Will The Purpose Of Loan Add Value To The Organization and Working Capital?</label>
      <select class="full-width" name="PurposeValue" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="0">{{ $PurposeValue->Zero }}</option>
        <option value="5">{{ $PurposeValue->Five }}</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>How Many Years Of On Job Experience?</label>
      <select class="full-width" name="JobExperience" data-init-plugin="select2" onchange="calc_rating()" required>
        <option value="">Select One</option>
        <option value="1">{{ $JobExperience->One }}</option>
        <option value="2">{{ $JobExperience->Two }}</option>
        <option value="3">{{ $JobExperience->Three }}</option>
        <option value="4">{{ $JobExperience->Four }}</option>
        <option value="5">{{ $JobExperience->Five }}</option>
      </select>
    </div>
  </div>

</div>
