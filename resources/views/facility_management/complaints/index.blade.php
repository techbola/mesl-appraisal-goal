@extends('layouts.master')
@section('title')
  Estate Management
@endsection

@section('page-title')
  Complaints
@endsection

@section('buttons')
  <a href="{{ route('facility-management.complaints.create') }}" class="btn btn-info btn-rounded pull-right" >Log Complaints</a>
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
        <li class="active"><a data-toggle="tab" href="#unapproved">Sent/Unsent Complaints &nbsp; <span class="badge badge-warning"></span></a></li>
        <li><a data-toggle="tab" href="#approved">Received Complaints &nbsp; <span class="badge badge-success">{{ $complaint_sent_to_dept->count() }}</span></a></li>
        <li><a data-toggle="tab" href="#inbox">Complaints Inbox &nbsp; <span class="badge badge-danger"></span></a></li>
      </ul>
      <div class="tab-content">
        <div id="unapproved" class="tab-pane fade in active">
          
            <div class="card-box ">
                <table class="table tableWithSearch">
                  <thead>
                    <th>Recipient's Department</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Complaints</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                   @foreach($complaints as $comp)
                   <tr>
                     <td>{{ $comp->recipient_dept }}</td>
                     <td>{{ $comp->category->name }}</td>
                     <td>{{ $comp->location->Location }}</td>
                     <td>{!! $comp->complaints !!}</td>
                     <td>
                       <span class="badge">{{ $comp->status() }}</span>
                     </td>
                     <td class="actions" width="140">
                       @if(!$comp->sent())
                        <a href="{{ route('facility-management.complaints.edit', ['id' => $comp->id ]) }}" class="btn btn-sm btn-info">Edit </a>
                        <a href="#" data-toggle="modal" data-target="#send_to" data-comp-id="{{ $comp->id }}" class="putter btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send To <i style="margin-left: 7px" class="m-l-10 fa fa-chevron-right"></i></a>

                        @else
                        <a href="{{ route('facility-management.complaints.edit', ['id' => $comp->id ]) }}" class="btn btn-sm disabled ">Edit </a>
                        <a href="{{ route('facility-management.send-complaints')}}" class="btn btn-sm disabled m-r-5" data-toggle="tooltip" title="">Sent </a>
                        @endif
                     </td>
                   </tr>
                   @endforeach
                  </tbody>
                </table>
            </div>
        </div>
        <div id="approved" class="tab-pane fade">

          
          <div class="card-box">
            <table class="table tableWithSearch">
                <thead>
                  <th>Sender</th>
                  <th>Sender's Department</th>
                  <th>Category</th>
                  <th>Location</th>
                  <th>Complaints</th>
                  <th>Status</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                @if(auth()->user()->staff->ComplaintRecipientFlag == 1)
                 @foreach($complaint_sent_to_dept as $comp)
                 <tr>
                   <td>{{ $comp->user->fullName }}</td>
                   <td>{{ $comp->user->staff->department->Department ?? '-' }}</td>
                   <td>{{ $comp->category->name }}</td>
                   <td>{{ $comp->location->Location }}</td>
                   <td>{!! $comp->complaints !!}</td>
                   <td>
                     <span class="badge">{{ $comp->status() }}</span>
                   </td>
                   <td class="actions" width="170">
                     @if(!$comp->sent())
                      <a href="{{ route('facility-management.complaints.edit', ['id' => $comp->id ]) }}" class="btn btn-sm btn-info">Edit </a>
                      <a href="#" data-toggle="modal" data-target="#send_to" data-comp-id="{{ $comp->id }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send To <i style="margin-left: 7px" class="m-l-10 fa fa-chevron-right"></i></a>

                      @else
                      <a href="{{ route('facility-management.complaints.edit', ['id' => $comp->id ]) }}" class="btn btn-sm disabled ">Edit </a>

                      @if(in_array($comp->current_queue, $depts))
                         <a href="#" data-toggle="modal" data-target="#send_to" data-comp-id="{{ $comp->id }}" class="putter btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send To <i style="margin-left: 7px" class="m-l-10 fa fa-chevron-right"></i></a>
                      @endif
                      <a href="#" data-toggle="modal" data-target="#comment" data-comp-id="{{ $comp->id }}" class="putter btn btn-sm btn-info m-r-5 m-t-5" data-toggle="tooltip" title="">Comment</a>
                      @endif
                   </td>
                 </tr>
                 @endforeach
                 @endif
                </tbody>
            </table>
          </div>

        </div>

        <div id="inbox" class="tab-pane fade">

          
          <div class="card-box">
            <table class="table tableWithSearch">
                <thead>
                  <th>Recipient's Department</th>
                  <th>Category</th>
                  <th>Location</th>
                  <th>Complaints</th>
                  <th>View Comments</th>
                </thead>
                <tbody>
                 @foreach($complaint_sent_to_dept as $comp)
                 <tr>
                   <td>{{ $comp->user->staff->department->Department ?? '-' }}</td>
                   <td>{{ $comp->category->name }}</td>
                   <td>{{ $comp->location->Location }}</td>
                   <td>{!! $comp->complaints !!}</td>
                   <td>
                     <a href="{{ route('facility-management.view-comments', ['id' => $comp->id]) }}">
                        View Discussions
                     </a>
                   </td>
                 </tr>
                 @endforeach
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
                        <input type="hidden" name="complaint_id" value="2">
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

          <div class="row hide">
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

      $('body').on('click', '.putter', function(e) {
        e.preventDefault();
        var value_ = $(this).data('comp-id');
        var target = $(this).data('target');
        console.log(value_);
        $(target).find('[name=complaint_id]').val(value_);
        console.log($(target));
      });

    });


  </script>
@endpush



