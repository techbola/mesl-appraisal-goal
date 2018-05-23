<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;

use Cavidel\PayrollMonthly;
use Cavidel\PayrollAdjustmentGroup;
use Cavidel\PayrollLevel;
use Cavidel\SeniorityLevel;
use Cavidel\Deduction;
use Cavidel\DeductionItem;
use Cavidel\Month;
use Cavidel\Staff;

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

    public function groups()
    {
        $payroll_levels   = PayrollLevel::select('Scenario', 'ScenarioRef')->get();
        $payroll_groups   = PayrollAdjustmentGroup::all();
        $seniority_levels = SeniorityLevel::select('SeniorityLevel', 'GradeLevel', 'SeniorityRef');
        return view('payroll.groups.index', compact('payroll_levels', 'payroll_groups', 'seniority_levels'));
    }

    public function new_group()
    {
        $payroll_levels   = PayrollLevel::select('Scenario', 'ScenarioRef')->get();
        $seniority_levels = SeniorityLevel::select('SeniorityLevel', 'GradeLevel', 'SeniorityRef');
        return view('payroll.groups.new', compact('payroll_levels', 'seniority_levels'));
    }

    public function edit_group($id)
    {
        $pag              = PayrollAdjustmentGroup::find($id);
        $payroll_levels   = PayrollLevel::select('Scenario', 'ScenarioRef')->get();
        $seniority_levels = SeniorityLevel::select('SeniorityLevel', 'GradeLevel', 'SeniorityRef');

        return view('payroll.groups.edit', compact('pag', 'payroll_levels', 'seniority_levels'));
    }

    public function update_group(Request $request, $id)
    {
        $pag       = PayrollAdjustmentGroup::find($id);
        $validator = \Validator::make($request->all(), [

        ], [

        ]);
        if (!$validator->fails()) {
            $pag->update($request->all());
            return redirect()->route('payroll.groups.index')->with('success', 'Payroll group was updated successfully');
        } else {
            return back()->withInput()->withErrors($validator)->with('error', 'Payroll group failed to update');
        }
    }

    public function apply_updates(Request $request)
    {
        try {
            // $procedures = \DB::statement("
            //     EXEC procInsertNewEmployee2Payroll
            //     EXEC procUpdateAllIndividualColumns
            // ");
            $procedures = \DB::statement("
                EXEC procRunPayroll
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
        $max_date           = Deduction::max('EffectiveDate');
        $current_deductions = Deduction::where('EffectiveDate', $max_date);
        return view('payroll.deductions.index', compact('current_deductions', 'max_date'));
    }

    public function get_manual_deductions()
    {
        $employees       = Staff::select('UserID')->get();
        $deduction_types = DeductionItem::select('DeductionItem', 'DeductionItemRef')->get();
        return view('payroll.deductions.manual', compact('employees', 'deduction_types'));
    }

    public function post_manual_deductions(Request $request)
    {
        $deduction = new Deduction($request->all());
        $validator = \Validator::make($request->all(), [
            'DeductionID'   => 'required',
            'Amount'        => 'required',
            'EffectiveDate' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Deduction entry failed', 'errors' => $validator->errors()]);
        } else {
            // save entry
            if ($deduction->save()) {
                return response()->json('Deduction entry was successful');
            }
        }
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
