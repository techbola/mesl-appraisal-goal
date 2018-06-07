<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cavidel\Location;
use Cavidel\Complaint;
use Cavidel\Client;

class ComplaintController extends Controller
{
    public function index()
    {
        $clients    = Client::all();
        $locations  = Location::all();
        $complaints = Complaint::all();
        return view('estate_management.complaints.index', compact('locations', 'clients', 'complaints'));
    }

    public function create()
    {
        $clients   = Client::all();
        $locations = Location::all();
        return view('estate_management.complaints.create', compact('locations', 'clients'));
    }

    public function send($id)
    {
        try {
            DB::beginTransaction();
            // if no approvers
            $complaint->notify_flag = true;
            $complaint->save();
            DB::commit();
            return redirect()->route('estate-management.complaints.index')->with('success', 'Complaint was sent successfully');

        } catch (Exception $e) {
            DB::rollback();
        }

    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'client_id' => 'required',
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
            return redirect()->route('estate-management.complaints.create')->with('success', 'Compaints have been saved successfully');

        } catch (Exception $e) {
            DB::rollback();
            dump($e);
        }

    }

    public function edit($id)
    {
        $complaint = Complaint::find($id);
        $clients   = Client::all();
        $locations = Location::all();
        return view('estate_management.complaints.edit', compact('complaint', 'clients', 'locations'));

    }

    public function update(Request $request, $id)
    {
        $complaint = Complaint::find($id);
        if ($complaint->update($request->all())) {
            return redirect()->route('estate-management.complaints.edit', ['id' => $id])->with('success', 'Complaint was updated successfully');
        }
    }
}
