{{ Form::open(['id' => 'plan_edit_data_form', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
            
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Payment Plan Name</label>
                    <input type="text" name="PlanName" id="edit_PlanName" class="form-control" required>
                  </div>
                </div>
              </div>

            <input type="hidden" name="PlanRef" id="edit_PymtPlanRef">

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
                       location.reload();
                    }
                });
                return false;
              });
            </script>
          @endpush
          
