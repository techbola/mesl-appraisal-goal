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
  <a href="{{ route('memos.create') }}" class="btn btn-info btn-rounded pull-right btn-sm" >New Memo</a>
  <a href="{{ route('memos.index') }}" class="btn btn-info btn-rounded pull-right m-r-5 btn-sm" >View Memos <span class="badge m-l-5">{{ $my_unsent_memos->count() }}</span>
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
    <!-- Tabs For Memos -->
    {{-- START TABS --}}
     <h3 class="card-title">Sent/Approved Memos</h3>
      <ul class="nav nav-tabs outside">
        <li class="active"><a data-toggle="tab" href="#unapproved">UnApproved Memos &nbsp; <span class="badge badge-warning">{{ $unapproved_memos->count() }}</span></a></li>
        <li><a data-toggle="tab" href="#approved">Approved Memos &nbsp; <span class="badge badge-success">{{ $approved_memos->count() }}</span></a></li>
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
                    <th width="10%">Subject</th>
                    <th width="10%">Purpose</th>
                    <th width="10%">Initiator</th>
                    <th width="20%">Body</th>
                    <th width="10%">Approvers</th>

                  </thead>
                  <tbody>
                    @foreach ($unapproved_memos as $memo)
                      <tr>
                        <td>
                            <div class="checkbox check-info">
                              <input type="checkbox" id="select-all-child-{{ $memo->id }}" class="select-all-child" value="{{ $memo->id }}">
                              <label for="select-all-child-{{ $memo->id }}" class="text-white"></label>
                            </div>
                        </td>
                        <td>{{ $memo->subject }}</td>
                        <td>{{ $memo->purpose }}</td>
                        <td>{{ $memo->initiator->Fullname ?? '-'}}</td>
                        <td>
                           <p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($memo->body), 50, '...') }}</p> <br>
                          <a href="{{ route('memos.show', ['id' => $memo->id]) }}" class="text-info preview_memo"><small>More Details</small></a>
                          &nbsp; {!! $memo->attachments->count() > 0 ? '<span class="badge">'. $memo->attachments->count() .' '. str_plural('attachment', $memo->attachments->count()).'</span>' : '<span class="badge">No Attachment</span>'  !!}
                          &nbsp; {{-- <a href="{{ route('download-attachment', ['id' => $memo->id ]) }}"><span class="btn btn-xs btn-rounded download-wrapper"><img src="{{ asset('images/download.svg') }}" alt=""></span></td></a> --}}

                        </td>
                        <td>
                            {{ $memo->approvers() }}
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
                    <th width="15%">Subject</th>
                    <th width="10%">Purpose</th>
                    <th width="10%">Initiator</th>
                    <th width="20%">Body</th>
                    <th width="10%">Approvers</th>

                  </thead>
                  <tbody>
                    @foreach ($approved_memos as $memo)
                      <tr>
                        <td>{{ $memo->subject }}</td>
                        <td>{{ $memo->purpose }}</td>
                        <td>{{ $memo->initiator->Fullname ?? '-' }}</td>
                        <td>
                            <p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($memo->body), 50, '...') }}</p> <br>
                          <a href="{{ route('memos.show', ['id' => $memo->id]) }}" class="text-info preview_memo"><small>More Details</small></a>
                          &nbsp; {!! $memo->attachments->count() > 0 ? '<span class="badge">'. $memo->attachments->count() .' '. str_plural('attachment', $memo->attachments->count()).'</span>' : '<span class="badge">No Attachment</span>'  !!}
                          &nbsp; {{-- <a href="{{ route('download-attachment', ['id' => $memo->id ]) }}"><span class="btn btn-xs btn-rounded download-wrapper"><img src="{{ asset('images/download.svg') }}" alt=""></span></td></a> --}}
                        </td>
                        <td>
                            {{ $memo->approvers() }}
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
        $('div.actionBtn').html('<button style="margin-left: 10px" class="approve-btn btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-share-square"></i> Approve</button><button class="reject-btn btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-times-circle"></i> Reject</button>');
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
     var checked_memos = $('.select-all-child:checked');
     var checked_memos_array = [];
     $.each(checked_memos, function(index, val) {
          checked_memos_array.push(parseInt($(val).prop('value')));
     });
     console.log(checked_memos_array)
   var ApprovedDate = "{{ \Carbon\Carbon::now() }}";
   var ApproverID = {{ auth()->user()->id }};
     alert('Are You sure you want to approve this memo ?');
     var Comment = prompt("Enter Approval Comment");
     
     $.ajax({
         url: '/memos/approve',
         type: 'POST',
         data: {
            ApproverID: {{ auth()->user()->id }},
            SelectedID: checked_memos_array,
            ApprovedDate: ApprovedDate,
            ApprovedFlag: 1,
            ModuleID: 2, // PREDEFINED 
            Comment: Comment
        },
        beforeSend: function(){
            // show button animation
            that.text('Approving ...');
        }
     })
     .done(function(res, status, xhr) {
         // Navigate to the list after succesful posting to the server
         if(xhr.status == 200) {
            window.location.href  = "{{ route('memos_approvallist') }}";
         } else {
            alert('approval failed');
            return false
         }   
     })
     .fail(function() {
         console.log("error");
     });
     
 });


  $('.reject-btn').click(function(e) {
     e.preventDefault();
     var checked_memos = $('.select-all-child:checked');
     var checked_memos_array = [];
     $.each(checked_memos, function(index, val) {
          checked_memos_array.push(parseInt($(val).prop('value')));
     });
     console.log(checked_memos_array)
   var RejectedDate = "{{ \Carbon\Carbon::now() }}";
   var RejecterID = {{ auth()->user()->id }};
     alert('Are You sure you want to reject this memo ?');
     var Comment = prompt("Enter Rejection Comment");
     
     $.ajax({
         url: '/memos/reject',
         type: 'POST',
         data: {
            RejecterID: {{ auth()->user()->id }},
            SelectedID: checked_memos_array,
            RejectedDate: RejectedDate,
            RejectedFlag: 1,
            ModuleID: 2, // predefined in the DB
            Comment: Comment
        },
     })
     .done(function(res, status, xhr) {
         // Navigate to the list after succesful posting to the server
         if(xhr.status == 200) {
            window.location.href  = "{{ route('memos_approvallist') }}";
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
      $('.table').on('click', '.preview_memo', function(e) {
        e.preventDefault();
        var url = $(this).prop('href');
        var memo_path = '{{ asset('storage/memo_attachments') }}/';
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
               $('#show-memo .modal-footer .files').html(`
                <a target="_blank" href="/download-memo-attachments/${data.id}">Dowmnload Attachment(s)</a>&nbsp;
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
        
@endpush



