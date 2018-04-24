{{-- CREATE MODALS --}}
<!-- Modal -->
<div class="modal fade slide-up disable-scroll" id="new_issue" role="dialog" aria-hidden="false">
  <div class="modal-dialog ">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5>Add New Issue</h5>
        </div>
        <div class="modal-body">
          <form id="issue_form_create" action="{{ route('save_issue', $project->ProjectRef) }}" method="post">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="req">Issue Title</label>
                  <input type="text" class="form-control" name="Name" placeholder="Enter Issue Title" required>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="req">Description</label>
                  <textarea class="form-control" name="Description" rows="3" width="100%"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="req">Solution</label>
                  <textarea class="form-control summernote" name="Solution"></textarea>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-info btn-form">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


{{-- UPDATE MODAL --}}
<div class="modal fade slide-up disable-scroll" id="edit_issue" role="dialog" aria-hidden="false">
  <div class="modal-dialog ">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5>Add New Issue</h5>
        </div>
        <div class="modal-body">
          <form id="issue_form_edit" action="" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="req">Issue Title</label>
                  <input type="text" class="form-control" name="Name" placeholder="Enter Issue Title" v-model="issue.Name" required>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="req">Description</label>
                  <textarea class="form-control" name="Description" rows="3" width="100%" v-model="issue.Description"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="req">Solution</label>
                  <textarea class="form-control summernote" name="Solution" v-model="issue.Solution">@{{ issue.Solution }}</textarea>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-info btn-form">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
