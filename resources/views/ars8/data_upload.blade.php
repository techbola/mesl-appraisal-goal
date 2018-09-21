
@extends('layouts.master')

{{-- title section --}}
@section('title')
    Officemate | ARS
@endsection

{{-- body section --}}
@section('content')
    <form method="POST" onsubmit="return pullBankDataToArs()">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Select Bank</label>
                    <select class="form-control" id="select_bank" onchange="get_balances()" required></select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Select Branch</label>
                    <select class="form-control" id="select_location" required></select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Select Ledger</label>
                    <select class="form-control" id="select_ledger" required></select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Start Date:</label>
                    <input type="date" class="form-control" id="start_date" onchange="get_balances()" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>End Date:</label>
                    <input type="date" class="form-control" id="end_date" onchange="get_balances()" required>
                </div>
            </div>
            <div class="col-md-2">
                <label>Upload Data</label>
                <div class="form-group">
                    <button class="btn btn-primary col-md-12">
                        Upload Data
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-2">
              <div class="form-group">
                <label>Bank Opening Balance</label>
                <input type="number" class="form-control" id="BankOpeningBalance" value="" placeholder="Bank Opening Balance" pattern="[0-9]*" required step="0.01">
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <label>Bank Closing Balance</label>
                <input type="number" class="form-control" id="BankClosingBalance" value="" placeholder="Bank Closing Balance" pattern="[0-9]*" required step="0.01">
              </div>
          </div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="success_msg"></div>
            <div class="error_msg"></div>
        </div>
    </div>
@endsection

@push('scripts')

  <script>
    function get_balances() {
      if ($("#start_date").val() && $("#end_date").val() && $("#select_bank").val()) {
        $('#spinner').show();

        $.post('/recon/get_bank_balances8', { start: $("#start_date").val(), end: $("#end_date").val(), bank: $("#select_bank").val() }, function(data, status){
          $('#BankOpeningBalance').val(data[0]);
          $('#BankClosingBalance').val(data[1]);
          $('#spinner').hide();
        });
      }
    }
  </script>


    <script type="text/javascript">
        // fetch and pull data to ARS Ledger
        function pullBankDataToArs(argument) {
            // body...
            var token           = '{{ csrf_token() }}';
            var bank      = $("#select_bank").val();
            var location  = $("#select_location").val();
            var ledger    = $("#select_ledger").val();
            var startDate       = $("#start_date").val();
            var endDate         = $("#end_date").val();
            var BankOpeningBalance = $("#BankOpeningBalance").val();
            var BankClosingBalance = $("#BankClosingBalance").val();

            var data = {
                _token:token,
                bank:bank,
                location:location,
                ledger:ledger,
                startDate:startDate,
                endDate:endDate,
                BankOpeningBalance: BankOpeningBalance,
                BankClosingBalance: BankClosingBalance
            };

            // post data
            $.post('/save/data/recon/table8', data, function(data, textStatus, xhr) {
                /*optional stuff to do after success */
                console.log(data);
                if(data.status == 'success'){
                    $(".success_msg").html(`
                        <div class="alert alert-success">`+data.message+`</div>
                    `);
                    window.location.href = "/entry/ars8";
                }

                if(data.status == 'error'){
                    $(".error_msg").html(`
                       <div class="alert alert-danger"> `+data.message+`</div>
                    `);
                }
            });

            // load data
            return false;
        }

        // get bank name
        $.get('/load/bank/name8', function(data) {
            console.log(data);
            $("#select_bank").html("");
            $("#select_bank").append(`
                <option value="">--select bank--</option>
            `);
            $.each(data, function(index, val) {
                // add to select

                $("#select_bank").append(`
                    <option value="`+val.bank_name+`">`+val.bank_name+`</option>
                `);
            });
        });

        // get branch location name
        $.get('/load/location/name8', function(data) {
            /*optional stuff to do after success */
            $("#select_location").html("");
            $("#select_location").append(`
                <option value="">--select location--</option>
            `);
            $.each(data, function(index, val) {
                // add to select
                $("#select_location").append(`
                    <option value="`+val.location_name+`">`+val.location_name+`</option>
                `);
            });
        });

        // get ledger data from SP.
        $.get('/load/ledger/name8', function(data) {
            /*optional stuff to do after success */
            $("#select_ledger").html("");
            $("#select_ledger").append(`
                <option value="">--select ledger--</option>
            `);
            $.each(data, function(index, val) {
                // add to select
                $("#select_ledger").append(`
                    <option value="`+val.ledger_ref_id+`"> `+val.ledger_description+` </option>
                `);
            });
            // console.log(data);
        });
    </script>
@endpush
