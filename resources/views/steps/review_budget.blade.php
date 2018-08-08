@extends('layouts.master')

@section('title')
  Review Budget
@endsection

@section('page-title')
  <span class="text-muted">Review Budget For Project Steps</span>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Review Budget</div>
    <table class="table table-bordered tableWithSearch">
      <thead>
        <th>Step Description</th>
        <th>Budget Cost</th>
        <th>Task / Project</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($updates as $update)
          <tr>
            <td>{{ $update->step->Step ?? '' }}</td>
            <td>{{ nairazify(number_format($update->BudgetCost)) }}</td>
            <td class="small">
              <b>Task:</b> {{ $update->step->task->Task }}<br>
              <b>Project:</b> {{ $update->step->task->project->Project }}
            </td>
            <td>{{ $update->step->StartDate ?? '' }}</td>
            <td>{{ $update->step->EndDate ?? '' }}</td>
            <td class="actions">
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
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
