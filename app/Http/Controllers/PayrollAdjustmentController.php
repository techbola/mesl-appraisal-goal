<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PayrollAdjustmentGroup;

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
            $payroll_adjustment_group->save();
            return redirect()->route('payroll.group.new')->with('success', 'Payroll group was added successfully');
        } else {
            return back()->withInput()->withErrors($validator)->with('error', 'Payroll group failed to save');
        }
    }
}
