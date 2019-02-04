@extends('layouts.master')

@section('title')
  ICT Help Desk
@endsection

@section('page-title')
  Complaints
@endsection

@section('content')
	<!-- START PANEL -->
  <div class="card-title pull-left">All Complaints</div>
  <div class="pull-right">
    <div class="col-xs-12">
      <input type="text" class="search-table form-control pull-right" placeholder="Search">
    </div>
  </div>
  <div class="clearfix"></div>
	<div class="">
    <ul class="nav nav-tabs outside">
      <li class="active">
        <a data-toggle="tab" href="#unresolved">
          Unresolved Complaints &nbsp; <span class="badge badge-warning"></span>
        </a>
      </li>
      <li>
        <a data-toggle="tab" href="#resolved">
          Resolved Complaints &nbsp; <span class="badge badge-success">{{ $complaint_sent_to_dept->count() }}</span>
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div id="unresolved" class="tab-pane fade in active">
          <div class="card-box ">
              <table class="table tableWithSearch">
                <thead>
                  <th>Client's Name</th>
                  <th>Allocation</th>
                  <th>Location</th>
                  <th>Complaints</th>
                  <th>Status</th>
                  <th>Actions</th>
                </thead>
                <tbody>

                </tbody>
              </table>
          </div>
      </div>
      <div id="resolved" class="tab-pane fade">        
        <div class="card-box">
          <table class="table tableWithSearch">
              <thead>
                <th>Client's Name</th>
                <th>Allocation</th>
                <th>Location</th>
                <th>Complaints</th>
                <th>Status</th>
                <th>Actions</th>
              </thead>
              <tbody>
                
              </tbody>
          </table>
        </div>
      </div>
    </div>
	</div>
	<!-- END PANEL -->

  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="send_to" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4>Send Complaint to Department</h4>
            <p class="p-b-10">Choose which department to send complain to</p>
          </div>
          <div class="modal-body">
            {{ Form::open(['action' => 'ComplaintController@send']) }}
              <div class="row">
                <div class="form-group">
                    <div class="controls">
                        {{ Form::label('current_queue', 'Department') }}
                        <input type="hidden" name="complaint_id" value="">
                        {{ Form::select('current_queue',[ '' => 'Select Department'] + $departments->pluck('Department','DepartmentRef')->toArray(),null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Location', 'required']) }}
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="">
                  <button class="btn btn-success">Send Complaint</button>
                  
                </div>
              </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->

  <!-- Comment Modal -->
  <div class="modal fade slide-up disable-scroll" id="comment" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4>Comment on: </h4>
            <p class="p-b-10">Choose which department to send complain to</p>
          </div>
          <div class="modal-body">

        {{ Form::open(['action' => 'ComplaintController@comment', 'files' => true]) }}
          <div class="row">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('current_queue', 'Comment') }}
                    <input type="hidden" name="complaint_id" value="">
                    <textarea name="comment" id="comment" cols="30" rows="4" class="summernote"></textarea>
                </div>
            </div>


            <div class="form-group">
                <div class="controls">
                    {{ Form::label('complaint_attachment[]', 'Attach Files') }}
                    {{ Form::file('complaint_attachment[]',  ['class' => '','multiple' => 'multiple']) }}
                </div>
            </div>
            

          </div>

          <div class="row">
              <div class="form-group">
                  <div class="controls">
                      {{ Form::label('cost', 'Total Cost') }}
                      <input type="text" name="cost" class="form-control">
                  </div>
              </div>
            <div class="clearfix"></div>
          </div>

          <div class="row">
            <div class="">
              <button class="btn btn-success">Post Comment</button>
            </div>
          </div>
        {{ Form::close() }}
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
@endsection

@push('scripts')
  <script src="{{ asset('js/printThis.js') }}"></script>
  <script>
    $(function(){
      $('.putter').click(function(e){
        // e.preventDefault();
        var value_ = $(this).data('comp-id');
        var target = $(this).data('target');
        console.log(value_);
        $(target).find('[name=complaint_id]').val(value_);
        console.log($(target));
      });
    });
  </script>
@endpush