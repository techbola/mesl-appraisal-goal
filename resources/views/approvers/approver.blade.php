@extends('layouts.master')
@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}
  </style>
@endpush
{{-- title section --}}
@section('title')
    Officemate | Leave Approval
@endsection

{{-- body section --}}
@section('content')
	<div class="row">
	<div class="col-md-4">
		<div class="card-box">

			<div class="row">
			<div style="background: #eee; padding: 20px">
				<h5 style="font-weight: bold !important">Search for Leave Details</h5><hr>
				{{ Form::open(['id' => 'Search_for_leave_details', 'autocomplete' => 'off','role' => 'form']) }}


                  <div class="form-group">
                    <div class="controls">
                           {{ Form::label('ModuleID', 'Leave Details') }}
                           {{ Form::select('ModuleID', [''=>'Select from options', '1'=>'Search for Leave Approvers', '2'=>'Pending Leave Request', '3'=>'Completed Leave Request'],null, ['data-init-plugin'=>'select2', 'class' => 'full-width', 'onchange'=>'get_leave_details()', 'id'=>'data']) }}
                           
                    </div>
                  </div>
                 {{--  <div>
                  <button type="submit" class="btn btn-primary btn-sm pull-right" id="search_new_approver">Search</button></div><div class="clearfix"></div> --}}

		        {{ Form::close() }}
			</div>
		</div><br><hr>
			<div class="row">
			<div style="background: #eee; padding: 20px">
				<h5 style="font-weight: bold !important">Create New Leave Approvers</h5><hr>
				{{ Form::open(['id' => 'new_approver', 'autocomplete' => 'off','role' => 'form']) }}

				  <div class="form-group">
                    <div class="controls">
                           {{ Form::label('StaffID', 'Staff Name') }}
                           {{ Form::select('StaffID', [''=>'Select StaffName'] + $staffs->pluck('FullName', 'StaffRef')->toArray(),null, ['data-init-plugin'=>'select2', 'class' => 'full-width']) }}
                           
                    </div>
                  </div>
                  <input type="hidden" name="ModuleID" value="3">
                  <div>
                  <button type="submit" class="btn btn-primary btn-sm pull-right" id="submit_new_approver">Save</button></div><div class="clearfix"></div>

		        {{ Form::close() }}
			</div>
		</div>
		</div>
	</div>

	<div class="col-md-8">
		<div class="panel panel-default" id="leave_table">
    <div class="panel-heading">
      <h3 class="panel-title" id="title"></h3>
      <div class="pull-right">
				<div class="col-xs-12">
					<input type="text" class="search-table form-control pull-right" placeholder="Search">
				</div>
			</div>
			<div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table tableWithSearch tableWithExportOptions table-bordered">
        <thead>
          <tr>
            <th width="15%">Name</th>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Number of Days</th>
            <th>List of Approvers</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="leave_body">
         
        </tbody>

      </table>
    </div>
  </div>


  <div class="panel panel-default hide" id="approver_table">
    <div class="panel-heading">
      <h3 class="panel-title" id="title">Leave Request Approvers</h3>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table tableWithSearch tableWithExportOptions table-bordered">
        <thead>
          <tr>
            <th width="15%">Name</th>
            <th>Email Address</th>
          </tr>
        </thead>
        <tbody id="approver_body">
         
        </tbody>

      </table>
    </div>
  </div>
	</div>
</div>


<div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000">Are you sure u want to approve Leave request ? </span></h5>
                </div>
                <div class="modal-body">
                	<input type="hidden" id="request_code" >
                  <a href="@" class="btn btn-primary btn-sm pull-right" id="confirm_button" title="">Confirm</a>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>

