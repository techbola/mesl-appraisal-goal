@extends('layouts.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/doc_data.css') }}">

<style>
    .actionBtn button {
    margin-right: 10px
}
</style>
@endpush

@section('buttons')
  <a href="{{ route('expense_management.create') }}" class="btn btn-info btn-rounded pull-right btn-sm" >New Exp. Request</a>
  <a href="{{ route('expense_management.index') }}" class="btn btn-info btn-rounded pull-right m-r-5 btn-sm" >View Request <span class="badge m-l-5">{{ $unapproved_requests->count() }}</span>
  </a>
@endsection

@section('content')

    {{-- <div class="clearfix m-b-20">
        <button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_doc">New Document</button>
    </div> --}}

    <!-- START PANEL -->
    <div class="card-box hide">
           
            <div class="pull-right">
                <div class="col-xs-12">
                    <input type="text" class="search-table form-control pull-right" placeholder="Search">
                </div>
            </div>
            <div class="clearfix"></div>   
    </div>
    <!-- END PANEL -->
    <!-- Tabs For Request -->
    {{-- START TABS --}}
     <h3 class="card-title">Sent/Approved Request</h3>
      <ul class="nav nav-tabs outside">
        <li class="active"><a data-toggle="tab" href="#unapproved">UnApproved Request &nbsp; <span class="badge badge-warning">{{ $unapproved_requests->count() }}</span></a></li>
        <li><a data-toggle="tab" href="#approved">Approved Request &nbsp; <span class="badge badge-success">{{ $approved_requests->count() }}</span></a></li>
      </ul>
      <div class="tab-content">
        <div id="unapproved" class="tab-pane fade in active">
          
            <div class="card-box ">
                <table class="table tableWithSearch_a">
                  <thead>
                    <th width="5%">
                        <div class="checkbox check-info">
                          <input type="checkbox" id="select-all">
                          <label for="select-all" class="text-white">Bulk Select</label>
                        </div>
                    </th>
                    <th width="">Request Type</th>
                    <th width="">Description</th>
                    <th width="">Comment</th>
                    <th width="">Files</th>
                    <th>Status</th>
                    <th>Actions</th>

                  </thead>
                  <tbody>
                    @foreach ( $unapproved_requests as $exp)
                      <tr>
                       <td>
                            <div class="checkbox check-info">
                              <input type="checkbox" id="select-all-child-{{ $exp->ExpenseManagementRef }}" class="select-all-child" value="{{ $exp->ExpenseManagementRef }}">
                              <label for="select-all-child-{{ $exp->ExpenseManagementRef }}" class="text-white"></label>
                            </div>
                        </td>
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
                          
                        </td>
                        <td>
                            @if($exp->status() === true) <!-- approved -->
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

        <div id="approved" class="tab-pane fade">

          
          <div class="card-box">
            <table class="table tableWithSearch">
                  <thead>
                    {{-- <th></th> --}}
                    <th width="">Request Type</th>
                    <th width="">Description</th>
                    <th width="">Comment</th>
                    <th width="">Files</th>
                    <th>Status</th>
                    <th>Actions</th>

                  </thead>
                  <tbody>
                    @foreach ( $approved_requests as $exp)
                      <tr>
                        {{-- <td></td> --}}
                        <td>{{ $exp->request_type->Request ?? '-' }}</td>
                        <td>{{ $exp->Description ?? '-' }}</td>
                        {{-- <td>{{ $exp->Purpose }}</td> --}}
                        <td>
                         <p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($exp->Comment), 50, '...') }}</p> <br>
                          <a href="{{ route('expense_management.show', ['id' => $exp->ExpenseManagementRef]) }}" class="text-info preview_exp"><small>More Details</small></a>
                          &nbsp; {!! $exp->expense_comments->count() > 0 ? '<span class="badge">'. $exp->expense_comments->count() .' '. str_plural('comment', $exp->expense_comments->count()).'</span>' : '<span class="badge">No Comments</span>'  !!}
                          &nbsp; {{-- <a href="{{ route('download-attachment', ['id' => $exp->ExpenseManagementRef ]) }}"><span class="btn btn-xs btn-rounded download-wrapper"><img src="{{ asset('images/download.svg') }}" alt=""></span></td></a> --}}
                        </td>

                        <td></td>
                        
                        <td>
                            @if($exp->status() === true) <!-- approved -->
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
      </div>
  {{-- END TABS --}}
    <!-- End tabs for memos -->




        {{-- MODALS --}}
    <!-- Modal -->
  <div class="modal fade slide-up" id="show-memo" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4 class="semi-bold pull-left">Internal Memo</h4>
            <div class="pull-right">
              <button class="btn btn-default m-r-15" onclick="print_memo()">Print Memo</button>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-sm-10">
                <p class=""><b>Subject: </b> <span class="memo-subject"></span></p>
                <p class=""><b>Purpose: </b> <span class="memo-purpose"></span></p>
                <p class=""><b>To: </b> <span class="memo-recipients"></span></p>
                <p class=""><b>Approvers: </b> <span class="memo-approvers"></span></p>
                <label class="badge memo-status"></label>
              </div>
              <div class="col-sm-2">
                <div class="memo-approved text-right"></div>
              </div>
            </div>
          </div> <hr>
          <div class="modal-body memo-body">
            
          </div>
          <div class="modal-footer">
            <span class="files"></span>
            <button type="button" class="btn btn-complete" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->

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
                <p class=""><b>Approvers: </b> <b><span class="exp-approvers" style="color: #000; margin-left: 10px"></span></b></p>
                </div>
                <div class=""><h5><b>Comments</b>: </h5>  
                  <div class="exp-comment"></div>
                </div>
                <label class="badge exp-status"></label>
              </div>
              <div class="col-sm-2">
                <div class="exp-approved text-right"></div>
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

        
@endsection




