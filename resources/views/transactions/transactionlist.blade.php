@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    <style>
     /*   textarea {
        max-height: 50px;
        resize: none;
    }*/
     tfoot{
      display: table-header-group;
     }

     @media print {
  .exportOptions {
    display: none;
  }
    </style>
    @endpush
@extends('layouts.master')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">
			Search Using Date Range
		</div>
	</div>
	<div class="panel-body">
		{{ Form::open(['action' => 'TransactionController@TransactionListRange', 'autocomplete' => 'off','role' => 'form']) }}
		<div class="row">
        <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                    {{ Form::label('StartDate', 'Start Date') }}
                    <div class="input-group date dp">
                     {{ Form::text('StartDate', null, ['class' => 'form-control',  'required']) }}
                        <span class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </span>

                </div>
            </div>
                </div>
        </div>
        <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                    {{ Form::label('EndDate', 'End Date') }}
                    <div class="input-group date dp">
                     {{ Form::text('EndDate', null, ['class' => 'form-control', 'required']) }}
                        <span class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </span>

                </div>
            </div>
                </div>
        </div>
    </div>
    <div class="row">
            <div class="pull-right">

            {{ Form::submit( 'Search', [ 'class' => 'btn btn-complete ' ]) }}
                {{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
            </div>
        </div>
		{{ Form::close() }}
	</div>
</div>
@endsection

@section('bottom-content')
<div class="container-fluid container-fixed-lg">
	<!-- START PANEL -->
	<div class="panel panel-default" id="print-content">
		<div class="panel-heading">
				<div class="panel-title">
					Transaction List
				</div>
				{{-- <div class="pull-right">
					<div class="col-xs-12">
						<input type="text" class="search-table form-control pull-right" placeholder="Search">
					</div>
				</div> --}}
				<div class="clearfix"></div>
			<div class="panel-body">
				<table id="transactions">
					<thead>
                        <th>Ref</th>
                        <th>GL ID</th>
                        <th>Account Name</th>
                        <th>Post Date</th>
                        <th>Value Date</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                        <th>Naration</th>
                        <th>Input</th>
                        <th>Input Date</th>
                        <th>Transaction Code</th>
                    </thead>
                    <tfoot class="thead">
                      <th>Ref</th>
                        <th>Account Number</th>
                        <th>Customer Details</th>
                        <th>Post Date</th>
                        <th>Value Date</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                        <th>Naration</th>
                        <th>Input</th>
                        <th>Input Date</th>
                        <th>Transaction Code</th>
                    </tfoot>
                    <tbody>
                        @foreach($trans as $tran)
                        <tr>
                            <td>{{$tran->TransactionRef}}</td>
                            <th>{{$tran->AccountNumber}}</th>
                            <td>{{$tran->Details}}</td>
                            <td>{{$tran->PostDate}}</td>
                            <td>{{$tran->ValueDate}}</td>
                            <td>{{number_format($tran->Debit, 2)}}</td>
                            <td>{{number_format($tran->Credit, 2)}}</td>
                            <td>{{number_format($tran->Balance, 2)}}</td>
                            <td>{{$tran->Narration}}</td>
                            <td>{{$tran->InputterID}}</td>
                            <td>{{$tran->InputDatetime}}</td>
                            <td>{{$tran->TransactionCode}}</td>
                        </tr>
                        @endforeach
                    </tbody>
				</table>
			</div>
		</div>
		<!-- END PANEL -->
	</div>
	@endsection

	 @push('scripts')
        <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
        
        <script>
        $(function(){
            var options = {
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                autoclose:true
            };
            $('.dp').datepicker(options);
        })
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
    // "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
    sDom: 'lfrB<"pull-right">tip',
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
     buttons: [
            'copy', 'excel', 'pdf', 'print', {
                extend: 'colvis',
                columns: ':gt(0)',
                text: 'Columns'
            }
        ],
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
