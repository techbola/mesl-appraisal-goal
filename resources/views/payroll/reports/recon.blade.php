@extends('layouts.master')

@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		{{-- <button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_staff">Set Payroll Period</button> --}}
	{{-- </div> --}}
@endsection

@section('content')
	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_staff">New Staff</button>
	</div> --}}

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Payroll Reconciliation Report.
		</div>
		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search" style="width: 200px; margin-left: 10px">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel-body">
			<table id="recon" class="table tableWithSearch table-striped table-bordered">
				<thead>
					{{-- <th></th> --}}
					<th>Full Name</th>
					<th>Old Deduction</th>
					<th>New Deduction</th>
					<th>Deduction Difference</th>
					<th>Old Net Pay</th>
					<th>New Net Pay</th>
					<th>Net Pay Difference</th>
				</thead>
				<tfoot class="thead">
					{{-- <th></th> --}}
					<th>Full Name</th>
					<th>Old Deduction</th>
					<th>New Deduction</th>
					<th>Deduction Difference</th>
					<th>Old Net Pay</th>
					<th>New Net Pay</th>
					<th>Net Pay Difference</th>
				</tfoot>
				<tbody>
					@foreach($recons as $recon)
					<tr>
						{{-- <td></td> --}}
						<td>{{ $recon->staff->Fullname ?? 'No Name' }}</td>
						<td>{{ number_format($recon->PreviousDeductions, 2) }}</td>
						<td>{{ number_format($recon->LatestDeductions, 2) }}</td>
						<td>{{ number_format($recon->DeductionDiff , 2) }}</td>
						<td>{{ number_format($recon->LatestNetPay, 2) }}</td>
						<td>{{ number_format($recon->PreviousNetPay, 2) }}</td>
						<td>{{ number_format($recon->NetPayDiff, 2) }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<!-- END PANEL -->

	{{-- MODALS --}}
	<!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_staff" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h4>Configure Pay Period</h4>
            <p class="p-b-10">Choose a <b>start date</b> and <b>end date</b></p>
          </div>
          <div class="modal-body">

				{{ Form::open(['action' => 'PayrollRateController@store']) }}
					<div class="row">
						<div class="form-group col-sm-6">
				            {{ Form::label('MonthStartDate','Start Date') }}
				            <div class="input-group date dp">
				                {{ Form::text('MonthStartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date']) }}
				                <span class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                </span>
				            </div>
				        </div>

				        <div class="form-group col-sm-6">
				            {{ Form::label('MonthStartDate','Month Start Date') }}
				            <div class="input-group date dp">
				                {{ Form::text('MonthEndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date']) }}
				                <span class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                </span>
				            </div>
				        </div>
					</div>


					<div class="row">
						<div class="col-xs-12">
							<button class="btn btn-success">Set payroll dates</button>
						</div>
					</div>
				{{ Form::close() }}

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->
@endsection


@push('scripts')
<script>
	$('#apply_updates').click(function(e) {
		// e.preventDefault();
		var button_text = $(this).html();
		var that = $(this);
		$.ajax({
			url: '{{ url('/payroll/apply-updates') }}',
			type: 'POST',
			beforeSend: function(){
				that.text('Applying Update...');
			}
		})
		.done(function(data) {
			that.text(button_text);
			showNotification('bar', data , 'top', 5000, 'success');
		})
		.fail(function(error) {
			that.text(button_text);
			console.log(error);
		});

	});

	var table = $('#recon').DataTable();
// var tfoot = $('#recon thead tr').clone().prop('id', 'tfoot');
// $('#recon thead').after('<tfoot></tfoot>');
// $('#recon tfoot').append(tfoot);
			$('#recon tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#recon tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="my-input input-sm" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
				$('#recon tfoot tr').appendTo('#recon thead');
</script>
@endpush
