<div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Vendor</label>
                    <input type="text" class="form-control" name="Vendor" placeholder="Enter Vendor" required>
                  </div>
                </div>
<!-- 
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Vendor Code</label>
                    <input type="text" class="form-control" name="VendorCode" placeholder="Enter Vendor Codee" required>
                  </div>
                </div> -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Company Phone</label>
                    <input type="text" class="form-control" name="CompanyPhone" placeholder="Enter Company Phone" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Contact Name</label>
                    <input type="text" class="form-control" name="ContactName" placeholder="Enter Contact Name" required>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <label>Contact Phone</label>
                    <input type="text" class="form-control" name="ContactPhone" placeholder="Enter Contact Phone" required>
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address 1</label>
                    <textarea class="form-control" name="AddressLine1" rows=2 required></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address 2</label>
                    <textarea class="form-control" name="AddressLine2" rows=2 required></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address 3</label>
                    <textarea class="form-control" name="AddressLine3" rows=2 required></textarea>
                  </div>
                </div>

              </div>
              <button type="submit" id="submit_vendor" class="btn btn-info btn-form pull-right">Submit</button>

              @push('scripts')
                <script>
                  $('#submit_vendor').click(function(event) {
                    $.post('/submit_vendor', $('#vendor_form').serialize(), function(data, status) {
                      if(status == 'success')
                      {
                        $('#new_project').modal('toggle');
                        $("##vendor_form")[0].reset();
                      }
                    });
                    return false;
                  });
                </script>
              @endpush