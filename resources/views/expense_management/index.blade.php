@extends('layouts.master')
@section('title')
  Expense Mgmt.
@endsection

@section('page-title')
  Expense Mgmt.
@endsection
 
@section('buttons')
  <a href="{{ route('expense_management.create') }}" class="btn btn-info btn-rounded pull-right" >New Exp. Request</a>
  <a href="{{ route('expense_management_approvallist') }}" class="btn btn-info btn-rounded m-r-5 pull-right" >Approvals <span class="badge m-l-5">{{ $unapproved_expense_management->count() }}</span></a>
@endsection
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/1.5.1/css/scroller.dataTables.min.css">
<style>
  .flags {
        float: right;
    position: absolute;
    right: -20%;
    top: 0;
  }
</style>
@endpush

@section('content')

  	<!-- START PANEL -->
    <div class="card-title pull-left">Your Expense Request</div>
    <div class="pull-right">
      <div class="col-xs-12">
        <input type="text" class="search-table form-control pull-right" placeholder="Search">
      </div>
    </div>
    <div class="clearfix"></div>
  	<div class="">

      <ul class="nav nav-tabs outside">
        <li class="active"><a data-toggle="tab" href="#unapproved">Unsent Exp. Request &nbsp; <span class="badge badge-warning">{{ $my_unsent_expense_management->count() }}</span></a></li>
        <li><a data-toggle="tab" href="#approved">Sent Exp. Request &nbsp; <span class="badge badge-success">{{ $my_expense_management->count() }}</span></a></li>
        <li><a data-toggle="tab" href="#inbox">Exp. Request Inbox &nbsp; <span class="badge badge-danger">{{ $exp_inbox->count() }}</span></a></li>
      </ul>
      <div class="tab-content">
        <div id="unapproved" class="tab-pane fade in active">
          
            <div class="card-box ">
                <table class="table tableWithSearch">
                  <thead>
                    <th width="">Request Type</th>
                    <th width="">Description</th>
                    <th width="">Comment</th>
                    <th width="">Files</th>
                    <th>Status</th>
                    <th>Actions</th>

                  </thead>
                  <tbody>
                    @foreach ( $my_unsent_expense_management as $exp)
                      <tr>
                        <td>{{ $exp->request_type->Request ?? '-' }}</td>
                        <td>{{ $exp->Description ?? '-' }}</td>
                        {{-- <td>{{ $exp->Purpose }}</td> --}}
                        <td>
                         <p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($exp->Comment), 50, '...') }}</p> <br>
                          <a href="{{ route('expense_management.show', ['id' => $exp->ExpenseManagementRef]) }}" class="text-info preview_exp"><small>More Details</small></a>
                          &nbsp; {!! $exp->expense_comments->count() > 0 ? '<span class="badge">'. $exp->expense_comments->count() .' '. str_plural('comment', $exp->expense_comments->count()).'</span>' : '<span class="badge">No Comments</span>'  !!}
                          &nbsp; {{-- <a href="{{ route('download-attachment', ['id' => $exp->ExpenseManagementRef ]) }}"><span class="btn btn-xs btn-rounded download-wrapper"><img src="{{ asset('images/download.svg') }}" alt=""></span></td></a> --}}
                        </td>
                        <td>
                          {{-- @foreach($exp->files as $file) --}}
                            {{-- <p>
                              <a href="{{ route('docs', ['file'=>$file->Filename]) }}" class="small text-complete" data-toggle="tooltip" title="Download document">{{ $file->Filename}}<i class="fa fa-download m-l-5"></i></a>
                            </p> --}}
                          {{-- @endforeach --}}
                          <button type="button" class="btn btn-info exp-files" data-exp_ref="{{ $exp->DocumentIDs }}">View Files</button>
                        </td>
                        <td>
                            @if($exp->status() === true) <!-- approved -->
                                <label class="badge badge-success">Approved</label>
                            @else
                                <label class="badge badge-default">{{ $exp->status() }}</label>    
                            @endif
                        </td>
                        <td class="actions" width="130">
                          <a href="{{ route('expense_management.approver.show', ['id' => $exp->ExpenseManagementRef ]) }}" class="btn btn-sm btn-info">Show Request.</a>
                          @if(!$exp->sent())
                          <a href="{{ route('expense_management.edit', ['id' => $exp->ExpenseManagementRef ]) }}" class="btn btn-sm btn-info">Edit </a>
                          <a href="{{ route('send_expense', ['id' => $exp->ExpenseManagementRef]) }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send</a>
                          @else
                          <a href="{{ route('expense_management.edit', ['id' => $exp->ExpenseManagementRef ]) }}" class="btn btn-sm disabled ">Edit </a>
                          <a href="{{ route('send_expense', ['id' => $exp->ExpenseManagementRef]) }}" class="btn btn-sm disabled m-r-5" data-toggle="tooltip" title="">Sent </a>
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
                <th >Request Type</th>
                <th >Description</th>
                <th>Comments</th>
                <th>files</th>
                <th>Status</th>
                <th>Actions</th>

              </thead>
              <tbody>
                @foreach ( $my_expense_management->where('NotifyFlag', 1) as $exp)
                  <tr>
                    <td>{{ $exp->request_type->Request ?? '-' }}</td>
                    <td>{{ $exp->Description }}</td>
                    <td>
                     <p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($exp->Comment), 50, '...') }}</p> <br>
                      <a href="{{ route('expense_management.show', ['id' => $exp->ExpenseManagementRef]) }}" class="text-info preview_exp"><small>More Details</small></a>
                      &nbsp; {!! $exp->expense_comments->count() > 0 ? '<span class="badge">'. $exp->expense_comments->count() .' '. str_plural('comment', $exp->expense_comments->count()).'</span>' : '<span class="badge">No Comment</span>'  !!}
                      &nbsp; {{-- <a href="{{ route('download-attachment', ['id' => $exp->ExpenseManagementRef ]) }}"><span class="btn btn-xs btn-rounded download-wrapper"><img src="{{ asset('images/download.svg') }}" alt=""></span></a> --}}
                    </td>
                    <td>
                      {{-- @foreach($exp->files as $file) --}}
                        {{-- <p>
                          <a href="{{ route('docs', ['file'=>$file->Filename]) }}" class="small text-complete" data-toggle="tooltip" title="Download document">{{ $file->Filename}}<i class="fa fa-download m-l-5"></i></a>
                        </p> --}}
                        <button type="button" class="btn btn-info exp-files" data-exp_ref="{{ $exp->DocumentIDs }}">View Files</button>
                      {{-- @endforeach --}}
                    </td>
                    <td>
                        @if($exp->status() === true ) <!-- approved -->
                            <label class="badge badge-success">Approved</label>
                        @else
                            <label class="badge badge-default">{{ $exp->status() }}</label>    
                        @endif
                    </td>
                    <td class="actions" width="130">
                      @if(!$exp->sent())
                      <a href="{{ route('expense_management.edit', ['id' => $exp->ExpenseManagementRef ]) }}" class="btn btn-sm btn-info">Edit </a>
                      <a href="{{ route('send_expense', ['id' => $exp->ExpenseManagementRef]) }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send</a>
                      @else
                      <a href="{{ route('expense_management.edit', ['id' => $exp->ExpenseManagementRef ]) }}" class="btn btn-sm disabled ">Edit </a>
                      <a href="{{ route('send_expense', ['id' => $exp->ExpenseManagementRef]) }}" class="btn btn-sm disabled m-r-5" data-toggle="tooltip" title="">Sent </a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

        <div id="inbox" class="tab-pane fade">

          
          <div class="card-box">
            <table class="table tableWithSearch">
              <thead>
                <th >Request Type</th>
                <th >Description</th>
                <th>Comment</th>
                <th>Files</th>
                <th>Status</th>
                <th>Actions</th>

              </thead>
              <tbody>
                @foreach ( $exp_inbox as $exp)
                  <tr>
                    <td>{{ $exp->request_type->Request }}</td>
                    <td>{{ $exp->Description }}</td>
                    <td>
                     <p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($exp->Comment), 50, '...') }}</p> <br>
                      <a href="{{ route('expense_management.show', ['id' => $exp->ExpenseManagementRef]) }}" class="text-info preview_exp"><small>More Details</small></a>
                      &nbsp; {!! $exp->expense_comments->count() > 0 ? '<span class="badge">'. $exp->expense_comments->count() .' '. str_plural('comment', $exp->expense_comments->count()).'</span>' : '<span class="badge">No Comment</span>'  !!}
                      &nbsp; {{-- <a href="{{ route('download-attachment', ['id' => $exp->ExpenseManagementRef ]) }}"><span class="btn btn-xs btn-rounded download-wrapper"><img src="{{ asset('images/download.svg') }}" alt=""></span></a> --}}
                    </td>
                    <td>
                      @foreach($exp->files as $file)
                        <p>
                          <a href="{{ route('docs', ['file'=>$file->Filename]) }}" class="small text-complete" data-toggle="tooltip" title="Download document">{{ $file->Filename}}<i class="fa fa-download m-l-5"></i></a>
                        </p>
                      @endforeach
                    </td>
                    <td>
                        @if($exp->status() === true ) <!-- approved -->
                            <label class="badge badge-success">Approved</label>
                        @else
                            <label class="badge badge-default">{{ $exp->status() }}</label>    
                        @endif
                    </td>
                    <td class="actions" width="130">
                      @if(!is_null($exp->ApproverRoleID))
                      {{-- <form > --}}
                        {{-- {{ csrf_field() }} --}}
                        <input type="hidden" name="ExpenseManagementRef" value="{{ $exp->ExpenseManagementRef }}">
                        <button type="submit" class="btn btn-sm btn-success m-r-5 " data-eref="{{ $exp->ExpenseManagementRef }}" data-rlid="{{ $exp->RequestListID }}" data-approverid = "{{ $exp->ApproverRoleID }}" id="approval" data-toggle="tooltip" title="">Approve</button>

                        <button type="submit" class="btn btn-sm btn-danger m-r-5 " data-eref="{{ $exp->ExpenseManagementRef }}" data-rlid="{{ $exp->RequestListID }}" data-approverid = "{{ $exp->ApproverRoleID }}" id="rejection" data-toggle="tooltip" title="">Decline</button>
                      {{-- </form> --}}
                      @else
                      <a href="#" class="btn btn-sm btn-success disabled m-r-5" data-toggle="tooltip" title="">Completed</a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

           {{--  <br>

            <table id="example" class="display table " style="width:100%">
                <thead>
                      <tr>
                        <th >Request Type</th>
                        <th >Purpose</th>
                        <th>Body</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                </thead>
            </table> --}}

          </div>

        </div>
      </div>
  			

  	</div>
  	<!-- END PANEL -->

    <!-- Modal -->
  <div class="modal fade slide-up" id="show-exp" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4 class="semi-bold pull-left">Expense Details</h4>
            <div class="pull-right">
              <button class="btn btn-default m-r-15" onclick="print_exp()">Print Exp</button>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-sm-10">
                
                <div style="color: #000 !important;">
                  <p class=""><b>Description: </b>
                  <h5><span class="exp-purpose"></span></h5>
                  </p>
                <p class=""><b>Approvers: </b> <b><span class="exp-approvers" style="color: #000; margin-left: 0px"></span></b></p>
                </div>
                <div class=""><h5><b>Comments</b>: </h5>  
                  <div class="exp-comment"></div>
                </div>
                <label class="badge exp-status"></label>
              </div>
              <div class="col-sm-2">
                <div class="exp-approved text-right">
                  {{-- <div class="badge badge success">Approved</div> --}}
                </div>
                <div class="exp-declined text-right">
                  {{-- <div class="badge badge-danger">Declined</div> --}}
                </div>
              </div>
            </div>
          </div> <hr>
          <div class="modal-body exp-body">
            
          </div>
          <div class="modal-footer">
            <span class="files"></span>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->

    <!-- Modal -->
  <div class="modal fade slide-up" id="show-expense" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
 <form action="/expense_management/approve" method="post" enctype="multipart/form-data">
        <div class="modal-content">

          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4 class="semi-bold pull-left">Expense Management</h4>
            
          </div> <hr>
          <div class="modal-body exp-body">
           
              {{ csrf_field() }}
              <div>
                <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Comment', 'Comment') }}
                    {{ Form::textarea('Comment', null, ['class' => 'summernote form-control','rows' => 3, 'placeholder' => 'Purpose of this memo']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('attachment[]', 'Attach Files') }}
                    {{ Form::file('attachment[]',  ['class' => '','multiple' => 'multiple']) }}
                </div>
            </div>
        </div> 
    </div>
    <input type="hidden" name="ExpenseManagementRef" value="">
    <input type="hidden" name="RequestListID" value="">
    <input type="hidden" name="ApproverRoleID" value="">
            {{-- </form> --}}
          </div>
          <div class="modal-footer">
            <span class="files"></span>
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>

        </div>
         </form>
      </div>
   
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->


  <!-- rejection -->
    <!-- Modal -->
  <div class="modal fade slide-up" id="show-expense-reject" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
 <form action="/expense_management/reject" method="post" enctype="multipart/form-data">
        <div class="modal-content">

          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4 class="semi-bold pull-left">Expense Management</h4>
            
          </div> <hr>
          <div class="modal-body exp-body">
           
              {{ csrf_field() }}
              <div>
                <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Comment', 'Comment') }}
                    {{ Form::textarea('Comment', null, ['class' => 'summernote form-control','rows' => 3, 'placeholder' => 'Purpose of this memo']) }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('attachment[]', 'Attach Files') }}
                    {{ Form::file('attachment[]',  ['class' => '','multiple' => 'multiple']) }}
                </div>
            </div>
        </div> 
    </div>
    <input type="hidden" name="ExpenseManagementRef" value="">
    <input type="hidden" name="RequestListID" value="">
    <input type="hidden" name="ApproverRoleID" value="">
            {{-- </form> --}}
          </div>
          <div class="modal-footer">
            <span class="files"></span>
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>

        </div>
         </form>
      </div>
   
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
  <!--/ end-->

   <div class="modal fade slide-up" id="show-expense-files" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper" id="exp_files_modal">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4 class="semi-bold pull-left">Request Files</h4>
            
          </div> <hr>
          <div class="modal-body exp-body">
            <table class="table tableWithSearch table-bordered">
          <thead>
            <th width="20%">Document Name</th>
            <th width="15%">Type</th>
            <th width="20%">Upload Date</th>
            <th width="10%">Initiator</th>
            <th width="15%">Download</th>

          </thead>
          <tbody>
           
          </tbody>
        </table>
          </div>
          <div class="modal-footer">
            <span class="files"></span>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
   
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->




