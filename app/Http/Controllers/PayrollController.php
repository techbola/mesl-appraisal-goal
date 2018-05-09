<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PayrollMonthly;
use App\PayrollLevel;
use App\Month;

class PayrollController extends Controller
{
    public function details()
    {
        // returns pen-ultimate/current payroll details
        $logged_in_user  = auth()->user();
        $payroll_details = $logged_in_user->payroll_details();
        // months
        $months = Month::select('Months', 'MonthsRef');
        return view('payroll.details', compact('payroll_details', 'months'));
    }

    public function new_group()
    {
        $payroll_level = PayrollLevel::select('Scenario', 'ScenarioRef')->get();
        return view('payroll.group.new', compact('payroll_level'));
    }

    public function apply_updates(Request $request)
    {
        try {
            $procedures = \DB::statement("
                EXEC procInsertNewEmployee2Payroll
                EXEC procUpdateAllIndividualColumns
            ");
            return response()->json('Updates applied successfully', 200);
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to apply updates');
        }
    }

    public function view_percentages()
    {
        $pp = PayrollLevel::select('*')->get();
        return view('payroll.percentages.index', compact('pp'));
    }

    public function edit_percentage($id)
    {
        $pp = PayrollLevel::find($id);
        return view('payroll.percentages.edit', compact('pp'));
    }

    public function setup_percentages(Request $request)
    {
        $pp        = new PayrollLevel($request->all());
        $validator = \Validator::make($request->all(), [
            'Scenario' => 'required',
        ], [

        ]);
        if (!$validator->fails()) {
            $pp->save();
            return redirect()->route('payroll.setup_percentage')->with('success', 'Payroll percentage were set successfully');
        } else {
            return back()->withInput()->withErrors($validator)->with('error', 'Payroll percentage failed to save');
        }
    }

    public function update_percentage(Request $request, $id)
    {
        $pp        = PayrollLevel::find($id);
        $validator = \Validator::make($request->all(), [
            'Scenario' => 'required',
        ], [

        ]);
        if (!$validator->fails()) {
            $pp->update($request->all());
            return redirect()->route('payroll.setup_percentage')->with('success', 'Payroll percentage was updated successfully');
        } else {
            return back()->withInput()->withErrors($validator)->with('error', 'Payroll percentage failed to update');
        }
    }
}
