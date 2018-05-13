<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PayrollMonthly;
use App\PayrollLevel;
use App\Deduction;
use App\Month;

class PayrollController extends Controller
{
    public function details()
    {
        // returns pen-ultimate/current payroll details
        $logged_in_user = auth()->user();
        // show last month's payroll details
        $max_month       = PayrollMonthly::max('PayMonth');
        $payroll_details = PayrollMonthly::where('PayMonth', $max_month)
            ->where('GroupID', '<>', null)
            ->get();
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

    // deductions
    public function view_deductions()
    {
        $deductions = Deduction::all();
        return view('payroll.deductions.index', compact('deductions'));
    }

    // process payroll
    public function process_payroll(Request $request)
    {
        try {
            $procedures = \DB::statement("
                EXEC procUpdateAllIndividualColumns
                EXEC procUpdatePayrollMonthly
                EXEC procProratePayrollMonthly
            ");
            return response()->json('Payroll updated successfully. <a href="' . route('payroll.details') . '"><b>View Payroll Summary</b></a>', 200);
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update payroll');
        }
    }
}
