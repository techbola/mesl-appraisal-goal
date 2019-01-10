<!-- Add Software modal-->
<div class="modal fade" id="add-department" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Add a new Department</h4>
      </div>
      <div class="modal-body">
        <hr />
        <form method="post" id="add-department-form" onsubmit="return addDepartment()">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Enter Department Name</label>
                <input type="text" id="department_name" class="form-control" placeholder="Enter project name.." name="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <button class="btn btn-info" id="add-department-btn">
                  Add Department
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

<!-- Add Software modal-->
<div class="modal fade" id="edit-department" role="dialog">
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