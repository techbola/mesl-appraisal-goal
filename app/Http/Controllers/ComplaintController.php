<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cavidel\Location;
use Cavidel\Staff;
use Cavidel\Client;

class ComplaintController extends Controller
{
    public function index()
    {

        return view('estate_management.complaints.index');
    }

    public function create()
    {
        $clients   = Client::all();
        $clients   = Location::all();
        $locations = Location::all();
        return view('estate_management.complaints.create', compact('locations', 'clients'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            '' => 'required',
        ], [
            // custom messags
        ]);

        if ($validator->fails()) {
            return redirect()->route('estate-management.complaints.index')->with('danger', 'Complaints failed to save');
        }

        //  save record
        $complaint = new Complaint($request->all());

        try {
            DB::beginTransaction();
            $complaint->save();
            DB::commit();
            return redirect()->route('complaints.create')->with('success', 'Compaints have been saved successfully');

        } catch (Exception $e) {
            DB::rollback();
            dump($e);
        }

    }
}
