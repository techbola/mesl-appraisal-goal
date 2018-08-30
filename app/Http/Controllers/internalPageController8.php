<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;

class internalPageController8 extends Controller
{
    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function index()
    {
        // body..
        return view('ars8.welcome');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function upload_data()
    {
        // body..
        return view('ars8.data_upload');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function showBank()
    {
        // body..
        return view('ars8.bank');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function showLedger()
    {
        // body..
        return view('ars8.ledger');
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
      $rows = collect(\DB::select("exec procReconStatement8"));
      $details = \DB::table('tblReconSetup8')->first();
      // dd($rows);
      return view('ars8.recon_statement', compact('rows', 'from', 'to', 'details'));
    }
}