@push('scripts')
        <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
        </script>
        <script src="{{ asset('js/printThis.js') }}"></script>
        <script src="{{ asset('js/jquery-printme.min.js') }}"></script>

        <script language="javascript">
$(function(){

    // add multiple select / deselect functionality
    $("#select-all").click(function () {
          $('.select-all-child').prop('checked', this.checked);
    });

    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".select-all-child").click(function(){

        if($(".select-all-child").length == $(".select-all-child:checked").length) {
            $("#select-all").prop("checked", "checked");
        } else {
            $("#select-all").removeAttr("checked");
        }

    });
});
</script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           var settings = {
            // "sDom": "<'exportOptions'>l f<'table-responsive 't> B <''<p i >>",
             dom: "<'row'<'col-sm-4'<'actionBtn'>> <'col-sm-4 text-center'B><'col-sm-4'>> <'table-responsive 't> p",
            // "dom": 'Bfrtip',
            "destroy": true,
            "scrollCollapse": true,
            "columnDefs": [
                { "orderable": false, "targets": 0 }
              ],
            "oLanguage": {
                "sSearch": "",
                "sSearchPlaceholder": "Search",
                "sLengthMenu": "_MENU_ ",
                 "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
            },
            "iDisplayLength": 5,
             fnDrawCallback: function(oSettings) {
        $('.export-options-container').append($('.exportOptions').css('float', 'right'));
        $('div.actionBtn').html('<button style="margin-left: 10px" class="approve-btn btn btn-sm btn-success">Approve</button><button class="reject-btn btn btn-sm btn-danger">Reject</button>');
    }
        };


      

