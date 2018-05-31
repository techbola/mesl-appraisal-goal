<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\User;
use Cavidel\Memo;
use Cavidel\RequestType;

class MemoController extends Controller
{

    public function index()
    {
        $memos = Memo::all();
        return view('memos.index', compact('memos'));
    }

    public function create()
    {
        $employees = User::all();
        $employees = $employees->transform(function ($item, $key) {
            $item->name = $item->Fullname;
            return $item;
        });
        $request_types = RequestType::all();
        return view('memos.create', compact('employees', 'request_types'));
    }

    public function send($id)
    {
        $memo             = Memo::findorFail($id);
        $memo->NotifyFlag = true;
        if ($memo->save()) {
            // TODO: send notification here
            return redirect()->route('memos.index')->with('success', 'Memo has been sent for approval successfully');
        } else {
            return back()->withInput()->with('error', 'Failed to send Memo for approval');
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject'         => 'required',
            'purpose'         => 'required',
            'request_type_id' => 'required',
            'body'            => 'required',
        ], [
            'request_type_id.required' => 'Choosing a request type is compulsory',
        ]);
        $new_memo             = new Memo($request->all());
        $new_memo->ApproverID = $request->ApproverID1;
        if ($new_memo->save()) {
            // $new_memo->update(['ApproverID' => 'ApproverID1']);
            return redirect()->route('memos.create')->with('success', 'Memo was created successfully. <a href="' . route('memos.index') . '">Go to queue</a>');
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $memo = Memo::find($id);
        return view('memos.edit', compact('memo'));

    }

    public function update(Request $request, $id)
    {
        $memo = Memo::find($id);
        if ($memo->update($request->all())) {
            return redirect()->route('memos.create')->with('success', 'Memo has been updated successfully');
        } else {
            return back()->withInput()->with('error', 'Memo failed to updated');
        }
    }

    public function approval_list()
    {

        // unapproved docs
        $unapproved_memos = Memo::where('ApproverID', auth()->user()->id)
            ->where('NotifyFlag', 1)

            ->get();

        // approved docs
        $approved_memos = Memo::where('ApproverID', 0)
            ->where('ApprovedFlag', 1)
            ->whereIn('ApproverID1', [auth()->user()->id])
            ->orWhereIn('ApproverID2', [auth()->user()->id])
            ->orWhereIn('ApproverID3', [auth()->user()->id])
            ->orWhereIn('ApproverID4', [auth()->user()->id])
            ->get();

        return view('memos.approvallist', compact('approved_memos', 'unapproved_memos'));
    }

    public function approve(Request $request)
    {

        $ApprovedDate = $request->ApprovedDate;
        $SelectedID   = collect($request->SelectedID);
        $ApproverID   = $request->ApproverID;
        $Comment      = $request->Comment;
        $ModuleID     = $request->ModuleID;
        $ApprovedFlag = $request->ApprovedFlag;
        $new_array    = array();
        foreach ($SelectedID as $value) {
            array_push($new_array, intval($value));
        }
        $selected_ids = (implode(',', $new_array));

        $approve_proc = \DB::statement(
            "EXEC procApproveRequest  '$ApprovedDate', '$selected_ids', $ModuleID, '$Comment', $ApproverID, $ApprovedFlag"
        );

        return response()->json([
            'message' => 'Memo was approved successfully',
        ])->setStatusCode(200);
    }

    public function reject(Request $request)
    {
        // return dd($request);
        // Call rejection procedure
        $RejectedDate = $request->RejectedDate;
        $SelectedID   = collect($request->SelectedID);
        $RejecterID   = $request->RejecterID;
        $Comment      = $request->Comment;
        $ModuleID     = $request->ModuleID;
        $RejectedFlag = $request->RejectedFlag;
        $new_array    = array();
        foreach ($SelectedID as $value) {
            array_push($new_array, intval($value));
        }
        $selected_ids = (implode(',', $new_array));

        $approve_proc = \DB::statement(
            "EXEC procRejectRequest  '$selected_ids', $ModuleID, '$Comment'"
        );

        return response()->json([
            'message' => 'Memo was rejected successfully',
        ])->setStatusCode(200);
    }

    public function destroy($id)
    {
        $memo = Memo::find($id);
        if ($menu->delete()) {
            return redirect()->route('memos.index')->with('success', 'Memo was deleted successfully');
        } else {
            return back()->withInput();
        }
    }
}
