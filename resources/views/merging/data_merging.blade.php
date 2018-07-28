@extends('layouts.master')
@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    <style>
     tfoot{
      display: table-header-group;
     }

     @media print {
  .exportOptions {
    display: none;
  }
    </style>
    @endpush

@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Data Merging
			</div>
		</div>
		<div class="panel-body"> 
			<div class="row">
				<div class="col-md-6" id="actual">
					<div style="padding: 10px; background: #eee">
						<div id="allocation">
						<table class="table" id="transactions">
							<thead>
								<tr>
									<th>Action</th>
									<th>Allotee</th>
									<th>Estate N0</th>
									<th>Block N0</th>
									<th>Unit</th>
								</tr>
							</thead>
							<tfoot class="thead">
									<th>Action</th>
									<th>Allotee</th>
									<th>Estate N0</th>
									<th>Block N0</th>
									<th>Unit</th>
							</tfoot>
							<tbody>
								@foreach($address1s as $address1)
								<tr>
									<td><input type="checkbox" class="f1" name="ref[]" value="{{$address1->Ref}}"></td>
									<td>{{ $address1->Allotee }}</td>
									<td>{{ $address1->EstateNo }}</td>
									<td>{{ $address1->BlockNo }}</td>
									<td>{{ $address1->Unit }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					</div>
				</div>
                
				<div class="col-md-6" id="update">
					<div style="padding: 10px; background: #eee">
						<div id="customer">
						<table class="table" id="transactions1">
							<thead>
								<tr>
									<th>Action</th>
									<th>Allotee</th>
									<th>File No</th>
									<th>House Type</th>
								</tr>
							</thead>
							<tfoot class="thead">
									<th>Action</th>
									<th>Allotee</th>
									<th>File No</th>
									<th>House Type</th>
							</tfoot>
							<tbody>
								@foreach($address2s as $address2)
								<tr>
									<td><input type="checkbox" value="{{ $address2->Ref }}"></td>
									<td>{{ $address2->Allotee }}</td>
									<td>{{ $address2->FileNo }}</td>
									<td>{{ $address2->HouseType }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
						{{ Form::open(['id'=>'merge_form', 'autocomplete' => 'off', 'role' => 'form']) }}
						   <input type="hidden" id="address1_ref" name="address1">
						   <input type="hidden" id="address2_ref" name="address2">
						<input type="submit" id="submit_form" class="btn btn-sm btn-primary pull-right" value="Merge Data">
					</div>
				</div>
		{{ Form::close() }}
			</div><br><br>

			<div class="row">
				<div id="merged">
				<table class="table table-hover">
					<thead>
						<th>Action</th>
						<th>Allotee</th>
						<th>EstateNo</th>
						<th>BlockNo</th>
						<th>Unit</th>
						<th>FileNo</th>
						<th>HouseType</th>
					</thead>
					<tbody>
						@foreach($merged as $meg)
								<tr>
									<td>{{ $loop->index + 1 }}</td>
									<td>{{ $meg->Allotee }}</td>
									<td>{{ $meg->EstateNo }}</td>
									<td>{{ $meg->BlockNo }}</td>
									<td>{{ $meg->Unit }}</td>
									<td>{{ $meg->FileNo }}</td>
									<td>{{ $meg->HouseType }}</td>
								</tr>
								@endforeach
					</tbody>
				</table>
			</div>
			</div>

		</div>
	</div>
	<!-- END PANEL -->
</div>
@endsection

@push('scripts')
	<script>
		$('#actual input[type=checkbox]').change(function(){
			$('#address1_ref').val('');
          if($(this).is(':checked')){ 
             $('#actual').find('input[type=checkbox]').attr('disabled','');
               $(this).attr('disabled',false);
               var data1 = $(this).val();
               $('#address1_ref').val(data1);
              }else{
                $('#actual').find('input[type=checkbox]').attr('disabled',false);
             }
          });
	</script>

	<script>
		$('#update input[type=checkbox]').change(function(){
			$('#address2_ref').val('');
          if($(this).is(':checked')){ 
             $('#update').find('input[type=checkbox]').attr('disabled','');
               $(this).attr('disabled',false);
              var data2 = $(this).val();
              $('#address2_ref').val(data2);
              }else{
                $('#update').find('input[type=checkbox]').attr('disabled',false);
             }
          });
	</script>

	<script>
		$('#submit_form').click(function(event) {
			$.post('/store_merged_data', $('#merge_form').serialize(), function(data, status) {
                $('#allocation').load(location.href + ' #allocation');
                $('#customer').load(location.href + ' #customer');
                $('#merged').load(location.href + ' #merged');
			});
			return false;
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


 var table = $('#transactions1').DataTable(settings);
 $('#transactions1 tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#transactions1 tfoot th')) {
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


{{-- 
<script>
  $('.exportOptions').append('<span class="btn btn-info btn-cons m-l-10" onclick="window.print()"><i class="fa fa-print m-r-5"></i> Print</span>');
</script> --}}
@endpush
