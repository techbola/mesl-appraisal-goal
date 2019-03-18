<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\HMO;
use MESL\HMOPlan;

class SetupController extends Controller
{
    public function hmo()
    {
        $hmo = HMO::Orderby('HMORef', 'DESC')->get();
        return view('setup.hmo', compact('hmo'));
    }

    public function store_hmo(Request $request)
    {
        $hmo = new HMO($request->all());
        $this->validate($request, [
            'HMO' => 'required',
        ]);
        if ($hmo->save()) {
            return redirect('/setup/hmo')->with('success', 'HMO was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'HMO failed to save');
        }
    }

    public function edit_hmo($id)
    {
        $hmo = HMO::where("HMORef", $id)->first();

        return response()->json($hmo);
    }

    public function update_hmo(Request $request)
    {
        $hmo = HMO::find($request->HMORef);

        $hmo->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_hmo($id)
    {
        $hmo = HMO::where("HMORef", $id);

        $hmo->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    //HMO Plan
    public function hmo_plan()
    {
        $hmoplan = HMOPlan::Orderby('HMOPlanRef', 'DESC')->get();
        return view('setup.hmo_plan', compact('hmoplan'));
    }

    public function store_hmo_plan(Request $request)
    {
        $hmoplan = new HMOPlan($request->all());
        $this->validate($request, [
            'HMOPlan' => 'required',
        ]);
        if ($hmoplan->save()) {
            return redirect('/setup/hmo_plan')->with('success', 'HMO Plan was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'HMO Plan failed to save');
        }
    }

    public function edit_hmo_plan($id)
    {
        $hmoplan = HMOPlan::where("HMOPlanRef", $id)->first();

        return response()->json($hmoplan);
    }

    public function update_hmo_plan(Request $request)
    {
        $hmoplan = HMOPlan::find($request->HMOPlanRef);

        $hmoplan->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_hmo_plan($id)
    {
        $hmoplan = HMOPlan::where("HMOPlanRef", $id);

        $hmoplan->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }
}
