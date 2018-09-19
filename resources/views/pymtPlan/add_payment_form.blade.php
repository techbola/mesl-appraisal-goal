{{ Form::open(['action' => 'PymtPlanController@store_payment_plan', 'autocomplete' => 'off', 'role' => 'form']) }}
            
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Payment Plan Name</label>
                    <input type="text" name="PlanName" class="form-control" required>
                  </div>
                </div>
              </div>

            <div class="text-right m-t-10">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="submit_a_form" class="btn btn-info">Submit</button>
            </div>

          {{Form::close()}}
