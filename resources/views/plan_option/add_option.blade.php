{{ Form::open(['action' => 'PlanOptionController@store_plan_option', 'autocomplete' => 'off', 'role' => 'form']) }}
            
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Payment Plan Name</label>
                    <input type="text" name="PlanOption" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Duration</label>
                    <input type="text" name="Duration" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Payment Period</label>
                    <input type="text" name="PymtPeriod" class="form-control" required>
                  </div>
                </div>
              </div>

            <div class="text-right m-t-10">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="submit_a_form" class="btn btn-info">Submit</button>
            </div>

          {{Form::close()}}
