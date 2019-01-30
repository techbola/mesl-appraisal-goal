<!-- Add Supervisor modal-->
<div class="modal fade" id="add-supervisor" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Assign a Supervisor</h4>
      </div>
      <div class="modal-body">
        <hr />
        <form method="post" id="add-supervisor-form" onsubmit="return addSupervisor()">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Staff</label>
                <select id="staff_name" class="form-control">
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Department</label>
                <select id="department_name" class="form-control">
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <button class="btn btn-info" id="add-supervisor-btn">
                  Assign as Supervisor
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

<!-- Edit Supervisor modal-->
<div class="modal fade" id="edit-supervisor" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4><span class="edit-supervisor-name"></span></h4>
      </div>
      <div class="modal-body">
        <hr />
        <form method="post" id="edit-supervisor-form" onsubmit="return updateSupervisor()">
          <input type="hidden" id="edit_supervisor_id" name="">
         <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Staff</label>
                <select id="edit_staff_name" class="form-control">
                  <option value="0">-- Select Staff --</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Department</label>
                <select id="edit_department_name" class="form-control">
                  <option value="0">-- Select Department --</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <button class="btn btn-info" id="edit-supervisor-btn">
                  Update Supervisor
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