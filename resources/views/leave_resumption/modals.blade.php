<!-- Create leave resumption modal-->
<div class="modal fade" id="create-leave-resumption" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Create a Leave Resumption Request</h4>
      </div>
      <div class="modal-body">
        <hr />
        <form method="post" id="add-leave-resume-form" onsubmit="return addLeaveResumption()">
          <input type="hidden" id="riskmgt_id" name="">
          <input type="hidden" id="hrmgt_id" name="">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Employee Name</label>
                <select id="staff_name" class="form-control">
                  <option value="0">-- Select Staff --</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Enter Staff Department</label>
                <select id="department_name" class="form-control">
                  <option value="0">-- Select Department --</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Office Location</label>
                <select id="office_location" class="form-control">
                  <option value="0">-- Select Location --</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group deparment-supervisor">
                
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Leave commernce date</label>
                <div class="input-group date dp">
                  <input type="date" id="leave_commernce_date" class="form-control" required="">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Leave resumption date</label>
                <div class="input-group date dp">
                  <input type="date" id="leave_resumption_date" class="form-control" required="">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>No of Leave days taken</label>
                <input type="text" id="leave_days_taken" class="form-control" readonly="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>No of Leave days used</label>
                <input type="text" id="leave_days_used" class="form-control" readonly="">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>No of Leave days remaining</label>
                <input type="text" id="leave_days_left" class="form-control" readonly="">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Date resumed</label>
                <div class="input-group date dp">
                  <input type="date" id="new_resume_date" class="form-control">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Reason for late resumption (Optional)</label>
                <textarea id="late_resumption_reason" class="form-control" placeholder="Start typing..."></textarea>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <button class="btn btn-info" id="add-leave-resume-btn">
                  Send Leave Resumption Request
                </button>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <span class="text-danger">Note:</span>
              <p class="small">
                PLEASE NOTE THAT FAILURE TO RETURN TO DUTY ON THE ACTUAL RESUMPTION DATE WITHOUT ANY ACCEPTABLE EXCUSE WILL BE TREATED AS UNAUTHORISED ABSENCE.
              </p>
            </div>
          </div>
        </form>
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

<!-- Edit leave resumption modal-->
<div class="modal fade" id="edit-leave-resumption" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4><span class="edit-department-name"></span></h4>
      </div>
      <div class="modal-body">
        <hr />
        <form method="post" id="edit-department-form" onsubmit="return updateDepartment()">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Enter Department Name</label>
                <input type="text" id="edit_department_name" class="form-control" placeholder="Enter project name..">
                <input type="hidden" id="edit_department_id">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <button class="btn btn-info">
                  Update Department
                </button>
              </div>
            </div>
          </div>
        </form>
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

<!-- View leave resumption modal -->
<div class="modal fade" id="view-leave-resumption" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>View Leave Resumption Request</h4>
      </div>
      <div class="modal-body">
        <hr />
        <div class="show-approvers"></div>
        <table class="table">
          <tbody>
            <tr>
              <td><b>Employee Name</b></td>
              <td>
                <span class="lr-view-employee-name"></span>
              </td>
            </tr>
            <tr>
              <td><b>Supervisor Name</b></td>
              <td>
                <span class="lr-view-supervisor-name"></span>
              </td>
            </tr>
            <tr>
              <td><b>Department</b></td>
              <td>
                <span class="lr-view-department-name"></span>
              </td>
            </tr>
            <tr>
              <td><b>Approver's</b></td>
              <td>
                <span class="lr-view-approvers-name"></span>
              </td>
            </tr>
          </tbody>
        </table>
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