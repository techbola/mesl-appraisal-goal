@extends('layouts.master')

@section('title')
  New Score Card
@endsection

@section('content')

  <style>
    .dp input {
      border-radius: 0px !important;
    }
    .table tbody tr td{
      padding-right: 10px;
    }
  </style>

  <div class="card-box">
      <h3 class="card-title" style="width:100%">
        New Score Card
      </h3>

      <form class="" action="{{ route('save_scorecard', $staff->StaffRef) }}" method="post">
        {{ csrf_field() }}
        <table class="table table-bordered table-stripped">
          <thead>
            <tr>
              <th>KPI</th>
              <th>Target</th>
              {{-- <th>Achievement</th>
              <th>Comment</th> --}}
              <th>PeriodFrom</th>
              <th>PeriodTo</th>
              <th></th>
            </tr>
          </thead>

          <tbody id="tx_rows">
            <tr>
              {{-- KPI --}}
              <td>
                <input type="text" name="KPI[]" class="form-control input-sm" value="" required>
              </td>
              {{-- AMOUNT --}}
              <td>
                <input type="text" name="Target[]" class="form-control input-sm" value="" required>
              </td>

              {{-- ACHIEVEMENT --}}
              {{-- <td>
                <input type="text" name="Achievement[]" class="form-control input-sm" value="" required>
              </td> --}}
              {{-- COMMENT --}}
              {{-- <td>
                <input type="text" name="Comment[]" class="form-control input-sm" value="" required>
              </td> --}}

              {{-- PERIOD FROM --}}
              <td>
                <div class="input-group date dp">
                  <input type="text" name="PeriodFrom[]" class="form-control input-sm" value="" required>
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </td>
              {{-- PERIOD TO --}}
              <td>
                <div class="input-group date dp">
                  <input type="text" name="PeriodTo[]" class="form-control input-sm" value="" required>
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </td>

              <td>
                <i class="fa fa-times-circle text-danger f20 pointer delete"></i>
              </td>

            </tr>
          </tbody>
          {{-- <tfoot>
            <tr>
              <td id="balance_error" colspan="8" class="text-danger text-center"><i class="fa fa-times m-r-5"></i>Debit and Credit amounts must balance.</td>
              <td id="balance_ok" colspan="8" class="text-success text-center" style="display:none"><i class="fa fa-check m-r-5"></i>Debit and Credit amounts are balanced.</td>
            </tr>
          </tfoot> --}}

        </table>
        <div id="add_row" class="btn btn-info pull-left">+ Add Row</div>
        <div class="pull-right">
          <input id="submit_btn" type="submit" class="btn btn-success btn-cons m-l-10" value="Submit">
        </div>
        <div class="clearfix"></div>
      </form>

  </div>
@endsection

@push('scripts')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>


  <script>
  $(document).ready(function () {
    // DATE PICKER
    var options = {
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        autoclose: true,
    };
     $('.dp').datepicker(options);

     // Memorize this row
     var clone1 = $('#tx_rows tr').last().clone();

    // Add Row
    $("#add_row").click(function (e) {
      var clone = clone1.clone(); // clone of a clone.
      clone.find('input').val('');
      $('#tx_rows')
      .append(clone);

      // .append(
      //   `
      //
      //   `
      // );

      clone.find('.dp').addClass('new_date');

      $('.new_select').select2();
      $('.new_date').datepicker(options);

      $('.new_select').removeClass('new_select');
      $('.new_date').removeClass('new_date');

    });
    // Delete
    $("body").on("click", ".delete", function (e) {
      $(this).closest("tr").remove();
    });

  });
</script>
@endpush
