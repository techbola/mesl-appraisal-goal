<?php

namespace Cavidel\Http\Controllers;

use Cavidel\PymtPlan;

use Illuminate\Http\Request;

class PymtPlanController extends Controller
{
    public function index()
    {
        $plans = PymtPlan::all();
        return view('pymtPlan.index', compact('plans'));
    }

    public function store_payment_plan(Request $request)
    {
        $plan              = new PymtPlan($request->all());
        $plan->inputter_id = \Auth()->user()->id;
        if ($plan->save()) {
            return redirect()->route('PaymentPlan')->with('success', 'Payment Plan Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Payment plan cannot be created');
        }

    }

    public function get_plan_data($id)
    {
        $ref          = $id;
        $data_details = PymtPlan::where('PymtPlanRef', $ref)->first();
        return response()->json($data_details)->setStatusCode(200);
    }

    public function submit_plan_edit_form(Request $request)
    {
        $ref         = $request->PymtPlanRef;
        $update_data = PymtPlan::where('PymtPlanRef', $ref)->first();
        $update_data->update($request->except(['_token', '_method']));
        $plans = PymtPlan::all();
        return response()->json($plans)->setStatusCode(200);
    }

}