@endsection
@push('scripts')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js') }}"></script>

	<script>
		$('#submit_new_approver').click(function(event) {
			event.preventDefault();
			$.post('/save_new_approver', $('#new_approver').serialize(), function(data, status) {
				alert('done');
			});
			return false;
		});

		function get_leave_details()
		{
			var ref = $('#data').val();

			if(ref == 1)
			{
				$('#leave_table').addClass('hide');
        $('#approver_table').removeClass('hide');
        $.get('/get_leave_approvers_details', function(data) {
          $('#approver_body').html(' ');
          $.each(data, function(index, val) {
             $('#approver_body').append(`
                <tr>
                  <td>${val.fullname}</td>
                  <td>${val.email}</td>
                </tr> 
              `);
          });
        });

			}
      else if(ref == 2)
			{
        $('#leave_table').removeClass('hide');
        $('#approver_table').addClass('hide');
				$.get('/get_pending_leave_request', function(data) {
					console.log(data);
					$('#leave_body').html(' ');
					$.each(data, function(index, val) {
						 $('#leave_body').append(`
						 		<tr>
						 			<td>${val.fullname}</td>
						 			<td>${val.LeaveType}</td>
						 			<td>${val.StartDate}</td>
						 			<td>${val.ReturnDate}</td>
						 			<td>${val.NumberofDays}</td>
						 			<td>${val.approvers}</td>
						 			<td><a href="#" data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-success btn-xs" onclick="confirmation(${val.LeaveReqRef})" title="">Confirm</a></td>
						 		</tr>	
						 	`);
					});
			    });
			    $('.dataTables_empty').addClass('hide');

			}

			else if(ref == 3)
			{
        $('#leave_table').removeClass('hide');
        $('#approver_table').addClass('hide');
				$.get('/get_completed_leave_request', function(data) {
					console.log(data);
					$('#leave_body').html(' ');
					$.each(data, function(index, val) {
						 $('#leave_body').append(`
						 		<tr>
						 			<td>${val.fullname}</td>
						 			<td>${val.LeaveType}</td>
						 			<td>${val.StartDate}</td>
						 			<td>${val.ReturnDate}</td>
						 			<td>${val.NumberofDays}</td>
						 			<td>${val.approvers}</td>
						 			<td><span style="color : green">Confirmed</span></td>
						 		</tr>	
						 	`);
					});
			    });
			}
			
		}

		function confirmation(id)
		{
			$('#request_code').val(id);
		}

		$('#confirm_button').click(function(event) {
			event.preventDefault();
			var code = $('#request_code').val();
			$.get('/confirm_leave_request/'+code, function(data) {
					$('#leave_body').html(' ');
					$.each(data, function(index, val) {
						 $('#leave_body').append(`
						 		<tr>
						 			<td>${val.Fullname}</td>
						 			<td>${val.LeaveType}</td>
						 			<td>${val.StartDate}</td>
						 			<td>${val.ReturnDate}</td>
						 			<td>${val.NumberofDays}</td>
						 			<td></td>
						 			<td><a href="#" data-target="#modalFillIn" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-success btn-xs" onclick="confirmation(${val.LeaveReqRef})" title="">Confirm</a></td>
						 		</tr>	
						 	`);
					});
			});
			$('#modalFillIn').modal('toggle');
		});

		
	</script>


	<script>
  var initTableWithExportOptions = function() {
    var table = $('.tableWithExportOptions');
        var settings = {
          "order": [],
            "sDom": "<'exportOptions pull-right'T><'table-responsive't><'row'<p i>>",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
            },
            "iDisplayLength": 15,
            "oTableTools": {
                "sSwfPath": "/assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
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
                $('#ToolTables_tableWithExportOptions_0').tooltip({
                    title: 'Export as CSV',
                    container: 'body'
                });
                $('#ToolTables_tableWithExportOptions_1').tooltip({
                    title: 'Export as Excel',
                    container: 'body'
                });
                $('#ToolTables_tableWithExportOptions_2').tooltip({
                    title: 'Export as PDF',
                    container: 'body'
                });
                $('#ToolTables_tableWithExportOptions_3').tooltip({
                    title: 'Copy data',
                    container: 'body'
                });
            }
        };
        table.dataTable(settings);
  }
  initTableWithExportOptions();
  </script>

  <script>
    $('.exportOptions').addClass("m-t-10 m-b-10").append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
  </script>
@endpush