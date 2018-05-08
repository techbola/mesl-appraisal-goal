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
}
