@extends('layouts.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/doc_data.css') }}">

<style>
    .actionBtn button {
    margin-right: 10px
}
</style>
@endpush
@section('bottom-content')
<section class="bg-white container-fluid container-fixed">
    <div class="panel panel-transparent" id="bondslist">
            <div class="panel-heading">
                <div class="panel-title">
                    Approval List
                </div>
                <div class="pull-right">
                    <div class="col-xs-12">
                        {{-- <input class="form-control pull-right search-table" placeholder="Search" type="text"> --}}
                    </div>
                </div>
                <div class="clearfix">
                </div>
            </div>

            <div class="panel-body">
                
                <table class="table tableWithSearch_a">
                        <thead>
                            <th><div class="checkbox check-info">
                      <input type="checkbox" id="select-all">
                      <label for="select-all" class="text-white">Bulk Select</label>
                    </div></th>
                           <th width="20%">Document Name</th>
                            <th width="15%">Type</th>
                            <th width="20%">Upload Date</th>
                            <th width="20%">Uploaded By</th>
                            <th>Download</th>
                        </thead>
                        <tbody>
                            @foreach( $docs as $doc)
                            <tr>
                                <td>
                                    <div class="checkbox check-info">
                      <input type="checkbox" id="select-all-child-{{ $doc->DocRef }}" class="select-all-child" value="{{ $doc->DocRef }}">
                      <label for="select-all-child-{{ $doc->DocRef }}" class="text-white"></label>
                    </div>
                                </td>
                                <td>
                                    {{ $doc->Description }}
                                </td>
                                <td>{{ $doc->doctype->DocType ?? '' }}</td>
                            <td>{{ date('jS M, Y - g:ia', strtotime($doc->UploadDate)) }}</td>
                            <td>{{ $doc->initiator->FullName ?? '-' }}</td>
                            {{-- <td><a href="#" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
                            {{-- <td><a href="{{ $doctype->Path}}" style="color : blue !important">{{ $doctype->Filename}}</a></td> --}}
                            <td><a href="{{ route('docs', ['file'=>$doc->Filename]) }}" class="small text-complete" data-toggle="tooltip" title="Download document">{{ $doc->Filename}}<i class="fa fa-download m-l-5"></i></a></td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>

        <hr>


</section> <hr>


@endsection



@push('scripts')
        <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
        </script>

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
             dom: "<'row'<'col-sm-4'<'actionBtn'>> <'col-sm-4 text-center'B><'col-sm-4'f>> <'table-responsive 't> p",
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
     var checked_docs = $('.select-all-child:checked');
     var checked_docs_array = [];
     $.each(checked_docs, function(index, val) {
          checked_docs_array.push(parseInt($(val).prop('value')));
     });
     console.log(checked_docs_array)
   var ApprovedDate = "{{ \Carbon\Carbon::now() }}";
   var ApproverID = {{ auth()->user()->id }};
     alert('Are You sure you want to approve this document ?');
     var Comment = prompt("Enter Approval Comment");
     
     $.ajax({
         url: '/approvallist/approve',
         type: 'POST',
         data: {
            ApproverID: {{ auth()->user()->id }},
            SelectedID: checked_docs_array,
            ApprovedDate: ApprovedDate,
            ApprovedFlag: 1,
            ModuleID: 1, // PREDEFINED 
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
            window.location.href  = "{{ route('docs_approvallist') }}";
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
     var checked_docs = $('.select-all-child:checked');
     var checked_docs_array = [];
     $.each(checked_docs, function(index, val) {
          checked_docs_array.push(parseInt($(val).prop('value')));
     });
     console.log(checked_docs_array)
   var RejectedDate = "{{ \Carbon\Carbon::now() }}";
   var RejecterID = {{ auth()->user()->id }};
     alert('Are You sure you want to reject this document ?');
     var Comment = prompt("Enter Rejection Comment");
     
     $.ajax({
         url: '/approvallist/reject',
         type: 'POST',
         data: {
            RejecterID: {{ auth()->user()->id }},
            SelectedID: checked_docs_array,
            RejectedDate: RejectedDate,
            RejectedFlag: 1,
            ModuleID: 1, // predefined in the DB
            Comment: Comment
        },
     })
     .done(function(res, status, xhr) {
         // Navigate to the list after succesful posting to the server
         if(xhr.status == 200) {
            window.location.href  = "{{ route('docs_approvallist') }}";
         } else {
            alert('Rejection failed');
            return false
         }
         
     })
     .fail(function() {
         console.log("error");
     });
     
 });
        </script>
        
        @endpush

