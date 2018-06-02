<div class="row">

  <div class="col-md-12">
    <div class="form-group">
      <label>Customer</label>
      <select class="full-width" name="CustomerID" data-init-plugin="select2" required>
        <option value="">Select one</option>
        @foreach ($customers as $customer)
          <option value="{{ $customer->CustomerRef }}">{{ $customer->Customer }}</option>
        @endforeach
      </select>
    </div>
  </div>

</div>
