<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PayrollMonthly;

class PayrollController extends Controller
{
    public function details()
    {
        // returns pen-ultimate/current payroll details
        $payroll_details = PayrollMonthly::all();
    }
}
