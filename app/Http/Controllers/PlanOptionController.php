<?php

namespace MESL\Http\Controllers;

use MESL\PlanOption;
use Illuminate\Http\Request;

class PlanOptionController extends Controller
{
    public function index()
    {
        $plans = PlanOption::all();
        return view('plan_option.index', compact('plans'));
    }

    public function store_plan_option(Request $request)
    {
        $plan             = new PlanOption($request->all());
        $plan->inputterID = \Auth()->user()->id;
        if ($plan->save()) {
            return redirect()->route('PlanOption')->with('success', 'Plan option Created/Updated or Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Plan option cannot be created/Updated or Deleted');
        }

    }

    public function get_plan_option_data($id)
    {
        $ref          = $id;
        $data_details = PlanOption::where('OptionRef', $ref)->first();
        return response()->json($data_details)->setStatusCode(200);
    }

    public function submit_plan_option_edit_form(Request $request)
    {
        $ref         = $request->OptionRef;
        $update_data = PlanOption::where('OptionRef', $ref)->first();
        $update_data->update($request->except(['_token', '_method']));
        $plans = PlanOption::all();
        return response()->json($plans)->setStatusCode(200);
    }

    public function delete_plan_option($id)
    {
        $ref         = $id;
        $delete_data = PlanOption::where('OptionRef', $ref)->delete();
        return response($content = 'true', $status = 200);
    }

}
