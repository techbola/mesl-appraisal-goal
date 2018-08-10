@extends('layouts.master')

@section('title')
  Budget For Project Steps
@endsection

@section('page-title')
  Budget For Project Steps
@endsection

@section('content')

  {{-- START TABS --}}
  <ul class="nav nav-tabs outside">
    <li class="active"><a data-toggle="tab" href="#complete">Completed Milestones</a></li>
    <li><a data-toggle="tab" href="#incomplete">Incomplete Milestones</a></li>
  </ul>
  <div class="tab-content">
    <div id="complete" class="tab-pane fade in active">


      <div class="card-box">
        <div class="card-title">Budget Entry</div>
        <table class="table table-bordered tableWithSearch">
          <thead>
            <th width="20%">Project / Task</th>
            <th width="20%">Milestone</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th width="15%">Budget Cost</th>
            <th width="15%">Variation</th>
            <th width="8%">Status</th>
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
                  @if (empty($step->last_budget) || $step->last_budget->Status == '0')
                    <form action="{{ route('submit_budget', $step->StepRef) }}" method="post">
                      {{ csrf_field() }}
                      <input type="text" class="form-control input-sm smartinput" name="BudgetCost" placeholder="Budget amount" autocomplete="off">
                      <button type="submit" name="button" class="btn btn-sm btn-success" onclick="$('#spinner').show()">Send</button>
                    </form>
                  @elseif(!empty($step->last_budget))
                    {{ ngn($step->last_budget->BudgetCost) }}
                  @endif
                </td>
                <td>

                  @if(!empty($step->last_budget) && $step->last_budget->Status == '1')
                    {{ ngn($step->last_budget->Variation) }}
                  @elseif(empty($step->last_budget))
                    {{ ngn('0') }}
                  @else
                    <form class="" action="{{ route('submit_variation', $step->StepRef) }}" method="post">
                      {{ csrf_field() }}
                      <input type="text" class="form-control input-sm smartinput" name="Variation" placeholder="Variation amount" value="{{ $step->last_budget->Variation ?? '' }}" autocomplete="off">
                      <button type="submit" name="button" class="btn btn-sm btn-success" onclick="$('#spinner').show()">Send</button>
                    </form>
                  @endif
                </td>
                <td class="actions small">
                  @if (empty($step->last_budget))
                    &mdash;
                  @elseif(!empty($step->last_budget) && $step->last_budget->Status == NULL)
                    Pending
                  @elseif(!empty($step->last_budget) && $step->last_budget->Status == '1')
                    Approved
                  @elseif(!empty($step->last_budget) && $step->last_budget->Status == '0')
                    Rejected
                  @endif
                  {{-- <a href="#" class="btn btn-sm btn-success submit_budget" data-id="{{ $step->StepRef }}">Save</a> --}}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>


    </div>
    <div id="incomplete" class="tab-pane fade">

      @include('steps.incomplete_milestones')

    </div>
  </div>
  {{-- END TABS --}}

@endsection

@push('scripts')
  <script>
    $('.submit_budget').click(function(){
      var budget = $(this).closest('tr').find('input[name=BudgetCost]').val();
      var variation = $(this).closest('tr').find('input[name=Variation]').val();
      var StepID

      $.post('/submit_budget/'+$(this).data('id'), {BudgetCost:budget, Variation:variation}, function(data, status){
        $(this).closest('tr').find('.actions').html('<span class="text-success">Sent</span>');
        $(this).closest('tr').find('input[name=BudgetCost]').attr('disabled');
        $(this).closest('tr').find('input[name=Variation]').attr('disabled');
      });
    });
  </script>
@endpush
