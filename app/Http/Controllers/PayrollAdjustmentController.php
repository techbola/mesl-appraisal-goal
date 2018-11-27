<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\PayrollAdjustmentGroup;

class PayrollAdjustmentController extends Controller
{
    public function store(Request $request)
    {
        $payroll_adjustment_group = new PayrollAdjustmentGroup($request->all());
        $validator                = \Validator::make($request->all(), [
            'Scenario' => 'required',
        ], [
            'Scenario.required' => 'Choose a payroll level',
        ]);
        if (!$validator->fails()) {
            // dd($request->all());
            $payroll_adjustment_group->save();
            return redirect()->route('payroll.groups.new')->with('success', 'Payroll group was added successfully');
        } else {
            return back()->withInput()->withErrors($validator)->with('error', 'Payroll group failed to save');
        }
    }
}
