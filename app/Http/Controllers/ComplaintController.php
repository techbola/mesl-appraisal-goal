<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cavidel\Location;
use Cavidel\Complaint;
use Cavidel\Client;
use Cavidel\Department;
use Cavidel\ComplaintComment;

class ComplaintController extends Controller
{
    public function index()
    {
        $clients    = Client::all();
        $locations  = Location::all();
        $complaints = Complaint::all();
        // dd($complaint_discussions);
        $departments = Department::get(['Department', 'DepartmentRef']);
        // ------------------------------- //
        $staff                  = auth()->user()->staff;
        $my_departments         = Department::whereIn('DepartmentRef', $staff->departments)->get();
        $complaint_sent_to_dept = Complaint::whereIn('current_queue', $my_departments)->get();

        return view('estate_management.complaints.index', compact('locations', 'clients', 'complaints', 'departments', 'complaint_sent_to_dept'));
    }

    public function create()
    {
        $clients   = Client::all();
        $locations = Location::all();
        return view('estate_management.complaints.create', compact('locations', 'clients'));
    }

    public function send(Request $request)
    {
        try {
            $complaint = Complaint::find($request->complaint_id);
            DB::beginTransaction();
            $complaint->notify_flag   = true; // flag complaint as sent [denotes that process has started]
            $complaint->current_queue = $request->current_queue; // department that sees it next
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
        $complaint = new Complaint($request->all() + ['sender_id' => auth()->user()->id]);

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

    public function comment(Request $request)
    {
        try {
            DB::beginTransaction();
            $complaint = Complaint::find($request->complaint_id)->first();
            // dd($complaint);
            // create comment
            $complaint->comments()->create([
                'comment'         => $request->comment,
                'status'          => $request->status,
                'has_cost'        => $request->has_cost ?? 0,
                'cost'            => $request->cost,
                'queue_sender_id' => auth()->user()->id, //dept_id
            ]);
            DB::commit();
            return redirect()->route('estate-management.complaints.index')->with('success', 'Feedback posted. ');
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }

    }

    public function view_comments($id)
    {
        $complaint             = Complaint::find($id);
        $complaint_discussions = $complaint->comments;
        return view('estate_management.complaints.comments', compact('complaint_discussions', 'complaint'));
    }

    public function update(Request $request, $id)
    {
        $complaint = Complaint::find($id);
        if ($complaint->update($request->all())) {
            return redirect()->route('estate-management.complaints.edit', ['id' => $id])->with('success', 'Complaint was updated successfully');
        }
    }
}
