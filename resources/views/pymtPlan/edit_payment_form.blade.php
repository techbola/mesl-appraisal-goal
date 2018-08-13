{{ Form::open(['id' => 'plan_edit_data_form', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
            
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Payment Plan Name</label>
                    <input type="text" name="PlanName" id="edit_PlanName" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bill Rate</label>
                    <input type="text" name="BillRate" id="edit_BillRate" class="form-control" required>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Bill First Payment Date</label>
                  <div class="input-group date dp">
                      <input type="text" name="BillFirstPymtDate" id="edit_BillFirstPymtDate" class="form-control input-sm" required>
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Bill No Of Pymt</label>
                  <input type="text" name="BillNoOfPymt" id="edit_BillNoOfPymt" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>No Of Payment Per Year</label>
                  <input type="text" name="NoOfPymtPerYear" id="edit_NoOfPymtPerYear" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Bill Last Payment No</label>
                  <input type="text" name="BillLastPymtNo" id="edit_BillLastPymtNo" class="form-control">
                </div>
              </div>
            </div>

            <input type="hidden" name="PymtPlanRef" id="edit_PymtPlanRef">

            <div class="text-right m-t-10">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="submit_edit_form" class="btn btn-info">Submit</button>
            </div>
          {{Form::close()}}

          @push('scripts')
            <script>
              $('#submit_edit_form').click(function(event) {
                $.post('/submit_plan_edit_form', $('#plan_edit_data_form').serialize(), function(data, status) {
                    if(status == 'success')
                    {
                      $('#payment_plan_table_body').html(' ');
                       $.each(data, function(index, val) {
                          $('#payment_plan_table_body').append(`
                              <tr>
                                  <td>${id++}</td>
                                  <td>${data.PlanName}</td>
                                  <td>${data.BillRate}</td>
                                  <td>${data.BillFirstPymtDate }</td>
                                  <td>${data.BillNoOfPymt }</td>
                                  <td>${data.NoOfPymtPerYear }</td>
                                  <td>${data.BillLastPymtNo }</td>
                                  <td><a href="#" class="btn btn-xs btn-info edit_plan" data-id="${data.PymtPlanRef}" data-toggle="modal" data-target="#edit_item">Edit</a></td>
          <td><a href="#" class="btn btn-xs btn-danger">Delete</a></td>
                              </tr> 
                            `);
                          $('#edit_item').modal('toggle');
                      $("#plan_edit_data_form")[0].reset();
                       });
                    }
                });
                return false;
              });
            </script>
          @endpush
          
