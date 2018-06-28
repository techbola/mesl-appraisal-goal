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
  Create Policies
@endsection

@section('page-title')
  Create Policies
@endsection

@section('buttons')
  
@endsection 

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <div style="padding: 30px">
        
      </div><div class="clearfix"></div>
      @if(count($check) == 1)
      <div style="padding: 30px">
         <ul class="nav nav-pills pull-right">
             {{-- <li role="presentation" class="active"><a href="{{ route('PolicyApprover') }}">Create Policy Approver</a></li> --}}
             <li><a style="background: #bbb" href="{{ route('Policy') }}">Return to Policy Page</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicySegment') }}">Create New/View Policy Segments</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicyStatement') }}">Create New/View Policy Statements</a></li>
             <li><a href="#" style="color: #fff" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-lg btn-info">Create New/View Policies</a></li>
         </ul>
      </div><div class="clearfix"></div>
      @endif
  			<div class="card-title pull-left" style="font-size: 20px">List Policies</div><div class="clearfix"></div>
           <div class="row"><hr>
            <div id="policy_table"  style="background: #eee; padding: 10px">
              <div class="table-responsive">
              <table class="table tableWithExportOptions" id="transactions">
                <thead>
                  <tr>
                    <th></th>
                    <th>Entry Date</th>
                    <th>Policy</th>
                    <th>Entered By</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot class="thead">
                    <th></th>
                    <th>Entry Date</th>
                    <th>Policy</th>
                    <th>Entered By</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tfoot>
                <tbody>
                  @foreach($policies as $policy)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $policy->EntryDate }}</td>
                    <td>{{ $policy->Policy }}</td>
                    <td>{{ $policy->first_name }}  {{ $policy->last_name }}</td>
                    <td><a href="#" id="edit_modal" data-id="{{ $policy->PolicyRef }}" data-policy="{{ $policy->Policy}}" data-target="#modalFillIn2" data-toggle="modal"  class="btn btn-success btn-sm"  title="">Edit Policy</a></td>
                    <td><a href="#" id="delete_modal" data-id="{{ $policy->PolicyRef }}" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-danger btn-sm" title="">Delete</a></td>
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
          <div class="modal fade fill-in" id="modalFillIn2"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 600px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000" id="title">New policy</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">

                              <div class="col-sm-12" id="item_div">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('New policy' ) }}
                                               {{ Form::text('Policy', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Add New Policy', 'required']) }}
                                       </div>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="add_policy" data-dismiss="modal" value="Add New Policy">
                                <input type="submit" class="btn btn-sm btn-success pull-right hide" id="edit_policy" data-dismiss="modal" value="Save Policy">
                                <input type="submit" class="btn btn-sm btn-danger pull-right hide" id="delete_policy" data-dismiss="modal" value="Delete Policy">
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
     $('#edit_policy').addClass('hide');
    $('#add_policy').removeClass('hide');
    $('#delete_policy').addClass('hide');
    $('#item_div').removeClass('hide');
    $('#item').val(' ');
  });


    $(document).on('click', '#edit_modal', function(event) {
          $('#title').text('Edit Policy');
          $('#edit_policy').removeClass('hide');
          $('#add_policy').addClass('hide');
          $('#delete_policy').addClass('hide');
          var id = $(this).data('id');
           var policy = $(this).data('policy');
          $('#xyz').text(id);
           $('#item').val(policy);
          $('#item_div').removeClass('hide');
    });

       $(document).on('click', '#delete_modal', function(event) {
        $('#title').text('Are you sure you want to delete Policy ?');
         $('#delete_policy').removeClass('hide');
         $('#add_policy').addClass('hide');
         $('#edit_policy').addClass('hide');
         var id = $(this).data('id');
         $('#xyz').text(id);
         $('#item_div').addClass('hide');

    });


     $(document).on('click', '#add_policy', function(event) {
    var policy = $('#item').val();
    $.post('/Post_Policies', {'Policy': policy, '_token':$('input[name=_token]').val()}, function(data, textStatus, xhr) {
     console.log(data);
     $('#policy_table').load(location.href + ' #policy_table');
     
    });
  });

     $(document).on('click', '#delete_policy', function(event) {
    var id = $('#xyz').text();
    $.get('/delete_policy/'+id,  function(data, status) {
      console.log(status);
     $('#policy_table').load(location.href + ' #policy_table');
    });
  });

  $(document).on('click', '#edit_policy', function(event) {
    var id = $('#xyz').text();
    var policy = $('#item').val();
    $.get('/update_policy/'+id+'/'+policy,  function(data, status) {
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


