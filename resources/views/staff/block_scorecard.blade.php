{{-- <a href="{{ route('create_scorecard', $staff->StaffRef) }}" class="btn btn-sm btn-info pull-right"><i class="fa fa-plus"></i> Create ScoreCard</a> --}}



<table class="table table-bordered table-stripped tableWithSearch">
  <thead>
    <tr>
      <th>KPI</th>
      <th>Target</th>
      <th>Achievement</th>
      <th>Comment</th>
      <th>PeriodFrom</th>
      <th>PeriodTo</th>
      {{-- <th>Actions</th> --}}
    </tr>
  </thead>

  <tbody id="tx_rows">
    @foreach ($staff->scorecards as $score)
      <tr>
        {{-- KPI --}}
        <td>
          {{ $score->KPI }}
        </td>
        {{-- AMOUNT --}}
        <td>
          {{ $score->Target }}
        </td>
        {{-- ACHIEVEMENT --}}
        <td>
          {{ $score->Achievement }}
        </td>
        {{-- COMMENT --}}
        <td>
          {{ $score->Comment }}
        </td>
        {{-- PERIOD FROM --}}
        <td>
          {{ $score->PeiodFrom }}
        </td>
        {{-- PERIOD TO --}}
        <td>
          {{ $score->PeriodTo }}
        </td>

        {{-- <td>
          <i class="fa fa-times-circle text-danger f20 pointer delete"></i>
        </td> --}}

      </tr>
    @endforeach
  </tbody>
  {{-- <tfoot>
    <tr>
      <td id="balance_error" colspan="8" class="text-danger text-center"><i class="fa fa-times m-r-5"></i>Debit and Credit amounts must balance.</td>
      <td id="balance_ok" colspan="8" class="text-success text-center" style="display:none"><i class="fa fa-check m-r-5"></i>Debit and Credit amounts are balanced.</td>
    </tr>
  </tfoot> --}}

</table>
