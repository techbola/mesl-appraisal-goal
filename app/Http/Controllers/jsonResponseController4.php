<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\ArsLedger4;
use Cavidel\ArsBank4;
use DB;

class jsonResponseController4 extends Controller
{
    /*
    |-----------------------------------
    | Add Ledger Item
    |-----------------------------------
     */
    public function addLedgerItem(Request $request)
    {
        // body..
        $details = $request->details;
        $debit   = $request->debit;
        $credit  = $request->credit;
        $status  = 'pending';
        $balance = $request->balance;
        $owner   = $request->owner;
        $date    = $request->date;

        // validate details and debits
        $validate = $this->validateInputs($details, $date, $debit, $credit);
        if ($validate['status'] == 'error') {
            // return response
            return response($validate, $validate['code'], $headers = [
                'Content-type' => 'application/json',
            ]);
        }

        $bank     = new ArsLedger4();
        $response = $bank->saveLedgerItem($details, $debit, $credit, $date, $status);

        // return response
        return response($response, $response['code'], $headers = [
            'Content-type' => 'application/json',
        ]);
    }

    /*
    |-----------------------------------
    | Load Ledger Item
    |-----------------------------------
     */
    public function loadLedgerItem(Request $request)
    {
        // body..
        $bank     = new ArsLedger4();
        $response = $bank->loadLedgerItem();

        // return response
        return response($response, 200, $headers = [
            'Content-type' => 'application/json',
        ]);
    }

