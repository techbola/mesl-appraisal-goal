<!-- SHOW IDENTITY CARD MODAL -->
<div class="modal fade" id="add-identity-card-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="lead"> <i class="fa fa-user"></i> Create New ID Card Request</h4>
      </div>
      <div class="modal-body">
        <hr />
        <form method="post" action="{{ url('identity/card/create') }}" enctype="multi-part/form-data">
        	{{ csrf_field() }}
        	<div class="row">
	            <div class="col-md-6">
	              	<div class="form-group">
	              		<div id="preview_passport_image"></div>
	                	<input type="file" id="card_passport" name="card_passport" onchange="readURL(this)" class="form-control small" required="">
	              	</div>
	            </div>
	        </div>
	        
	        <br />

        	<div class="row">
	            <div class="col-md-6">
	              	<div class="form-group">
	                	<label>Employee's Name</label>
	                	<select class="form-control" id="staff_name" name="staff_id"></select>
	              	</div>
	            </div>
	            <div class="col-md-6">
	            	<div class="form-group">
	                	<label>Department's Name</label>
	                	<select class="form-control" id="department_name" name="department_id"></select>
	              	</div>
	            </div>
	        </div>

	        <br />
	        <div class="row">
	            <div class="col-md-6">
	              	<div class="form-group">
	                	<label>Staff Identity Number</label>
	                	<input type="text" id="staff_id_number" class="form-control" name="staff_id_number" required="">
	              	</div>
	            </div>
	        </div>
	        
	        <br />
	        <div class="row">
	            <div class="col-md-12">
	            	<div class="form-group">
	                	<label>Purpose of Request</label>
	                	<div class="row">
	                		<div class="col-sm-4">
	                			<div class="checkbox checkbox-info">
			                		<input type="checkbox" name="reason_1" id="reason_1" />
			                		<label for="reason_1">
			                			Lost/Stolen
		                			</label>
		                		</div>
	                		</div>
	                		<div class="col-sm-4">
	                			<div class="checkbox checkbox-info">
		                			<input type="checkbox" name="reason_2" id="reason_2" />
		                			<label for="reason_2">
		                				Not Received
	                				</label>
	                			</div>
	                		</div>
	                		<div class="col-sm-4">
	                			<div class="checkbox checkbox-info">
		                			<input type="checkbox" name="reason_3" id="reason_3" />
		                			<label for="reason_3">
		                				New Employee
	                				</label>
	                			</div>
	                		</div>
	                	</div>
	              	</div>
	            </div>
	        </div>


	        <br />
	        <div class="row">
	            <div class="col-md-6">
	              	<div class="form-group">
	                	<label>Expected Date</label>
	                	<div class="input-group date dp">
	                		<input type="date" id="expected_request_date" class="form-control" name="expected_request_date" required="">
		                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                </div>
	                	
	              	</div>
	            </div>
	        </div>
	        <br />
	        
	        <div class="row">
	            <div class="col-md-6">
	              	<div class="form-group">
	                	<button class="btn btn-info" id="add-department-btn">
	                  		Submit Request
	                	</button>
	              	</div>
	            </div>
	        </div>
        </form>
        <hr />
      </div>
      <div class="modal-footer">
        <div class="pull-right">
          <button class="btn btn-flat" type="button" data-dismiss="modal">
            close
          </button>
        </div>
      </div>
    </div>
  </div>
</div>