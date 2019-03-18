<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\HMO;

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
}
