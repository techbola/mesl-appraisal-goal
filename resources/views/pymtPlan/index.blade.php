@extends('layouts.master')

@section('title')
  Score Card
@endsection

@section('buttons')
  {{-- <a href="{{ route('create_scorecard', $staff->StaffRef) }}" class="btn btn-sm btn-info btn-rounded"><i class="fa fa-plus"></i> Create ScoreCard</a> --}}
@endsection

@section('content')

  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Payment Plan</div>
      <div class=" pull-right"><a href="#" id="add_p" class="btn btn-lg btn-info" data-toggle="modal" data-target="#edit_item">Add New plan</a></div>
      <div class="clearfix"></div> 
      <div class="pull-right">
        <div class="col-xs-12"><br>
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
    </div>
  

   <table class="table tableWithSearch table-striped table-bordered">
      <thead>
        <th></th>
        <th>Plan</th>
        <th>Bill Rate</th>
        <th>Bill First Payment Date</th>
        <th>Bill No of Payment</th>
        <th>Number of Payment per Year</th>
        <th>Bill Last Payment</th>
        <th></th>
        <th></th>
      </thead>
      <tbody id="payment_plan_table_body">
        @foreach ($plans as $plan)
          <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td>{{ $plan->PlanName }}</td>
          <td>{{ $plan->BillRate }}</td>
          <td>{{ $plan->BillFirstPymtDate }}</td>
          <td>{{ $plan->BillNoOfPymt }}</td>
          <td>{{ $plan->NoOfPymtPerYear }}</td>
          <td>{{ $plan->BillLastPymtNo }}</td>
          <td><a href="#" class="btn btn-xs btn-info edit_plan" data-id="{{ $plan->PymtPlanRef }}" data-toggle="modal" data-target="#edit_item">Edit</a></td>
          <td><a href="#" class="btn btn-xs btn-danger">Delete</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>

 <div class="modal fade" id="edit_item" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title" id="title"></h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          <div class="hide" id="payment_add">
             @include('pymtPlan.add_payment_form')
          </div>

          <div class="hide" id="payment_edit">
             @include('pymtPlan.edit_payment_form')
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script>
    $('#add_p').click(function(event) {
      $('#payment_add').removeClass('hide');
      $('#title').html('Add New Payment Plan');
       $('#payment_edit').addClass('hide');
    });

     $('.edit_plan').click(function(event) {
      $('#title').html('Edit Payment Plan');
      $('#payment_add').addClass('hide');
      $('#payment_edit').removeClass('hide');
      var id = $(this).data('id');
      $.get('/get_plan_data/' +id, function(data, status) {
        $('#edit_item #edit_NoOfPymtPerYear').val(data.NoOfPymtPerYear);
        $('#edit_item #edit_BillNoOfPymt').val(data.BillNoOfPymt);
        $('#edit_item #edit_BillFirstPymtDate').val(data.BillFirstPymtDate);
        $('#edit_item #edit_BillRate').val(data.BillRate);
        $('#edit_item #edit_PlanName').val(data.PlanName);
        $('#edit_item #edit_PymtPlanRef').val(data.PymtPlanRef);
        $('#edit_item #edit_BillLastPymtNo').val(data.BillLastPymtNo);
        console.log(data);
      });
    });

  </script>
@endpush