@endsection

@push('scripts')
  <script src="https://cdn.datatables.net/scroller/1.5.1/js/dataTables.scroller.min.js"></script>
  <script src="{{ asset('js/printThis.js') }}"></script>
  <script src="{{ asset('js/jquery-printme.min.js') }}"></script>
  <script>
    $(function(){

// trigger approve modal
$("table").on('click', '#approval', function(e) {

  e.preventDefault();
  $("[name=ExpenseManagementRef]").val($(this).data("eref"));
  $("[name=RequestListID]").val($(this).data("rlid"));
  $("[name=ApproverRoleID]").val($(this).data("approverid"));
  $('#show-expense').modal();

});

$("table").on('click', '#rejection', function(e) {

  e.preventDefault();
  $("[name=ExpenseManagementRef]").val($(this).data("eref"));
  $("[name=RequestListID]").val($(this).data("rlid"));
  $("[name=ApproverRoleID]").val($(this).data("approverid"));
  $('#show-expense-reject').modal();

});

$('.exp-files').click(function(e){
  e.preventDefault();
  let exp_ref = $(this).data('exp_ref');
  $.get('/expense_management/'+exp_ref+'/files', function(data) {
    // console.log(data);
    $("#show-expense-files tbody").html(' ');
    $.each(data, function(index, val) {
       $("#show-expense-files tbody").append(`
        <tr>
          <td>${val.DocName}</td>
          <td>${val.type}</td>
          <td>${val.upload_date}</td>
          <td>${val.initiator.first_name}</td>
          <td><a href="/download-document/${val.Filename}" class="small text-complete" data-toggle="tooltip" title="Download document">${val.Filename}<i class="fa fa-download m-l-5"></i></a</td>
        </tr>
      `);
    });
    
    $("#show-expense-files").modal('show');

  });

});

      $('.preview_exp').click(function(e) {
        e.preventDefault();
        let url = $(this).prop('href');
        let exp_path = '{{ asset('storage/expense_attachments') }}/';
          
          $("#show-exp").find('.exp-body').html(' ');
          $("#show-exp").find('.exp-comment').html(' ');
          $("#show-exp").find('.exp-approvers').html(' ');
           $('#show-exp .modal-footer .files').html(' ');
          $("#show-exp").find('.exp-approved').html(' ');
        $.get(url, function(data) {
          console.log('data',data);
          
          $("#show-exp").find('.exp-purpose').html(data.Description);
          $("#show-exp").find('.exp-approvers').html(data.approvers);

          $.each(data.expense_comments, function(index, val) {
             $("#show-exp").find('.exp-comment').append(`
              <div style="position: relative"> <i>${val.approved_by} &nbsp; <span class=""> (${val.ApprovedFlag == 1 ? `Approved` : `Rejected`} by: ${val.approver} @ ${val.approved_at})</span>: </i>${val.Comment}<div> 
              <div><i><b>FILES : &nbsp;</b></i> 
               ${val.files}
               ${val.ApprovedFlag == 1 ? `<div class="badge badge-success flags">Approved</div>` : `<div class="flags badge badge-danger">Declined</div>` }
              <div> 
              ${data.expense_comments.length != index + 1 ? '<hr>' : '' }
              
              
              `);
             
          });
          // activate modal
           if(data.approved === true){
              $("#show-exp").find('.exp-status').html('approved');
              $("#show-exp").find('.exp-status').addClass('badge-success');
              
              $("#show-exp").find('.exp-approved').html('<img src="{{ asset('images/checkmark.svg') }}" width="30">');
            } else {
              $("#show-exp").find('.exp-status').html(data.status);
              
            }
          $("#show-exp").modal('show');
          // list attachements
          if(data.attachments.length > 0 ){
            $.each(data.attachments, function(index, val) {
               $('#show-exp .modal-footer .files').append(`
                <a target="_blank" href="${ exp_path+val.attachment_location}">${val.Filename}</a>&nbsp;
              `);
            });
          }
        });
      });
    });

    function print_exp() {
        return $("#show-exp").printMe({
          "path": ["{{ asset('css/printmemo.css') }}"]
        }); 
    }

    // datatbles
    var data = [];
        for ( var i=0 ; i<50000 ; i++ ) {
            data.push( [ ] );
        }
         
        // $('#example').DataTable( {
        //     data:           ,
        //     deferRender:    true,
        //     scrollY:        200,
        //     scrollCollapse: true,
        //     scroller:       true
        // } );
    

  </script>
@endpush



