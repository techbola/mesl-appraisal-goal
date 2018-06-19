@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}

hr {
  margin-top: -8px;
}

  </style>
@endpush

@section('title')
  Create Policy Approvers
@endsection

@section('page-title')
  Create Policy Approvers
@endsection

@section('buttons')
  
@endsection 

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <div style="padding: 30px">
         <ul class="nav nav-pills pull-right">
             
         </ul>
      </div><div class="clearfix"></div>
      @if(count($check) >= 1)
      <div style="padding: 30px">
         <ul class="nav nav-pills pull-right">
             <li><a style="background: #bbb" href="{{ route('Policy') }}">Return to Policy Page</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicy') }}">Create New/View Policies</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicySegment') }}">Create New/View Policy Segments</a></li>
             <li><a href="#" style="color: #fff" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-lg btn-info">Staff Policy Permissions</a></li>
         </ul>
      </div><div class="clearfix"></div>
      @endif
  			<div class="card-title pull-left">List Policy Approvers</div><div class="clearfix"></div>
           <div class="row"><hr>
              <div class="col-md-8 col-md-offset-2">
              <div id="policy_table" style="background: #eee; padding: 10px">
              <table class="table table-hover" id="policy_table">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Entry Date</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($approves as $approve)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $approve->EntryDate }}</td>
                      <td>{{ $approve->last_name }} {{ $approve->first_name }}</td>
                      <td>
                        @if($approve->Status == 0)
                         <span class="label label-danger">Not Authorized</span>
                          @else
                          <span class="label label-success">Authorized</span>
                          @endif
                      </td>
                      <td>
                      @if($approve->Status == 0)
                         <a href="#" class="btn-default btn btn-sm disabled" title="">Disabled Staff</a>
                          @else
                          <a href="#" data-id="{{ $approve->PolicyApproverRef }}" data-target="#modalFillIn2" data-toggle="modal" id="change_modal"   class="btn-danger btn btn-sm">Change Status</a>
                          @endif
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


    <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 600px; padding: 10px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000" id="title">New policy Approver</span></h5><hr>
                </div>
                <div class="modal-body">
                  <div class="row" >
                    <div id="formy">
                    {{ Form::open(['id'=>'approver_form','autocomplete' => 'off', 'role' => 'form']) }}
                          
                      <div class="col-sm-6">
                          <div class="form-group">
                              {{ Form::label('UserID','Staff Name') }}
                              {{ Form::select('UserID', [ '' =>  'Select Staff Name'] + $users->pluck('Fullname', 'id')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Staff", 'data-init-plugin' => "select2", 'required']) }}
                          </div>
                      </div>

                      <div class="col-md-6">
                         <div class="form-group">
                           {{ Form::label('Status', 'Staff Status' ) }}
                            {{ Form::select('Status', [ '' =>  'Select Status Status', '1' => 'Active', '0' => 'Deactivate'],null, ['class'=> "full-width",'data-placeholder' => "Select Staff Status", 'data-init-plugin' => "select2", 'required']) }}
                           </div>
                      </div>
                    </div>

                      <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="add_approver" data-dismiss="modal" value="Add New Policy Approver">
                                <input type="submit" class="btn btn-sm btn-danger pull-right hide" id="change_policy" data-dismiss="modal" value="Change Staff Status">
                              </div><p id="xyz" class="hide"></p>

                    {{ Form::close() }}  
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
                {{ csrf_field() }}
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>
@endsection

@push('scripts')

<script>

$(document).ready(function() {

  $("#btnFillSizeToggler2").click(function(e){
        $('#title').text('Add New Policy Approver.');
         $('#change_policy').addClass('hide');
         $('#add_approver').removeClass('hide');
         $('#formy').removeClass('hide');
          $('#item_div').removeClass('hide');
    });

  $(document).on('click', '#change_modal', function(event) {
        $('#title').text('Are you sure you want stop staff from creating policies ?');
         $('#change_policy').removeClass('hide');
         $('#add_approver').addClass('hide');
         $('#formy').addClass('hide');
         $('#item_div').addClass('hide');
         var id = $(this).data('id');
         $('#xyz').text(id);

    });

  
 $("#add_approver").click(function(e){
    $.post('/store_policy_approvers', $('#approver_form').serialize(), function(data, status) {
     console.log(status);
     $('#policy_table').load(location.href + ' #policy_table');
    });

    });

  $("#change_policy").click(function(e){
    var id = $('#xyz').text();
    $.get('/change_policy_approvers/'+id, function(data, status) {
     console.log(status);
     $('#policy_table').load(location.href + ' #policy_table');
    });

    });
   
});
 
</script>

@endpush


