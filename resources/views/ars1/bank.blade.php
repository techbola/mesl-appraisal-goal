@extends('layouts.master')

{{-- title section --}}
@section('title')
    Officemate | ARS
@endsection

{{-- body section --}}
@section('content')
    <li class="nav-item"><a href="/bank1" class="btn btn-link">Add Bank Item</a></li>
    <li class="nav-item"><a href="/ledger1" class="btn btn-link">Add Ledger Item</a></li>
    <li class="nav-item"><a href="{{ route('ars_recon1')}}" class="btn btn-link">Reconciliation View</a></li>
    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100 ver1 m-b-110">
                    <table data-vertable="ver1" class="table">
                        <thead>
                            <tr class="row100 head">
                                <th class="column100 column2" data-column="column2"></th>
                                <th class="column100 column1" data-column="column1"></th>
                                <th class="column100 column3" data-column="column3">BANK</th>
                                <th class="column100 column4" data-column="column4"></th>
                                <th class="column100 column5" data-column="column5"></th>

                            </tr>
                            <tr class="row100 head">
                                <th class="column100 column2" data-column="column2">Date</th>
                                <th class="column100 column1" data-column="column1">Details</th>
                                <th class="column100 column3" data-column="column3">DR</th>
                                <th class="column100 column4" data-column="column4">CR</th>
                                <th class="column100 column5" data-column="column5"></th>

                            </tr>
                        </thead>
                        <tbody class="load-bank-item">
                            <tr>
                                <td>
                                    <input type="date" id="date" class="om-input" >
                                </td>
                                <td>
                                    <input type="text" id="details" class="om-input" placeholder="Input item eg: TBills (TradeFi Portfoilio)">
                                </td>

                                <td><input type="text" id="debit" class="om-input" placeholder="eg: &#8358;1000"></td>
                                <td><input type="text" id="credit" class="om-input" placeholder="eg: &#8358;1000"></td>
                                <td>
                                    <a href="javascript:void(0);" onclick="addBankItem()" class="om-link">
                                      <i class="fa fa-edit"></i> add
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <br />
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="error_msg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script>
        function addBankItem() {
            // body...
            var details = $("#details").val();
            var debit   = $("#debit").val();
            var credit  = $("#credit").val();
            var date    = $("#date").val();
            var token   = '{{ csrf_token() }}';

            // req body
            var data = {
                _token:token,
                details:details,
                debit:debit,
                credit:credit,
                date:date,
                token:token
            };

            // post data
            $.post('/bank1', data, function(data, textStatus, xhr) {
                /*optional stuff to do after success */
                console.log(data);
                if(data.status == 'success'){
                    refreshDiv();
                }

                if(data.status == 'error'){
                    $(".error_msg").html(`
                        <span class="text-danger">
                            `+data.message+`
                        </span>
                    `);
                }
            });
        }

        //load item
        $.get('/load/bank1', function(data) {
            // console.log(data);
            $(".load-bank-item").html();
            var sn = 0;
            $.each(data, function(index, val) {
                // console.log(val);
                sn++;
                $(".load-bank-item").prepend(`
                    <tr>
                        <td>
                            <input type="date" id="date_`+val.id+`" class="om-input" value="`+val.date+`">
                        </td>
                        <td>
                            <input type="text" id="details_`+val.id+`" class="om-input" value="`+val.details+`">
                        </td>

                        <td><input type="text" id="debit_`+val.id+`" class="om-input" value="&#8358;`+val.debit+`"></td>
                        <td><input type="text" id="credit_`+val.id+`" class="om-input" value="&#8358;`+val.credit+`"></td>
                        <td>
                            <a href="javascript:void(0);" onclick="deleteBankItem('`+val.id+`')" class="om-link">
                               <i class="fa fa-trash"></i> delete
                            </a>
                        </td>
                    </tr>
                `);
            });
        });

        //refresh div
        function refreshDiv() {
            // body...
            // load item
            $.get('/load/bank1', function(data) {
                // console.log(data);
                $(".load-bank-item").html("");
                var sn = 0;
                $.each(data, function(index, val) {
                    // console.log(val);
                    sn++;
                    $(".load-bank-item").prepend(`
                        <tr>
                            <td>
                                <input type="date" id="date_`+val.id+`" class="om-input" value="`+val.date+`">
                            </td>
                            <td>
                                <input type="text" id="details_`+val.id+`" class="om-input" value="`+val.details+`">
                            </td>

                            <td><input type="text" id="debit_`+val.id+`" class="om-input" value="&#8358;`+val.debit+`"></td>
                            <td><input type="text" id="credit_`+val.id+`" class="om-input" value="&#8358;`+val.credit+`"></td>
                            <td>
                                <a href="javascript:void(0);" onclick="deleteBankItem('`+val.id+`')" class="om-link">
                                   <i class="fa fa-trash"></i> delete
                                </a>
                            </td>
                        </tr>
                    `);
                });

                $(".load-bank-item").append(`
                    <tr>
                        <td>
                            <input type="date" id="date" class="om-input" >
                        </td>
                        <td>
                            <input type="text" id="details" class="om-input" placeholder="Input item eg: TBills (TradeFi Portfoilio)">
                        </td>

                        <td><input type="text" id="debit" class="om-input" placeholder="eg: &#8358;1000"></td>
                        <td><input type="text" id="credit" class="om-input" placeholder="eg: &#8358;1000"></td>
                        <td>
                            <a href="javascript:void(0);" onclick="addBankItem()" class="om-link">
                              <i class="fa fa-edit"></i> add
                            </a>
                        </td>
                    </tr>
                `);
            });
        }
</script>

@endsection
