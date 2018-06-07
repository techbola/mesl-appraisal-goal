@extends('layouts.master')

@section('page-title')
  New Score Card
@endsection

@section('title')
  New Score Card
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Create Score Card</div>

    <form class="" action="" method="post">

    </form>

  </div>
@endsection


@push('scripts')
  <script>
    // Add Row
    $("#add_row").click(function (e) {
      // var clone = $('#tx_rows tr').last().clone();
      // clone.find('input').val('');
      $('#tx_rows')
      // .append(clone);

      .append(
        `
        <tr>
          {{-- TYPE --}}
          <td>
            <select id="txtype" class="new_select form-control select2" data-init-plugin="select2" name="type[]" required onchange="calc()">
              <option value="">Select one</option>
              <option value="3">Debit</option>
              <option value="4">Credit</option>
            </select>
          </td>
          {{-- AMOUNT --}}
          <td>
            <input type="text" name="amount[]" class="form-control input-sm amount" value="" required  onkeyup="calc()">
          </td>
          {{-- ACCOUNT --}}
          <td>
            <select class="new_select form-control select2" data-init-plugin="select2" name="account[]" required>
              <option value="">Select one</option>
              @foreach ($accounts as $account)
                <option value="{{ $account->GLRef }}">{{ str_replace('`', '', $account->Account) }}</option>
              @endforeach
            </select>
          </td>
          {{-- POST DATE --}}
          <td>
            <div class="new_date input-group date dp">
              <input type="text" name="post_date[]" class="form-control input-sm" value="" required>
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </td>
          {{-- VALUE DATE --}}
          <td>
            <div class="new_date input-group date dp">
              <input type="text" name="value_date[]" class="form-control input-sm" value="" required>
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </td>
          {{-- STAFF --}}
          <td>
            <select class="new_select form-control select2" data-init-plugin="select2" name="staff[]">
              <option value="">Select staff</option>
              @foreach ($all_staff as $staff)
                <option value="{{ $staff->StaffRef }}">{{ $staff->StaffName ?? '-' }}</option>
              @endforeach
            </select>
          </td>
          {{-- BANK SLIP NO --}}
          <td>
            <input type="text" name="slip_no[]" class="form-control" value="">
          </td>
          {{-- NARRATION --}}
          <td>
            <input type="text" name="narration[]" class="form-control" value="">
          </td>
        </tr>
        `
      );

      $('.new_select').select2();
      $('.new_date').datepicker(options);

      $('.new_select').removeClass('new_select');
      $('.new_date').removeClass('new_date');

    });
    // Delete
    $("body").on("click", ".delete", function (e) {
      $(this).closest("tr").remove();
    });
  </script>
@endpush
