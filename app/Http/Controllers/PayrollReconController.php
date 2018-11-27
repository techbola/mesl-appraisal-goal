<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\PayrollRecon;

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
