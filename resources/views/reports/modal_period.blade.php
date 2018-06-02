<!-- Modal -->
<div class="modal fade slide-up disable-scroll" id="period" role="dialog" aria-hidden="false">
  <div class="modal-dialog ">
    <div class="modal-content-wrapper">
      <div class="modal-content">
        <div class="modal-header clearfix text-left">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
          </button>
          <h5>Accounting Period</h5>
        </div>
        <div class="modal-body">
          <form id="issue_form_create" action="{{ route('accounting_period') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Year Start</label>
                  <div class="input-group date dp">
                    <input type="text" name="YearStart" class="form-control" value="{{ $config->YearStart ?? '' }}" required>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Year End</label>
                  <div class="input-group date dp">
                    <input type="text" name="YearEnd" class="form-control" value="{{ $config->YearEnd ?? '' }}" required>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                </div>
              </div>
            </div>
            {{-- <div class="row">
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
              </div> --}}

              <button type="submit" class="btn btn-info btn-form">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
