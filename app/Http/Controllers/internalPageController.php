<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;

class internalPageController extends Controller
{
    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function index()
    {
        // body..
        return view('ars.welcome');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function upload_data()
    {
        // body..
        return view('ars.data_upload');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function showBank()
    {
        // body..
        return view('ars.bank');
    }

    /*
    |-----------------------------------
    | Load bank view
    |-----------------------------------
     */
    public function showLedger()
    {
        // body..
        return view('ars.ledger');
    }
}
