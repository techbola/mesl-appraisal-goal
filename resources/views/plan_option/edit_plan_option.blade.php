{{ Form::open(['id' => 'plan_edit_data_form', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
            
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Payment Plan Name</label>
                    <input type="text" name="PlanOption" id="edit_PlanOption" class="form-control" required>
                  </div>
                </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label>Duration</label>
                    <input type="text" name="Duration" id="edit_Duration" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Payment Period</label>
                    <input type="text" name="PymtPeriod" id="edit_PymtPeriod" class="form-control" required>
                  </div>
                </div>

            <input type="hidden" name="OptionRef" id="edit_OptionRef">

            <div class="text-right m-t-10">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="submit_edit_form" class="btn btn-info">Submit</button>
            </div>
          {{Form::close()}}

          @push('scripts')
            <script>
              $('#submit_edit_form').click(function(event) {
                $.post('/submit_plan_option_edit_form', $('#plan_edit_data_form').serialize(), function(data, status) {
                    if(status == 'success')
                    {
                       location.reload();
                    }
                });
                return false;
              });
            </script>
          @endpush
          
