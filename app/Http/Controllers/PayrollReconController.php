<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\PayrollRecon;

class PayrollReconController extends Controller
{
    public function index()
    {
        $procedure = \DB::statement('EXEC procUpdatePayrollRecon');
        $recons    = PayrollRecon::all();
        // dd($recons);
        return view('payroll.reports.recon', compact('recons'));
    }
}
