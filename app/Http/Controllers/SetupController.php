<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\HMO;
use MESL\HMOPlan;
use MESL\Location;
use MESL\PFA;

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

    //location Setup
    public function location()
    {
        $location = Location::Orderby('LocationRef', 'DESC')->get();
        return view ('setup.location', compact('location'));
    }

    public function store_location(Request $request)
    {
        $location = new Location($request->all());
        $this->validate($request, [
            'Location' => 'required',
        ]);
        if ($location->save()) {
            return redirect('/setup/location')->with('success', 'Location was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Location failed to save');
        }
    }

    public function edit_location($id)
    {
        $location = Location::where("LocationRef", $id)->first();

        return response()->json($location);
    }

    public function update_location(Request $request)
    {
        $location = Location::find($request->LocationRef);

        $location->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_location($id)
    {
        $location = Location::where("LocationRef", $id);

        $location->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    //PFA Setup

    public function pfa()
    {
        $pfa = PFA::Orderby('PFARef', 'DESC')->get();
        return view('setup.pfa', compact('pfa'));
    }

    public function store_pfa(Request $request)
    {
        $pfa = new PFA($request->all());
        $this->validate($request, [
            'PFA' => 'required',
        ]);
        if ($pfa->save()) {
            return redirect('/setup/pfa')->with('success', 'PFA was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'PFA failed to save');
        }
    }

    public function edit_pfa($id)
    {
        $pfa = PFA::where("PFARef", $id)->first();

        return response()->json($pfa);
    }

    public function update_pfa(Request $request)
    {
        $pfa = PFA::find($request->PFARef);

        $pfa->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function delete_pfa($id)
    {
        $pfa = PFA::where("PFARef", $id);

        $pfa->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

}
