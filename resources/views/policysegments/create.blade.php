@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}

tfoot{
      display: table-header-group;
     }
  </style>
@endpush

@section('title')
  Create Policy Segment
@endsection

@section('page-title')
  Create Policy Segment
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
             {{-- <li role="presentation" class="active"><a href="{{ route('PolicyApprover') }}">Create Policy Approver</a></li> --}}
             <li><a style="background: #bbb" href="{{ route('Policy') }}">Return to Policy Page</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicy') }}">Create New/View Policies</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicyStatement') }}">Create New/View Policy Statements</a></li>
             <li><a href="#" style="color: #fff" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-lg btn-info">Create New/View Policy Segments</a></li>
         </ul>
      </div><div class="clearfix"></div>
      @endif
  			<div class="card-title pull-left" >List Policy Segments</div><div class="clearfix"></div>
           <div class="row">
            <div id="policy_table" style="background: #eee; padding: 10px">
              <table class="table tableWithExportOptions" id="transactions">
                <thead>
                  <tr>
                    <th></th>
                    <th>Entry Date</th>
                    <th>Policy</th>
                    <th>Segment</th>
                    <th>Entered By</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot class="thead">
                  <th></th>
                    <th>Entry Date</th>
                    <th>Policy</th>
                    <th>Segment</th>
                    <th>Entered By</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tfoot>
                <tbody>
                  @foreach($segments as $segment)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $segment->EntryDate }}</td>
                    <td>{{ $segment->Policy }}</td>
                    <td>{{ $segment->Segment }}</td>
                    <td>{{ $segment->first_name }}  {{ $segment->last_name }}</td>
                     <td><a href="#" id="edit_modal" data-id="{{ $segment->SegmentRef }}" data-segment="{{ $segment->Segment }}" data-target="#modalFillIn2" data-toggle="modal"  class="btn btn-success btn-sm"  title="">Edit Policy Segment</a></td>
                    <td><a href="#" id="delete_modal" data-id="{{ $segment->SegmentRef }}" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-danger btn-sm" title="">Delete Policy Segment</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
           </div>
  	</div> 
  	<!-- END PANEL -->


    <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 600px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000" id="title">New policy Segment</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">

                            <div id="item_div">
                              <div class="col-sm-6" id="segment">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('policy' ) }}
                                               {{ Form::select('PolicyID', [ '' =>  'Select Policy'] + $policies->pluck('Policy', 'PolicyRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose policy",'id'=>'policy_id', 'data-init-plugin' => "select2", 'required']) }}
                                       </div>
                                  </div>
                              </div>

                               <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('policy Segment' ) }}
                                               {{ Form::text('Segment', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Input Policy Segment', 'required']) }}
                                       </div>
                                  </div>
                              </div>
                            </div>
                              <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="add_policy_segment" data-dismiss="modal" value="Add New Policy Segment">
                                <input type="submit" class="btn btn-sm btn-success pull-right hide" id="edit_policy_segment" data-dismiss="modal" value="Save Policy Segment">
                                <input type="submit" class="btn btn-sm btn-danger pull-right hide" id="delete_policy_segment" data-dismiss="modal" value="Delete Policy Segment">
                              </div><p id="xyz" class="hide"></p>
                            
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

     $(document).on('click', '#btnFillSizeToggler2', function(event) {
    $('#title').text('Add New Policy');
     $('#edit_policy_segment').addClass('hide');
    $('#add_policy_segment').removeClass('hide');
    $('#delete_policy_segment').addClass('hide');
    $('#item_div').removeClass('hide');
    $('#item').val(' ');
  });


      $(document).on('click', '#edit_modal', function(event) {
          $('#title').text('Edit Policy Segment');
          $('#edit_policy_segment').removeClass('hide');
          $('#add_policy_segment').addClass('hide');
          $('#delete_policy_segment').addClass('hide');
          var id = $(this).data('id');
           var segment = $(this).data('segment');
          $('#xyz').text(id);
           $('#item').val(segment);
          $('#item_div').removeClass('hide');
          $('#segment').addClass('hide')
    });

       $(document).on('click', '#delete_modal', function(event) {
        $('#title').text('Are you sure you want to delete these Policy Segment?');
         $('#delete_policy_segment').removeClass('hide');
         $('#add_policy_segment').addClass('hide');
         $('#edit_policy_segment').addClass('hide');
         var id = $(this).data('id');
         $('#xyz').text(id);
         $('#item_div').addClass('hide');

    });

      
   $("#add_policy_segment").click(function(e){
         var policy = $('#policy_id').val();
          var segment = $('#item').val();
          $.post('/Post_Policy_segment', {'PolicyID': policy, 'Segment': segment, '_token':$('input[name=_token]').val()}, function(data, textStatus, xhr) {
           console.log(data);
           $('#policy_table').load(location.href + ' #policy_table');
        });  
    });


    $("#delete_policy_segment").click(function(e){
    // $(document).on('click', '#delete_policy_segment', function(event) {
    var id = $('#xyz').text();
    $.get('/delete_policy_segment/'+id,  function(data, status) {
      console.log(status);
     $('#policy_table').load(location.href + ' #policy_table');
    });
  });

    $("#edit_policy_segment").click(function(e){
    // $(document).on('click', '#edit_policy_segment', function(event) {
    var id = $('#xyz').text();
    var segment = $('#item').val();
    var policy = $('#policy_id').val();
    $.get('/update_policy_segment/'+id+'/'+segment,  function(data, status) {
      console.log(status);
     $('#policy_table').load(location.href + ' #policy_table');
    });
  });

    

  });

</script>

<script src="{{ asset('js/jquery.tabledit.js') }}"></script>
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  // $('#transactions').editableTableWidget();
  // $(document).ready(function(){
     var settings = {
    "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
    "sPaginationType": "bootstrap",
    "destroy": true,
    "scrollCollapse": true,
    "oLanguage": {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
     // "columnDefs": [
     //        {
     //            "targets": [ 3 ],
     //            "visible": false
     //        }
     //    ],
    "iDisplayLength": 20,
    "oTableTools": {
        "sSwfPath": "../assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
        "aButtons": [{
            "sExtends": "csv",
            "sButtonText": "<i class='pg-grid'></i>",
        }, {
            "sExtends": "xls",
            "sButtonText": "<i class='fa fa-file-excel-o'></i>",
        }, {
            "sExtends": "pdf",
            "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
        }, {
            "sExtends": "copy",
            "sButtonText": "<i class='fa fa-copy'></i>",
        }]
    },
    fnDrawCallback: function(oSettings) {
        $('.export-options-container').append($('.exportOptions'));
    }
};


var table = $('#transactions').DataTable(settings);
 $('#transactions tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#transactions tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="form-control" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
  // });
</script>

@endpush


