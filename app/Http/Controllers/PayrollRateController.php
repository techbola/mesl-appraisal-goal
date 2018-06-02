<?php

namespace Cavidel\Http\Controllers;

use Cavidel\PayrollRate;
use Illuminate\Http\Request;

class PayrollRateController extends Controller
{
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'MonthStartDate' => 'required',
            'MonthEndDate'   => 'required',
        ], [
            'MonthStartDate.required' => 'Choose a Start Date',
            'MonthEndDate.required'   => 'Choose a End Date',
        ]);
        $payroll_period = PayrollRate::first();
        $payroll_period->update($request->all());
        return redirect()->route('payroll.details')->with('success', 'Payroll Period is now set as <b>' . \Carbon\Carbon::parse($request->MonthStartDate)->toFormattedDateString() . '</b> to <b>' . \Carbon\Carbon::parse($request->MonthEndDate)->toFormattedDateString() . '</b>');
    }
}
