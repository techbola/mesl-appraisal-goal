<?php

namespace Cavi\Http\Controllers;

use Illuminate\Http\Request;
use Cavi\PayrollRecon;

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
