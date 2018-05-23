@extends('layouts.master')

@section('buttons')
	{{-- <div class="clearfix m-b-20"> --}}
		<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_staff">Set Payroll Period</button>
	{{-- </div> --}}
@endsection

@section('content')
	{{-- <div class="clearfix m-b-20">
		<button class="btn btn-info pull-right" data-toggle="modal" data-target="#new_staff">New Staff</button>
	</div> --}}

	<!-- START PANEL -->
	<div class="card-box">
		<div class="card-title pull-left">
			Manual Deductions
		</div>
		<div class="pull-right">
			<div class="col-xs-12">
				{{-- <button id="process_payroll" class="btn btn-info" title="Updates Employee's payroll group">Process Payroll</button> --}}
				<input type="text" class="search-table form-control pull-right" placeholder="Search" style="width: 200px; margin-left: 10px">
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table tableWithSearch2 table-striped table-bordered">
					<thead>
						<th style="width: 10%">Staff Name</th>
						<th>Deduction Type</th>
						<th>Narration</th>
						<th>Effective Date</th>
						<th style="width: 15%">Amount</th>
						<th style="width: 5%">Action</th>
					</thead>
					<tbody>
						@foreach($employees as $emp)
						<tr>
							<td>{{ $emp->Fullname }}</td>
							<td>
								{{ Form::select('DeductionID', ['' => 'Select Deduction Type'] + $deduction_types->pluck('DeductionItem', 'DeductionItemRef')->toArray(), null, ['class' => 'form-control deduction'] ) }}
							</td>
							<td>
								{{ Form::text('Narration', null, ['class' => 'form-control narration', 'placeholder' => 'Enter Narration']) }}
							</td>
							<td>
								<div class="input-group date dp">
					                {{ Form::text('EffectiveDate', null, ['class' => 'form-control ef-date', 'placeholder' => 'Choose Date']) }}
					                <span class="input-group-addon">
					                    <i class="fa fa-calendar">
					                    </i>
					                </span>
					            </div>
							</td>
							<td>
								<input type="text" name="Amount" class="smartinput form-control amount" placeholder="Enter Amount">
							</td>
							<td>
								{{ Form::hidden('StaffID', $emp->UserID, ['class' => 'staffid']) }}
								<button class="btn btn-sm btn-complete deduction-row-btn deduction-row-btn">Add</button>
								<button class="btn btn-sm btn-inverse">View</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
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
				                {{ Form::text('MonthStartDate', null, ['class' => 'form-control', 'placeholder' => 'Satrt Date']) }}
				                <span class="input-group-addon">
				                    <i class="fa fa-calendar">
				                    </i>
				                </span>
				            </div>
				        </div>

				        <div class="form-group col-sm-6">
				            {{ Form::label('MonthStartDate','Month Start Date') }}
				            <div class="input-group date dp">
				                {{ Form::text('MonthEndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date']) }}
				                <span class="input-group-addon">
				                    <i class="fa fa-calendar">
				                    </i>
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
	$('#process_payroll').click(function(e) {
		// e.preventDefault();
		var button_text = $(this).html();
		var that = $(this);
		$.ajax({
			url: '{{ url('/payroll/process-payroll') }}',
			type: 'POST',
			beforeSend: function(){
				that.text('Processing Payroll...');
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

	// 
	 var row_button = $(".deduction-row-btn");
      row_button.click(function(e) {
        var _that = $(this);
        e.preventDefault();
        var its_row = $(this).closest('tr'),
        	deduction = its_row.find('.deduction').val(),
        	narration = its_row.find('.narration').val(),
        	inputter = {{ auth()->user()->id }}
        	amount = AutoNumeric.unformat(its_row.find('.amount').val(), { currencySymbol:'₦'}),
        	date = its_row.find('.ef-date').val(),
        	staff = its_row.find('.staffid').val();
     		// data to be passed
     	var row_data = {
	        StaffID: staff,
	        DeductionID: deduction,
	        Amount: amount,
	        Narration: narration,
	        InputterID: inputter,
	        EffectiveDate: date
	      };	
	      
      $.ajax({
        url: '{{ route('payroll.deductions.store') }}',
        type: 'POST',
        dataType: 'JSON',
        data: row_data,
        beforeSend: function(){
          _that.text('saving..');
        }
      })
      .done(function(data, status,jqxhr) {
        console.log(status)
        console.log(jqxhr)

         _that.text('Add');
        console.log(data);
        its_row.find('.deduction').val(0)
        its_row.find('.amount').val(0)
        its_row.find('.narration').val("");
      })
      .fail(function(error) {
        console.log(error);
        if(error.status == 200){
         _that.text('Add');
        its_row.find('.deduction').val(0)
        its_row.find('.amount').val(0)
        its_row.find('.narration').val("");
        }
      })
      .always(function() {
        console.log("complete");
      });
      
    });
</script>
@endpush
