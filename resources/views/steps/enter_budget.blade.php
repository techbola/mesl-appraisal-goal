@extends('layouts.master')

@section('title')
  Budget For Project Steps
@endsection

@section('page-title')
  Budget For Project Steps
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Budget Entry</div>
    <table class="table table-bordered tableWithSearch">
      <thead>
        <th width="20%">Project / Task</th>
        <th width="20%">Milestone</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Budget Cost</th>
        <th>Variation</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($steps as $step)
          <tr>
            <td class="small">
              <b>Project:</b> {{ $step->task->project->Project }}<br>
              <b>Task:</b> {{ $step->task->Task }}
            </td>
            <td>{{ $step->Step ?? '' }}</td>
            <td data-sort="{{ $step->StartDate }}">{{ nice_date($step->StartDate) ?? '' }}</td>
            <td data-sort="{{ $step->EndDate }}">{{ nice_date($step->EndDate) ?? '' }}</td>
            <td>
              <input type="text" class="form-control input-sm smartinput" name="BudgetCost" value="" autocomplete="off">
            </td>
            <td>
              <input type="text" class="form-control input-sm smartinput" name="Variation" value="" autocomplete="off">
            </td>
            <td class="actions">
              <a href="#" class="btn btn-sm btn-success submit_budget" data-id="{{ $step->StepRef }}">Save</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@push('scripts')
  <script>
    $('.submit_budget').click(function(){
      var budget = $(this).closest('tr').find('input[name=BudgetCost]').val();
      var variation = $(this).closest('tr').find('input[name=Variation]').val();
      var StepID

      $.post('/submit_budget/'+$(this).data('id'), {budget:budget, variation:variation}, function(data, status){
        $(this).closest('tr').find('.actions').html('<span class="text-success">Sent</span>');
        $(this).closest('tr').find('input[name=BudgetCost]').attr('disabled');
        $(this).closest('tr').find('input[name=Variation]').attr('disabled');
      });
    });
  </script>
@endpush
