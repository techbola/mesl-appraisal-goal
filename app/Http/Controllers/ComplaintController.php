<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ComplaintController extends Controller
{
    public function index()
    {

        return view('estate_management.complaints.index', comapct());
    }

    public function create()
    {
        return view('estate_management.complaints.create', compact());
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
