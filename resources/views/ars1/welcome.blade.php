@extends('layouts.master')

{{-- title section --}}
@section('title')
    Officemate | ARS
@endsection

{{-- body section --}}
@section('content')


    <style type="text/css">
        .om-ledger {
            background-color: #797979;
            /*color:#FFFFFF;*/
        }

        .om-bank {
            background-color: #CCF;
            /*color:#FFFFFF;*/
        }

        #fixed-top {
            position: fixed;
            top: -5;
            /*right: 30;*/
            margin-left: 920px;
            z-index: 10;
            background-color: rgba(000,000,000,0.50);
            color:#fff;
            padding: 0.5em;
        }

        #fixed-top a {
            color:#fff;
        }

        #fixed-top button {
            color:#fff;
            background-color: #340495;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.css">
    <div class="container-fluid">
        <div class="row" id="fixed-top">
            <table class="small">
                <thead>
                    <tr>
                        <!-- <td><a href="/bank" class="btn btn-link">Add Bank Item</a></td>
                        <td><a href="/ledger" class="btn btn-link">Add Ledger Item</a></td> -->
                        <td></td>
                    </tr>
                </thead>
                <tbody class="match-results"></tbody>
            </table>
            <div class="error_div"></div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-6">
                <h5>Ledger</h5>
                <table class="table om-ledger small" id="ledger-table" data-pagination="true" data-search="true">
                    <thead>
                        {{-- Ledger table --}}
                        <th data-field="date" data-sortable="true">Date</th>
                        <th data-field="details" data-sortable="true">Details</th>
                        <th data-field="debit" data-sortable="true">DR</th>
                        <th data-field="credit" data-sortable="true" width="200">CR</th>
                        <th data-field="id"></th>
                    </thead>
                    <tbody class="load-ledger-item"></tbody>
                </table>
            </div>

            <div class="col-md-6">
                <h5>Bank</h5>

                <table class="table om-bank small" id="bank-table" data-pagination="true" data-search="true">
                    <thead>
                        {{-- Bank Table --}}
                        <tr class="om-table-row">
                            <th data-field="id"></th>
                            <th data-field="debit" data-sortable="true">DR</th>
                            <th data-field="credit" data-sortable="true" width="200">CR</th>
                            <th data-field="details" data-sortable="true">Details</th>
                            <th data-field="date" data-sortable="true">Date</th>
                        </tr>
                    </thead>
                    <tbody class="load-bank-item"></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.js"></script>
    <script type="text/javascript">

        $.get('/load/all1', function(data) {
            // console.log(data.ars);
            $(".load-ledger-item").html();
            $(".load-bank-item").html();
            // ledger section
            $.each(data.ledger, function(index, val) {
                // console.log(val);
                let verifyCheckbox;
                if(val.recon_flag == "1"){
                    verifyCheckbox = `checked="checked"`;
                }else{
                    verifyCheckbox = ``;
                }
                
                $(".load-ledger-item").append(`
                    <tr class="row100">
                        <td class="column100 column2" data-column="column2">`+val.date+`</td>
                        <td class="column100 column1" data-column="column1">
                            `+val.details+`
                        </td>
                        <td class="om-bank-dr">&#8358;`+val.debit+`</td>
                        <td class="om-bank-cr">&#8358;`+val.credit+`</td>
                        <td class="column100 column2" data-column="column2">
                            <label class="control control--checkbox">
                              <input type="checkbox" id="ledgercheckbox_`+val.id+`"
                                onclick="checkMatch('`+val.id+`', 'ledger', '`+val.amount+`')" ${verifyCheckbox}/>
                              <div class="control__indicator"></div>
                            </label>
                        </td>
                    </tr>
                `);
            });

            // bank section
            console.log(data.bank);
            $.each(data.bank, function(index, val) {
                // console.log(val);
                 let verifyCheckbox;
                if(val.recon_flag == "1"){
                    verifyCheckbox = `checked="checked"`;
                }else{
                    verifyCheckbox = ``;
                }

                $(".load-bank-item").append(`
                    <tr class="row100">
                        <td>
                            <input type="checkbox" id="bankcheckbox_`+val.id+`"
                              onclick="checkMatch('`+val.id+`', 'bank', '`+val.amount+`')" ${verifyCheckbox}/>
                        </td>
                        <td class="om-bank-dr">&#8358;`+val.debit+`</td>
                        <td class="om-bank-cr">&#8358;`+val.credit+`</td>

                        <td>
                            `+val.details+`
                        </td>
                        <td class="column100 column2" data-column="column2">`+val.date+`</td>
                    </tr>
                `);
            });

            $('#bank-table').bootstrapTable();
            $('#ledger-table').bootstrapTable();
        });

        function checkMatch(id, type, amount) {
            // body...
            var token       = '{{ csrf_token() }}';
            var ledgerCheck = $("#ledgercheckbox_"+id); //checkbox for ledger
            var bankCheck   = $("#bankcheckbox_"+id); //checkbox for bank

            var itemid      = id;
            var itemtype    = type;
            var checkAmount = amount;

            // data to json
            var data = {
                _token:token,
                itemid:itemid,
                itemtype:itemtype
            };

            if(type == 'ledger'){
                // check status
                if(ledgerCheck.is(':checked')){
                    // console.log(id+' ledger item has been check check');
                    // update ledger has been checked
                    $.post('/flag/ledger/checked1', data, function(data, textStatus, xhr) {
                        /*optional stuff to do after success */
                        refreshReconTotal();
                        console.log(data);
                    });

                }else if(ledgerCheck.not(':checked')){
                    // update ledger has been unchecked
                    $.post('/flag/ledger/unchecked1', data, function(data, textStatus, xhr) {
                        /*optional stuff to do after success */
                        refreshReconTotal();
                        console.log(data);
                    });
                }
            }


            if(type == 'bank'){
                if(bankCheck.is(':checked')){
                    // console.log(id+' bank item has been check check');
                    // update ledger has been checked
                    $.post('/flag/bank/checked1', data, function(data, textStatus, xhr) {
                        /*optional stuff to do after success */
                        refreshReconTotal();
                        console.log(data);
                    });
                }else if(ledgerCheck.not(':checked')){
                    // console.log(id+' bank item has been uncheck');
                     $.post('/flag/bank/unchecked1', data, function(data, textStatus, xhr) {
                        /*optional stuff to do after success */
                        refreshReconTotal();
                        console.log(data);
                    });
                }
            }
        }

        // refresh divs
        function refreshDivs() {
            // body...
            $.get('/load/all1', function(data) {
                // console.log(data.ars);
                $(".load-ledger-item").html();
                $(".load-bank-item").html();
                // ledger section
                $.each(data.ledger, function(index, val) {
                    // console.log(val);
                    $(".load-ledger-item").append(`
                        <tr class="row100">
                            <td class="column100 column2" data-column="column2">`+val.date+`</td>
                            <td class="column100 column1" data-column="column1">
                                `+val.details+`
                            </td>
                            <td class="om-bank-dr">&#8358;`+val.debit+`</td>
                            <td class="om-bank-cr">&#8358;`+val.credit+`</td>
                            <td class="column100 column2" data-column="column2">
                                <label class="control control--checkbox">
                                  <input type="checkbox" onclick="checkMatch('`+val.id+`', 'ledger')" />
                                  <div class="control__indicator"></div>
                                </label>
                            </td>
                        </tr>
                    `);
                });

                // bank section
                $.each(data.bank, function(index, val) {
                    // console.log(val);
                    $(".load-bank-item").append(`
                        <tr class="row100">
                            <td class="column100 column2" data-column="column2">
                                <label class="control control--checkbox">
                                  <input type="checkbox" onclick="checkMatch('`+val.id+`', 'bank')" />
                                  <div class="control__indicator"></div>
                                </label>
                            </td>
                            <td class="om-bank-dr">&#8358;`+val.debit+`</td>
                            <td class="om-bank-cr">&#8358;`+val.credit+`</td>

                            <td>
                                `+val.details+`
                            </td>
                            <td class="column100 column2" data-column="column2">`+val.date+`</td>
                        </tr>
                    `);
                });

                $('#bank-table').bootstrapTable();
                $('#ledger-table').bootstrapTable();
            });
        }

        // refresh page
        function matchData() {

            $.get('/load/recon/total1', function(data) {
                // console.log(data);
                // $(".match-results").html("");
                // iterate
                $.each(data, function(index, val) {
                    if(val.Total == 0){
                        // body...
                        <?php
                            DB::statement("exec procReconMatching1");
                        ?>
                        window.location.reload();

                    }else{

                        $(".error_div").html(`
                            <div class="alert alert-danger">
                                <span class="text-danger">
                                    Entries don't match, try again !
                                </span>
                            </div>
                        `);

                        setTimeout(function(){
                            $(".error_div").toggle();
                        }, 5000);

                        return false;
                    }
                });
            });
        }

        // get json for recon total
        $.get('/load/recon/total1', function(data) {
            // console.log(data);
            $(".match-results").html("");
            // iterate
            $.each(data, function(index, val) {

                /* iterate through array or object */
                $(".match-results").html(`
                    <tr>
                        <td>Reconciled Total: `+val.Total+` <button class="btn btn-link" onclick="matchData()">Match</button></td>
                    </tr>
                `);
            });
        });

        // refresh reconcile
        function refreshReconTotal(argument) {
            // get json for recon total
            $.get('/load/recon/total1', function(data) {
                console.log(data);
                $(".match-results").html("");
                // iterate
                $.each(data, function(index, val) {
                    /* iterate through array or object */
                    $(".match-results").html(`
                        <tr>
                            <td>
                                Reconciled Total: `+val.Total+`
                                <button class="btn btn-primary" onclick="matchData()">Match</button>
                            </td>
                        </tr>
                    `);
                });
            });
        }
    </script>


@endpush
