@extends('layouts.master')

@section('title')
  Budget Payment
@endsection

@section('page-title')
  <span class="">Budget Payments</span>
@endsection

@section('content')
  <style media="screen">
    tbody > tr > td {
      font-size: 13px !important;
    }
  </style>

  <div class="card-box">
    <div class="card-title">Budget Payments</div>
    <table class="table table-bordered tableWithSearch">
      <thead>
        <th width="15%">Project</th>
        <th width="15%">Task</th>
        <th>Milestone</th>
        <th>Project Manager</th>
        <th>Vendor</th>
        <th>Budget Cost</th>
        <th>Amount Paid</th>
        <th>Amount Outstanding</th>
        <th>Amount To Pay</th>
        <th>Actions</th>
        {{-- <th>Start Date</th>
        <th>End Date</th> --}}
        {{-- <th>Actions</th> --}}
      </thead>
      <tbody>
        @foreach ($updates as $update)
          <tr id="budget_{{ $update->id }}">
            <td>
              {{ $update->step->task->project->Project }}
            </td>
            <td>{{ $update->step->task->Task }}</td>
            <td>{{ $update->step->Step ?? '' }}</td>
            <td>{{ $update->step->task->project->supervisor->FullName ?? '&mdash;' }}</td>
            <td>{{ $update->step->task->project->vendor->Customer ?? '&mdash;' }}</td>
            <td>{{ ngn($update->BudgetCost + $update->Variation) }}</td>
            <td>{{ ngn($update->step->payment_made) }}</td>
            <td>{{ ngn($update->step->payment_outstanding) }}</td>
            <td>
              <form class="" action="{{ route('store_step_payment', $update->StepID) }}" method="post">
                {{ csrf_field() }}
                <input type="text" class="form-control input-sm smartinput" name="Amount" placeholder="Amount to pay" autocomplete="off">
                <button type="submit" name="button" class="btn btn-sm btn-success" onclick="$('#spinner').show()">Pay</button>
              </form>
            </td>
            <td>
              @if ($update->step->payment_made == 0)
                <a class="btn btn-danger btn-xs" onclick="reject_payment({{ $update->id }})">Reject</a>
              @endif
            </td>
            {{-- <td>{{ $update->step->StartDate ?? '' }}</td>
            <td>{{ $update->step->EndDate ?? '' }}</td> --}}
            {{-- <td class="actions">
              @if ($update->Status == NULL)
                <a class="btn btn-sm btn-success" onclick="confirm2('Approve this budget?', '', 'approve_budget')">Approve</a>
                <a class="btn btn-sm btn-danger" onclick="confirm2('Reject this budget?', 'The initiator would be able to submit another request.', 'reject_budget')">Reject</a>

                <form class="hidden" id="approve_budget" action="{{ route('approve_step_budget', $update->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                </form>
                <form class="hidden" id="reject_budget" action="{{ route('reject_step_budget', $update->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                </form>
              @elseif($update->Status == '1')
                <span class="text-success">Approved</span>
              @elseif($update->Status == '0')
                <span class="text-danger">Rejected</span>
              @endif
            </td> --}}
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@push('scripts')
  <script>
  function reject_payment(budget_id) {

    swal({
      title: 'Enter rejection comment',
      input: 'textarea',
      showCancelButton: true,
      inputValidator: (value) => {
        return new Promise((resolve, error) => {
          if (value) {
            resolve();
            $.post('/reject_step_payment', {budget_id:budget_id, comment:value}, function(data, status){
              $('#budget_'+budget_id).fadeOut('3000').remove();
            });
          } else {
            error('Please type something.');
          }
        })
      }
    });

  }
  </script>
@endpush
