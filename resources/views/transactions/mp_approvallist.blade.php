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
  {{-- <a href="{{ route('transactions.create') }}" class="btn btn-info btn-rounded pull-right btn-sm" >Ne</a>
  <a href="{{ route('transactions.index') }}" class="btn btn-info btn-rounded pull-right m-r-5 btn-sm" >View Transaction <span class="badge m-l-5">{{ $unposted->count() }}</span>
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
    <!-- Tabs For Transaction -->
    {{-- START TABS --}}
     <h3 class="card-title">MultiPost Transaction List</h3>
      <ul class="nav nav-tabs outside">
        <li class="active"><a data-toggle="tab" href="#unapproved">UnApproved Transactions &nbsp; <span class="badge badge-warning">{{ $unapproved_transaction->count() }}</span></a></li>
        <li><a data-toggle="tab" href="#approved">Approved Transaction &nbsp; <span class="badge badge-success">{{ $approved_transaction->count() }}</span></a></li>
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
                    <th>Alpha Code</th>
                    <th>Post Date</th>
                    <th>Value Date</th>
                    <th>Amount</th>

                  </thead>
                  <tbody>
                    @foreach ($unapproved_transaction as $transaction)
                      <tr>
                        <td>
                            <div class="checkbox check-info">
                              <input type="checkbox" id="select-all-child-{{ $transaction->AlphaCode }}" class="select-all-child" value="{{ $transaction->AlphaCode }}">
                              <label for="select-all-child-{{ $transaction->AlphaCode }}" class="text-white"></label>
                            </div>
                        </td>
                        <td class="text-info"><b>{{ $transaction->AlphaCode }}</b></td>
                        <td>{{ $transaction->PostDate }}</td>
                        <td>{{ $transaction->ValueDate }}</td>
                        <td>
                            {{ nairazify(number_format($transaction->Amount, 2)) }}
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
                    <th width="5%">
                        <div class="checkbox check-info">
                          <input type="checkbox" id="select-all2">
                          <label for="select-all2" class="text-white">Bulk Select</label>
                        </div>
                    </th>
                    <th>Alpha Code</th>
                    <th>Post Date</th>
                    <th>Value Date</th>
                    <th>Amount</th>
                  </thead>
                  <tbody>
                    @foreach ($approved_transaction as $transaction)
                      <tr>
                        <td>
                          <div class="checkbox check-info">
                              <input type="checkbox" id="select-all2-child-{{ $transaction->AlphaCode }}" class="select-all2-child" value="{{ $transaction->AlphaCode }}">
                              <label for="select-all2-child-{{ $transaction->AlphaCode }}" class="text-white"></label>
                            </div>
                        </td>
                        <td class="text-info"><b>{{ $transaction->AlphaCode }}</b></td>
                        <td>{{ $transaction->PostDate }}</td>
                        <td>{{ $transaction->ValueDate }}</td>
                        <td>
                            {{ nairazify(number_format($transaction->Amount, 2)) }}
                        </td>
                        <td>
                            {{-- {{ $transaction->approvers() }} --}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
            </table>
          </div>

        </div>
      </div>
  {{-- END TABS --}}
    <!-- End tabs for transactions -->
    
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


    // 

    $("#select-all2").click(function () {
          $('.select-all2-child').prop('checked', this.checked);
    });

    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".select-all2-child").click(function(){

        if($(".select-all2-child").length == $(".select-all2-child:checked").length) {
            $("#select-all2").prop("checked", "checked");
        } else {
            $("#select-all2").removeAttr("checked");
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
     var checked_transactions = $('.select-all-child:checked');
     var checked_transactions_array = [];
     $.each(checked_transactions, function(index, val) {
          checked_transactions_array.push(($(val).prop('value')));
     });
     console.log(checked_transactions_array)

     var ApproverID = {{ auth()->user()->id }};    
     var confirm_approval = confirm('Are You sure you want to approve this transaction ?');
     if(confirm_approval == true) {
       var Comment = prompt("Enter Approval Comment");
       $.ajax({
           url: '/transactions/multipost/approve',
           type: 'POST',
           data: {
              TransactionRef: checked_transactions_array,
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
             document.location.href = '/transactions/multipost_approvallist';
           } else {
              alert('approval failed');
              return false
           }   
       })
       .fail(function() {
           console.log("error");
       });
     } else  {
      return false;
     }
     
     
 });


  $('.reject-btn').click(function(e) {
     e.preventDefault();
      var that = $(this);
     var checked_transactions = $('.select-all-child:checked');
     var checked_transactions_array = [];
     $.each(checked_transactions, function(index, val) {
          checked_transactions_array.push(parseInt($(val).prop('value')));
     });
     console.log(checked_transactions_array)
   var RejectedDate = "{{ \Carbon\Carbon::now() }}";
   var RejecterID = {{ auth()->user()->id }};
     var confirm_rejection = confirm('Are You sure you want to reject this transaction ?');
     
     if(confirm_rejection == true) {
      var Comment = prompt("Enter Rejection Comment");
     $.ajax({
         url: '/transactions/multipost/reject',
         type: 'POST',
         data: {
            TransactionRef: checked_transactions_array,
            Comment: Comment
        },
        beforeSend: function(){
            // show button animation
            that.text('Rejecting ...');
        }
     })
     .done(function(res, status, xhr) {
         // Navigate to the list after succesful posting to the server
         if(xhr.status == 200) {
           document.location.href = '/transactions/multipost_approvallist';
         } else {
            alert('rejection failed');
            return false
         }   
     })
     .fail(function() {
         console.log("error");
     });
     }

         
    });

</script>
        
@endpush



