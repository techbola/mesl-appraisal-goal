<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\BankTransaction;
use MESL\Transaction;

class internalPageController9 extends Controller
{
    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function index()
    {
        // body..
        return view('ars9.welcome');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function upload_data()
    {
        // body..
        return view('ars9.data_upload');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function showBank()
    {
        // body..
        return view('ars9.bank');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function showLedger()
    {
        // body..
        return view('ars9.ledger');
    }

    public function recon_statement()
    {
      if (empty($_GET['from']) && empty($_GET['to'])) {
        $from = date('Y-m-d', strtotime("3 months ago"));
        $to = date('Y-m-d');
      } else {
        $from = $_GET['from'];
        $to = $_GET['to'];
      }
      // $rows = collect(DB::select("exec procReconStatement '$from', '$to'"));
      $rows = collect(\DB::select("exec procReconStatement9"));
      $details = \DB::table('tblReconSetup9')->first();

      $open_bal = Transaction::where('GLID', $details->LedgerName)->whereBetween('ValueDate', [$details->StartDate, $details->EndDate])->where(function($q){
        $q->where('Narration', 'LIKE', '%openg%')->orwhere('Narration', 'LIKE', '%opening%');
      })->first();
      // dd($rows);
      return view('ars9.recon_statement', compact('rows', 'from', 'to', 'details', 'open_bal'));
    }

    public function get_bank_balances(Request $request)
    {
      $start_bal = BankTransaction::where('Bank', $request->bank)->whereBetween('ValueDate', [$request->start, $request->end])->orderBy('ValueDate')->first();
      $end_bal = BankTransaction::where('Bank', $request->bank)->whereBetween('ValueDate', [$request->start, $request->end])->orderBy('ValueDate', 'desc')->orderBy('BankTransactionRef', 'desc')->first();
      return [$start_bal->Balance, $end_bal->Balance];
      // return $start_bal->Balance;
    }
}
