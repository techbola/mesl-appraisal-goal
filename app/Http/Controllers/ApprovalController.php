<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\Document;
class ApprovalController extends Controller
{
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
            'message' => 'Document was approved successfully',
        ])->setStatusCode(200);
    }

    public function cancelApproval(Request $request)
    {
        // return dd($request);
        // Call approval procedure
        // Params
        // $ApprovedDate = $request->ApprovedDate;
        $SelectedID   = collect($request->SelectedID);
        $ApproverID   = $request->ApproverID;
        $Comment      = $request->Comment;
        $ModuleID     = $request->ModuleID;
        $ApprovedDate = $request->ApprovedDate;
        // $ApprovedFlag = 0;
        $new_array = array();
        foreach ($SelectedID as $value) {
            array_push($new_array, intval($value));
        }
        $selected_ids = (implode(',', $new_array));
        $user_id      = auth()->user()->id;
        $approve_proc = \DB::statement(
            "EXEC procUnApproveRequest  '$ApprovedDate', '$selected_ids', $ModuleID, '$Comment', $ApproverID, $user_id"
        );
        return response()->json([
            'message' => 'Document was recalled successfully',
        ]);
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
            "EXEC procRejectRequest  '$RejectedDate', '$selected_ids', $ModuleID, '$Comment', $RejecterID, $RejectedFlag"
        );
    }
}