var table = $('.tableWithSearch_a').DataTable(settings);

 $('.tableWithSearch_a tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('.tableWithSearch_a tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="form-control" placeholder="' + $.trim(title) + '" />');
        });   

 // Approval button script
 $('.approve-btn').click(function(e) {
     e.preventDefault();
     var that = $(this);
     var checked_requests = $('.select-all-child:checked');
     var checked_requests_array = [];
     $.each(checked_requests, function(index, val) {
          checked_requests_array.push(parseInt($(val).prop('value')));
     });
     console.log(checked_requests_array)
   var ApprovedDate = "{{ \Carbon\Carbon::now() }}";
   var ApproverID = {{ auth()->user()->id }};

     var confirm = window.confirm('Are You sure you want to approve this memo ?');
     // alert('Are You sure you want to approve this memo ?');
     if(confirm){
      var Comment = prompt("Enter Approval Comment");
     
     $.ajax({
         url: '/expense_management/supervisor-approval',
         type: 'POST',
         data: {
            ApproverID: {{ auth()->user()->id }},
            SelectedID: checked_requests_array,
            ApprovedDate: ApprovedDate,
            ApprovedFlag: 1,
            ModuleID: 2, // PREDEFINED 
            Comment: Comment
        },
        beforeSend: function(){
            // show button animation
            that.attr('disabled', 'disabled');
            that.text('Approving ...');
        }
     })
     .done(function(res, status, xhr) {
         // Navigate to the list after succesful posting to the server
         if(xhr.status == 200) {
            window.location.href  = "{{ route('expense_management_approvallist') }}";
         } else {
            alert('approval failed');
            return false
         }   
     })
     .fail(function() {
         console.log("error");
     });
     }
     
 });


  $('.reject-btn').click(function(e) {
     e.preventDefault();
     var checked_requests = $('.select-all-child:checked');
     var checked_requests_array = [];
     $.each(checked_requests, function(index, val) {
          checked_requests_array.push(parseInt($(val).prop('value')));
     });
     console.log(checked_requests_array)
   var RejectedDate = "{{ \Carbon\Carbon::now() }}";
   var RejecterID = {{ auth()->user()->id }};
     alert('Are You sure you want to reject this memo ?');
     var Comment = prompt("Enter Rejection Comment");
     
     $.ajax({
         url: '/expense_management/reject',
         type: 'POST',
         data: {
            RejecterID: {{ auth()->user()->id }},
            SelectedID: checked_requests_array,
            RejectedDate: RejectedDate,
            RejectedFlag: 1,
            ModuleID: 2, // predefined in the DB
            Comment: Comment
        },
     })
     .done(function(res, status, xhr) {
         // Navigate to the list after succesful posting to the server
         if(xhr.status == 200) {
            window.location.href  = "{{ route('expense_management_approvallist') }}";
         } else {
            alert('Rejection failed');
            return false;
         }
         
     })
     .fail(function() {
         console.log("error");
     });

         
    });

  // memo preview
      $('.preview_memo').click(function(e) {
        e.preventDefault();
        let url = $(this).prop('href');
        let memo_path = '{{ asset('storage/memo_attachments') }}/';
          $("#show-memo").find('.memo-subject').html(' ');
          $("#show-memo").find('.memo-purpose').html(' ');
          $("#show-memo").find('.memo-status').html(' ');
          $("#show-memo").find('.memo-status').removeClass('badge-success')
          $("#show-memo").find('.memo-approvers').html(' ');
          $("#show-memo").find('.memo-recipients').html(' ');
          $("#show-memo").find('.memo-body').html(' ');
           $('#show-memo .modal-footer .files').html(' ');
          $("#show-memo").find('.memo-approved').html(' ');
        $.get(url, function(data) {
          // activate modal
          $("#show-memo").find('.memo-subject').html(data.subject);
          $("#show-memo").find('.memo-purpose').html(data.purpose);
          // $("#show-memo").find('.memo-status').html(data.status);
          $("#show-memo").find('.memo-approvers').html(data.approvers);
          $("#show-memo").find('.memo-body').html(data.body);
          $("#show-memo").find('.memo-recipients').html(data.recipient_list.join(', '));
           if(data.approved === true){
              $("#show-memo").find('.memo-status').html('approved');
              $("#show-memo").find('.memo-status').addClass('badge-success');
              $("#show-memo").find('.memo-approved').html('<img src="{{ asset('images/checkmark.svg') }}" width="30">');
            } else {
              $("#show-memo").find('.memo-status').html(data.status);
            }
          $("#show-memo").modal('show');
          // list attachements
          if(data.attachments.length > 0 ){
            $.each(data.attachments, function(index, val) {
               $('#show-memo .modal-footer .files').append(`
                <a target="_blank" href="${ memo_path+val.attachment_location}">#file ${index + 1}</a>&nbsp;
              `);
            });
          }
        });
      });

      function print_memo() {
        return $("#show-memo").printMe({
          "path": ["{{ asset('css/printmemo.css') }}"]
        });
      }
</script>


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
          console.log(data);
          $("#show-exp").find('.exp-purpose').html(data.Description);
          $("#show-exp").find('.exp-approvers').html(data.approvers);
          $.each(data.expense_comments, function(index, val) {
             $("#show-exp").find('.exp-comment').append(`
              <div> <i>${val.approved_by} : </i>${val.Comment}<div> 
              <div><i><b>FILES : &nbsp;</b></i> 
               ${val.files}
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

 

  </script>
        
@endpush



