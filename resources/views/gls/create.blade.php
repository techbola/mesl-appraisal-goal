@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}

tfoot{
      display: table-header-group;
     }

     @media print {
  .exportOptions {
    display: none;
  }
  </style>
@endpush

@section('content')
<div class="card-box">
		<div class="card-title">
			Search General Ledger
		</div>
		
		<div class="row">
			<div class="pull-right" style="padding: 10px">
				<a href="#" class="btn btn-lg btn-info" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler2" title="">Create New GL</a>
			</div><div class="clearfix"></div>
			
			<div class="col-md-6 col-md-offset-3">
				 {{ Form::open(['id' => 'gl_form', 'autocomplete' => 'off', 'role' => 'form']) }}
				 
				  <div class="col-sm-12">
                   <div class="form-group">
                           {{ Form::label('Account Type', 'Select Account Type') }}
                           <select name="Account Type"  id="BuildingProject_id" onchange="get_gl_details()" class="form-control select2"    data-init-plugin="select2" required>
                               <option value="">Account Type</option>
                               @foreach($accounts as $account)
                                   <option value="{{ $account->AccountTypeRef }}">{{ $account->AccountType }}</option>
                               @endforeach
                           </select>
                   
               </div>
           </div>
               {{ Form::close() }}
			</div>
		</div>
</div>
<div class="page-content-wrapper "> 
     <div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
                 <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-body" style="background: #eee; color: #000">
                	<div class="modal-header" style="background: #eee; color: #000">
                           <h5 class="text-left p-b-5"><span class="semi-bold" id="title"></span></h5>
                    </div><hr>
                     <div id="add_new_gl_div" class="hide">
                         {{ Form::open(['action' => 'GLController@store', 'role' => 'form']) }}
		                        @include('gls.form', ['buttonText' => 'Create GL'])
		                 {{ Form::close() }}
		             </div>
		          </div>
              </div>
                 </div>
                <div class="modal-footer">
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
        <div class="page-content-wrapper "> 
     <div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="edit2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
                 <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-body" style="background: #eee; color: #000">
                	<div class="modal-header" style="background: #eee; color: #000">
                           <h5 class="text-left p-b-5"><span class="semi-bold" id="title">Edit General Ledger Details</span></h5>
                    </div><hr>
		                 {{ Form::open(['id' => 'submit_gl_edit_form', 'role' => 'form']) }}
		                        @include('gls.edit_form')
		                 {{ Form::close() }}
		          </div>
              </div>
                 </div>
                <div class="modal-footer">
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
@endsection


@section('bottom-content')
<div id="gl_data_table" class="hide">
	<div class="card-box">
		<div class="card-title pull-left">
			GLs Listing
		</div>
		{{-- <div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div><div class="clearfix"></div> --}}

			<table id="transactions" class="table tableWithSearch table-striped table-bordered">
				<thead>
					<th>Customer Ref</th>
					<th>Customer</th>
					<th>Account Type</th>
					<th>Currency</th>
					<th>Branch</th>
					<th>AccountNo</th>
					<th>BookBalance</th>
					<th>Description</th>
					<th></th>
				</thead>
				<tfoot class="thead">
					<th>Customer Ref</th>
					<th>Customer</th>
					<th>Account Type</th>
					<th>Currency</th>
					<th>Branch</th>
					<th>AccountNo</th>
					<th>BookBalance</th>
					<th>Description</th>
					<th></th>
				</tfoot>
				<tbody id="gl_table_body">
				</tbody>
			</table>
	</div>
</div>
</div>
@endsection

@push('scripts')
	<script>

		$('#btnFillSizeToggler2').click(function(event) {
			$('#add_new_gl_div').removeClass('hide');
			$('#title').html('Add new General Ledger Account');
		});

		$('#edit2').click(function(event) {
			$('#add_edit_gl_div').removeClass('hide');
			$('#title').html('Edit General Ledger Account Details');
			
		});

		function get_gl_details()
		{
			$('#gl_data_table').removeClass('hide');
			var account_id = $('#BuildingProject_id').val();
			$.post('/get_gl_details_using_account_type_id/' +account_id, $('#gl_form').serialize(), function(data, status) {
				if(status == 'success')
				{
					$('#gl_table_body').html(' ');
					$.each(data, function(index, val) {
						$('#gl_table_body').append(`
					<tr>
						<td>${val.GLRef }</td>
						<td>${val.Customer }</td>
						<td>${val.AccountType }</td>
						<td>${val.Currency}</td>
						<td>${val.Branch }</td>
						<td>${val.AccountNo }</td>
						<td>${val.BookBalance }</td>
						<td>${val.Desc}</td>
						<td class="actions">
							<a href="#" class="btn btn-lg btn-primary" id="edit2" onclick="get_general_ledger_details(${val.GLRef })" data-target="#edit2" data-toggle="modal"  title="">Edit GL</a>
						</td>
					</tr>
							`);
					});
				}
			});
			
		}
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


<script>
  $('.exportOptions').append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
</script>
@endpush
