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
  <a href="/travel_request/create" class="btn btn-info btn-rounded pull-right btn-sm" >New Request</a>
 {{--  <a href="{{ route('memos.index') }}" class="btn btn-info btn-rounded pull-right m-r-5 btn-sm" >View Requests <span class="badge m-l-5">{{ $my_unsent_requests->count() }}</span>
  </a> --}}
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
    <!-- Tabs For Requests -->
    {{-- START TABS --}}
     <h3 class="card-title"> Travel Requests awaiting approval</h3> <hr>
      <ul class="nav nav-tabs outside">
        <li class="active"><a data-toggle="tab" href="#unapproved">UnApproved Requests &nbsp; <span class="badge badge-warning">{{ $unapproved_requests->count() }}</span></a></li>
        <li><a data-toggle="tab" href="#approved">Approved Requests &nbsp; <span class="badge badge-success">{{ $approved_requests->count() }}</span></a></li>
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
                    <th>Staff Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                    <th>Travel Purpose</th>   

                  </thead>
                  <tbody>
                    @foreach ($unapproved_requests as $tr)
                      <tr>
                        <td>
                            <div class="checkbox check-info">
                              <input type="checkbox" id="select-all-child-{{ $tr->TravelRef }}" class="select-all-child" value="{{ $tr->TravelRef }}">
                              <label for="select-all-child-{{ $tr->TravelRef }}" class="text-white"></label>
                            </div>
                        </td>
                        <td>{{ $tr->initiator->fullName }}</td>
                        <td>{{ $tr->TravelType == 1 ? $tr->travel_from_state->State : $tr->travel_from_state->State ?? '-' }}</td>
                        <td>{{ $tr->TravelType == 1 ? $tr->travel_to_state->State : $tr->travel_to_country->Country ?? '-' }}</td>
                        <td>{{ nice_Date($tr->DepartureDate) }}</td>
                        <td>{{ nice_Date($tr->ArrivalDate) }}</td>
                        <td>{{ $tr->travel_purpose->TravelPurpose ?? '-' }}</td>
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
                    <th>Staff Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                    <th>Travel Purpose</th>

                  </thead>
                  <tbody>
                    @foreach ($approved_requests as $tr)
                      <tr>
                        <td>{{ $tr->initiator->fullName }}</td>
                        <td>{{ $tr->TravelType == 1 ? $tr->travel_from_state->State : $tr->travel_from_state->State ?? '-' }}</td>
                        <td>{{ $tr->TravelType == 1 ? $tr->travel_to_state->State : $tr->travel_to_country->Country ?? '-' }}</td>
                        <td>{{ nice_Date($tr->DepartureDate) }}</td>
                        <td>{{ nice_Date($tr->ArrivalDate) }}</td>
                        <td>{{ $tr->travel_purpose->TravelPurpose ?? '-' }}</td>
                      </tr>
                      </tr>
                    @endforeach
                  </tbody>
            </table>
          </div>

        </div>
      </div>
  {{-- END TABS --}}
    <!-- End tabs for memos -->





        
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
     var checked_trs = $('.select-all-child:checked');
     var checked_trs_array = [];
     $.each(checked_trs, function(index, val) {
          checked_trs_array.push(parseInt($(val).prop('value')));
     });
     console.log(checked_trs_array)
   var ApprovedDate = "{{ \Carbon\Carbon::now() }}";
   var ApproverID = {{ auth()->user()->id }};
     var confirm  = window.confirm('Are You sure you want to approve this memo ?');
     if(confirm)
     var Comment = prompt("Enter Approval Comment");
     
     $.ajax({
         url: '/travel_request/approve',
         type: 'POST',
         data: {
            ApproverID: {{ auth()->user()->id }},
            SelectedID: checked_trs_array,
            ApprovedDate: ApprovedDate,
            ApprovedFlag: 1,
            ModuleID: 4, // PREDEFINED 
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
            window.location.href  = "{{ route('travel_request.admindashboard_approvers') }}";
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
     var checked_trs = $('.select-all-child:checked');
     var checked_trs_array = [];
     $.each(checked_trs, function(index, val) {
          checked_trs_array.push(parseInt($(val).prop('value')));
     });
     console.log(checked_trs_array)
   var RejectedDate = "{{ \Carbon\Carbon::now() }}";
   var RejecterID = {{ auth()->user()->id }};
     alert('Are You sure you want to reject this memo ?');
     var Comment = prompt("Enter Rejection Comment");
     
     $.ajax({
         url: '/travel_request/reject',
         type: 'POST',
         data: {
            RejecterID: {{ auth()->user()->id }},
            SelectedID: checked_trs_array,
            RejectedDate: RejectedDate,
            RejectedFlag: 1,
            ModuleID: 4, // predefined in the DB
            Comment: Comment
        },
     })
     .done(function(res, status, xhr) {
         // Navigate to the list after succesful posting to the server
         if(xhr.status == 200) {
            window.location.href  = "{{ route('travel_request.admindashboard_approvers') }}";
         } else {
            alert('Rejection failed');
            return false;
         }
         
     })
     .fail(function() {
         console.log("error");
     });

         
    });


</script>
        
@endpush



