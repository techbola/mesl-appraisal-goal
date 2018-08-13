{{ Form::open(['action' => 'PymtPlanController@store_payment_plan', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
            
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Payment Plan Name</label>
                    <input type="text" name="PlanName" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bill Rate</label>
                    <input type="text" name="BillRate" class="form-control" required>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Bill First Payment Date</label>
                  <div class="input-group date dp">
                      <input type="text" name="BillFirstPymtDate" class="form-control input-sm" v-model="item.PeriodTo" required>
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Bill No Of Pymt</label>
                  <input type="text" name="BillNoOfPymt" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>No Of Payment Per Year</label>
                  <input type="text" name="NoOfPymtPerYear" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Bill Last Payment No</label>
                  <input type="text" name="BillLastPymtNo" class="form-control">
                </div>
              </div>
            </div>

            <div class="text-right m-t-10">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="submit_a_form" class="btn btn-info">Submit</button>
            </div>

          {{Form::close()}}
