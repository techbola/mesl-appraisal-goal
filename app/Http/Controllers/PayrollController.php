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
        return view('payroll.details', compact('payroll_details', 'months', 'max_month', 'logged_in_user'));
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

    public function delete_group($id)
    {
        $pag = PayrollAdjustmentGroup::find($id);
        if ($pag->delete()) {
            return redirect('/payroll/groups')->with('success', 'Payroll group deleted successfully');
        } else {
            return back()->with('danger', 'Payroll group failed to delete');
        }
    }

    public function update_group(Request $request, $id)
    {
        $pag       = PayrollAdjustmentGroup::find($id);
        $validator = \Validator::make($request->all(), [
            'GroupDescription' => 'required',
        ], []);
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

    public function get_user_deductions($id)
    {
        $employee = Staff::find($id);
        dd($employee);
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

    // cummulative
    public function get_cummulative()
    {
        $cummulatives = collect(\DB::select("
                EXEC procCummulativeSchedule
            "));
        $cummulatives = $cummulatives->transform(function ($item, $key) {
            $item->Fullname = Staff::where('UserID', $item->StaffID)->first()->Fullname;
            return $item;
        });
        return view('payroll.reports.cummulative', compact('cummulatives'));
    }

    public function get_individual()
    {
        $payroll_details = collect(\DB::select("
                EXEC procPayrollIndividual
            "));
        $payroll_details = $payroll_details->transform(function ($item, $key) {
            $item->Fullname = Staff::where('UserID', $item->StaffID)->first()->Fullname;
            return $item;
        });
        return view('payroll.reports.individual', compact('payroll_details'));
    }
    public function get_netpay_to_bank()
    {
        $nptb = \DB::select("
            EXEC procNetPayToBank
        ");
        $nptb = collect($nptb)->transform(function ($item, $key) {
            $item->Fullname       = Staff::where('UserID', $item->StaffID)->first()->Fullname ?? '-';
            $item->BankAcctNumber = Staff::where('UserID', $item->StaffID)->first()->BankAcctNumber ?? '-';
            $item->BankName       = Staff::where('UserID', $item->StaffID)->first()->bank->Bank ?? '-';
            return $item;
        });
        return view('payroll.reports.nptb', compact('nptb'));
    }

    // payslip
    public function payslip_individual()
    {
        $max_month      = PayrollMonthly::max('PayMonth');
        $current_year   = \Carbon\Carbon::now()->format('Y');
        $payslip_detail = PayrollMonthly::where('StaffID', auth()->user()->staff->StaffRef)
            ->where('PayMonth', $max_month)
            ->where('PayYear', $current_year)
            ->first();
        // dd($payslip_detail);
        return view('staff.payslip', compact('payslip_detail'));
    }

    public function payslip_all()
    {
        $max_month      = PayrollMonthly::max('PayMonth');
        $current_year   = \Carbon\Carbon::now()->format('Y');
        $payslip_detail = PayrollMonthly::where('StaffID', auth()->user()->staff->StaffRef)
            ->where('PayMonth', $max_month)
            ->where('PayYear', $current_year)
            ->first();
        // dd($payslip_detail);
        return view('staff.payslip', compact('payslip_detail'));
    }

    public function payslip_general()
    {
        $employees = Staff::all()->filter(function ($item) {
            return $item->CompanyID = auth()->user()->staff->CompanyID;
        });

        $months = Month::select('Months', 'MonthsRef')->get();

        $years = year_range(2018, 2030); // returns a collection

        return view('payroll.reports.payslip_search', compact('employees', 'months', 'years'));
    }

    public function payslip_general_post(Request $request)
    {
        $month    = $request->PayMonth;
        $year     = $request->PayYear;
        $staff_id = $request->StaffID;
        // return $payslips;
        $payslip_detail = PayrollMonthly::where('StaffID', $staff_id)
            ->where('PayMonth', $month)
            ->where('PayYear', $year)
            ->get();
        if ($payslip_detail->count() == 0) {
            return back()->withInput()->with('error', 'Payroll details not available');
        }
        // dd($payslip_detail);
        $payslip_detail->transform(function ($item, $key) {
            $item->Fullname = Staff::find($item->StaffID)->full_name;
            return $item;
        });
        $payslip_detail = $payslip_detail->first();

        return view('payroll.reports.payslip_general', compact('payslip_detail'));
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
