@extends('layouts.master')

@section('title')
  Budget For Project Steps
@endsection

@section('page-title')
  Budget For Project Steps
@endsection

@section('content')

  <form action="" method="GET" onsubmit="$('#spinner').show()">
    <div class="row m-b-20">
      <div class="col-md-3 col-md-offset-2">
        <div class="form-group">
          <label for="">Project</label>
          <select class="full-width select2" data-init-plugin="select2" name="project">
            <option value="">Select Project</option>
            @foreach ($projects as $project)
              <option value="{{ $project->ProjectRef }}" {{ ($project_id == $project->ProjectRef)? 'selected':'' }}>{{ $project->Project }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Milestone Status</label>
          <select class="full-width select2" data-init-plugin="select2" name="status">
            <option value="1" {{ ($status=='1')? 'selected':'' }}>Completed</option>
            <option value="0" {{ ($status=='0')? 'selected':'' }}>Not Completed</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <label></label>
        <button type="submit" class="btn btn-info m-t-25 btn-cons">Fetch</button>
        {{-- <a href="{{ url()->current() }}" class="btn btn-inverse m-t-25 btn-cons" onclick="$('#spinner').show()">Reset</a> --}}
      </div>
    </div>
  </form>

  <div class="card-box">
        <div class="card-title">Budget Entry</div>
        <table class="table table-bordered tableWithSearch">
          <thead>
            <th width="20%">Task</th>
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
                <td>
                  {{ $step->task->Task }}
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
