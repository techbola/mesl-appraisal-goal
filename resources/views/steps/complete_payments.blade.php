@extends('layouts.master')

@section('title')
  Complete Budget Payment
@endsection

@section('page-title')
  <span class="">Complete Budget Payment For Project Steps</span>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Review Budget</div>
    <table class="table table-bordered tableWithSearch">
      <thead>
        <th>Step Description</th>
        <th>Amount To Pay</th>
        <th>Payment Date</th>
        {{-- <th>Start Date</th>
        <th>End Date</th> --}}
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($payments as $payment)
          <tr>
            <td>{{ $payment->step->Step ?? '' }}</td>
            {{-- <td class="small">
              <b>Task:</b> {{ $update->step->task->Task }}<br>
              <b>Project:</b> {{ $update->step->task->project->Project }}
            </td>
            <td>{{ nairazify(number_format($update->BudgetCost)) }}</td>
            <td>{{ nairazify(number_format($update->step->payment_made)) }}</td> --}}
            <td>{{ nairazify(number_format($payment->Amount)) }}</td>
            <td>{{ $payment->created_at }}</td>
            <td>
              @if ($payment->IsPaid)
                <span class="btn bg-muted disabled"><i class="fa fa-check text-success"></i> Paid</span>
              @else
                <button type="submit" name="button" class="btn btn-sm btn-success" onclick="confirm2('Mark {{ $payment->Amount }} paid?', '', 'mark_{{ $payment->PaymentRef }}');">Mark Paid</button>
                <form id="mark_{{ $payment->PaymentRef }}" class="hidden" action="{{ route('mark_step_payment', $payment->PaymentRef) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                </form>
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
