<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;

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
}
