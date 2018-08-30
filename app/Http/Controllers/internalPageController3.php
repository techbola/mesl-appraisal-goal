<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;

class internalPageController3 extends Controller
{
    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function index()
    {
        // body..
        return view('ars3.welcome');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function upload_data()
    {
        // body..
        return view('ars3.data_upload');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function showBank()
    {
        // body..
        return view('ars3.bank');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function showLedger()
    {
        // body..
        return view('ars3.ledger');
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
      $rows = collect(\DB::select("exec procReconStatement3"));
      $details = \DB::table('tblReconSetup3')->first();
      // dd($rows);
      return view('ars3.recon_statement', compact('rows', 'from', 'to', 'details'));
    }
}