    /*
    |--------------------------------
    | Load stored proc for Recon
    |--------------------------------
    |
     */
    public function loadStoredRecon()
    {

        $recon_total = DB::select("
            EXEC procReconTotal4
        ");

        // collect results
        $scan_total    = collect($recon_total);
        $formatted_box = [];
        foreach ($scan_total as $total) {
            # code...
            $data = [
                'Total' => number_format($total->Total, 2),
            ];

            array_push($formatted_box, $data);
        }

        // return response
        return response()->json($formatted_box);
    }

    /*
    |-----------------------------------
    | Add Bank Item
    |-----------------------------------
     */
    public function addBankItem(Request $request)
    {
        // body..
        $details = $request->details;
        $debit   = $request->debit;
        $credit  = $request->credit;
        $status  = 'pending';
        $balance = $request->balance;
        $owner   = $request->owner;
        $date    = $request->date;

        // validate details and debits
        $validate = $this->validateInputs($details, $date, $debit, $credit);
        if ($validate['status'] == 'error') {
            // return response
            return response($validate, $validate['code'], $headers = [
                'Content-type' => 'application/json',
            ]);
        }

        $bank     = new ArsBank4();
        $response = $bank->saveBankItem($details, $debit, $credit, $date, $status);

        // return response
        return response($response, $response['code'], $headers = [
            'Content-type' => 'application/json',
        ]);
    }

    /*
    |-----------------------------------
    | Load Bank Item
    |-----------------------------------
     */
    public function loadBankItem(Request $request)
    {
        // body..
        $bank     = new ArsBank4();
        $response = $bank->loadBankItem();

        // return response
        return response($response, 200, $headers = [
            'Content-type' => 'application/json',
        ]);
    }

    /*
    |--------------------------------
    | Load all Items
    |--------------------------------
    |
     */
    public function loadAllItems(Request $request)
    {
        // fetch all transaction

        // load from bank table section
        $all_bank_items = DB::table('ars_banks4')->where('match_flag', 0)->orderBy('date', 'ASC')->get();
        if (count($all_bank_items) > 0) {
            $bank_box = [];
            foreach ($all_bank_items as $bank_item) {
                // sort items by date
                $data_bank = [
                    'id'      => $bank_item->id,
                    'owner'   => $bank_item->owner,
                    'details' => $bank_item->details,
                    'balance' => $bank_item->balance,
                    'credit'  => number_format($bank_item->credit, 2),
                    'debit'   => number_format($bank_item->debit, 2),
                    'amount'  => $bank_item->amount,
                    'status'  => $bank_item->status,
                    'date'    => $bank_item->date,
                    // 'last_seen' => $bank_item->created_at->diffForHumans(),
                ];
                // $data = [];
                // push data
                array_push($bank_box, $data_bank);
            }
        } else {
            $bank_box = [];
        }

        // load from ledger table section
        $all_ledger_items = DB::table('ars_ledgers4')->where('match_flag', 0)->orderBy('date', 'ASC')->get();
        if (count($all_ledger_items) > 0) {
            $ledger_box = [];
            foreach ($all_ledger_items as $ledger_item) {
                // // compare date
                $data_ledger = [
                    'id'      => $ledger_item->id,
                    'owner'   => $ledger_item->owner,
                    'details' => $ledger_item->details,
                    'balance' => $ledger_item->balance,
                    'credit'  => number_format($ledger_item->credit, 2),
                    'debit'   => number_format($ledger_item->debit, 2),
                    'amount'  => $ledger_item->amount,
                    'status'  => $ledger_item->status,
                    'date'    => $ledger_item->date,
                    // 'last_seen' => $ledger_item->created_at->diffForHumans(),
                ];
                // $data = [];
                // push data
                array_push($ledger_box, $data_ledger);
            }
        } else {
            $ledger_box = [];
        }

        $data = [
            'bank'   => $bank_box,
            'ledger' => $ledger_box,
        ];

        // return response
        return response($data, $status = 200, $headers = [
            'Content-type' => 'Application/json',
        ]);
    }

    /*
    |--------------------------------
    | Flag Items
    |--------------------------------
    |
     */
    public function flagItem(Request $request)
    {
        $item_type = $request->itemtype;
        $item_id   = $request->itemid;
        $flag      = 1;

        // check type and update record
        if ($item_type == 'bank') {
            // update bank
            $bank = ArsBank4::where('id', $item_id)->first();
            if ($bank !== null) {

                // check if already click
                if ($bank->recon_flag !== $flag) {
                    $recon_flag = 1;
                } else {
                    $recon_flag = 0;
                }

                // find and update item
                $update_bank             = ArsBank4::find($bank->id);
                $update_bank->recon_flag = 1;
                $update_bank->update();

                // response
                $data = [
                    'status'  => 'success',
                    'message' => 'bank table updated !',
                ];
            }
        } elseif ($item_type == 'ledger') {
            // check type for ledger and update
            $ledger = ArsLedger4::where('id', $item_id)->first();
            if ($ledger !== null) {

                // check if already click
                if ($ledger->recon_flag !== $flag) {
                    $recon_flag = 1;
                } else {
                    $recon_flag = 0;
                }
                // find and update item
                $update_ledger             = ArsLedger4::find($ledger->id);
                $update_ledger->recon_flag = $recon_flag;
                $update_ledger->status     = 'recon_flag';
                $update_ledger->update();

                // response
                $data = [
                    'status'  => 'success',
                    'message' => 'ledger table updated !',
                ];
            }
        } else {
            $data = [
                'status'  => 'error',
                'message' => 'could not find item type or id',
            ];
        }

        // return response
        return response()->json($data);
    }

    /*
    |--------------------------------
    | checked items for ledger
    |--------------------------------
    |
     */
    public function checkedLedgerItem(Request $request)
    {

        $item_type  = $request->itemtype;
        $item_id    = $request->itemid;
        $recon_flag = 1;

        // check type for ledger and update
        $ledger = ArsLedger4::where('id', $item_id)->first();
        if ($ledger !== null) {

            // find and update item
            $update_ledger             = ArsLedger4::find($ledger->id);
            $update_ledger->recon_flag = $recon_flag;
            $update_ledger->status     = 'recon_flag';
            $update_ledger->update();

            // response
            $data = [
                'status'  => 'success',
                'message' => 'ledger table updated !',
            ];
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    /*
    |--------------------------------
    | unchecked items for ledger
    |--------------------------------
    |
     */
    public function uncheckedLedgerItem(Request $request)
    {
        $item_type  = $request->itemtype;
        $item_id    = $request->itemid;
        $recon_flag = 0;

        // check type for ledger and update
        $ledger = ArsLedger4::where('id', $item_id)->first();
        if ($ledger !== null) {

            // find and update item
            $update_ledger             = ArsLedger4::find($ledger->id);
            $update_ledger->recon_flag = $recon_flag;
            $update_ledger->status     = 'recon_flag';
            $update_ledger->update();

            // response
            $data = [
                'status'  => 'success',
                'message' => 'ledger table updated !',
            ];
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    /*
    |--------------------------------
    | checked items for ledger
    |--------------------------------
    |
     */
    public function checkedBankItem(Request $request)
    {

        $item_type  = $request->itemtype;
        $item_id    = $request->itemid;
        $recon_flag = 1;

        // check type for ledger and update
        $bank = ArsBank4::where('id', $item_id)->first();
        if ($bank !== null) {

            // find and update item
            $update_bank             = ArsBank4::find($bank->id);
            $update_bank->recon_flag = $recon_flag;
            $update_bank->status     = 'recon_flag';
            $update_bank->update();

            // response
            $data = [
                'status'  => 'success',
                'message' => 'Bank table updated !',
            ];
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    /*
    |--------------------------------
    | unchecked items for ledger
    |--------------------------------
    |
     */
    public function uncheckedBankItem(Request $request)
    {
        $item_type  = $request->itemtype;
        $item_id    = $request->itemid;
        $recon_flag = 0;

        // check type for bank and update
        $bank = ArsBank4::where('id', $item_id)->first();
        if ($bank !== null) {

            // find and update item
            $update_bank             = ArsBank4::find($bank->id);
            $update_bank->recon_flag = $recon_flag;
            $update_bank->status     = 'recon_flag';
            $update_bank->update();

            // response
            $data = [
                'status'  => 'success',
                'message' => 'Bank table updated !',
            ];
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    /*
    |--------------------------------
    | validate all items
    |--------------------------------
    |
     */
    public function validateInputs($details, $date, $debit, $credit)
    {
        if ($details == null) {
            return [
                'status'  => 'error',
                'code'    => 200,
                'message' => 'describe item details',
            ];
        }

        if ($date == null) {
            return [
                'status'  => 'error',
                'code'    => 200,
                'message' => 'specify item date',
            ];
        }
    }

    /*
    |--------------------------------
    | Get select menu for bank
    |--------------------------------
    |
     */
    public function loadBankSelectMenu()
    {
        $bank_list = DB::table("tblBank")->get();

        // return $bank_list;
        $bank_list_box = [];
        foreach ($bank_list as $list) {
            # code...
            $data = [
                'bank_name' => $list->BankName,
            ];

            array_push($bank_list_box, $data);
        }

        return response()->json($bank_list_box);
    }

    /*
    |--------------------------------
    | Get select menu for location
    |--------------------------------
    |
     */
    public function loadBranchSelectMenu()
    {
        $location_list     = DB::table("tblBankLocation")->get();
        $location_list_box = [];
        foreach ($location_list as $list) {
            # code...
            $data = [
                'location_name' => $list->BankLocationCode,
            ];

            array_push($location_list_box, $data);
        }

        return response()->json($location_list_box);
    }

    /*
    |--------------------------------
    | Get select menu for Ledger select
    |--------------------------------
    |
     */
    public function loadLedgerSelectMenu()
    {
        $load_ledger_list = DB::select('
            EXEC procLedger
        ');

        // return collect($load_ledger_list);

        $load_ledger_list = collect($load_ledger_list);
        if (count($load_ledger_list) > 0) {
            $load_ledger_list_box = [];
            foreach ($load_ledger_list as $list) {
                # code...
                $data = [
                    'ledger_ref_id'      => $list->GLRef,
                    'ledger_description' => $list->Description,
                ];

                array_push($load_ledger_list_box, $data);
            }
        } else {
            $load_ledger_list_box = [];
        }

        return response()->json($load_ledger_list_box);
    }

    /*
    |--------------------------------
    | save data for ARS sorting
    |--------------------------------
    |
     */
    public function saveDataForSorting(Request $request)
    {

      $bank      = $request->bank;
      $location  = $request->location;
      $ledger    = $request->ledger;
      $startDate = $request->startDate;
      $endDate   = $request->endDate;
      $opening = $request->BankOpeningBalance;
      $closing = $request->BankClosingBalance;

      // return $request->all();
      // listen for already inserted data
      $check_data = DB::table('tblReconSetup4')->get();
      if (count($check_data) > 0) {
          $proccess_update = DB::table('tblReconSetup4')->update([
              'BankName'   => $bank,
              'Location'   => $location,
              'LedgerName' => $ledger,
              'StartDate'  => $startDate,
              'EndDate'    => $endDate,
              'BankOpeningBalance' => $opening,
              'BankClosingBalance' => $closing,
          ]);
      } else {
          $proccess_update = DB::table('tblReconSetup4')->insert([
              'BankName'   => $bank,
              'Location'   => $location,
              'LedgerName' => $ledger,
              'StartDate'  => $startDate,
              'EndDate'    => $endDate,
              'BankOpeningBalance' => $opening,
              'BankClosingBalance' => $closing,
          ]);
      }

        if ($proccess_update == true) {
            $data = [
                'status'  => 'success',
                'message' => 'updated successul !',
            ];
        } else {
            $data = [
                'status'  => 'error',
                'message' => 'updated not successul !',
            ];
        }

        return response()->json($data);
    }
}
