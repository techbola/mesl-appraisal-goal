<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Staff;
use Cavidel\LeaveApprover;
use Cavidel\Mail\ConfirmedLeave;
use Cavidel\LeaveRequest;
use Illuminate\Http\Request;
use Mail;

class ApproverController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        return view('approvers.approver', compact('staffs'));
    }

    public function save_new_approver(Request $request)
    {
        try {
            \DB::beginTransaction();
            $id                   = \Auth()->user()->id;
            $save_data            = new LeaveApprover($request->all());
            $save_data->EnteredBy = $id;
            $save_data->save();
            \DB::commit();
            return response($content = 'ok', $status = 200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'fail');
        }
    }

    public function get_pending_leave_request()
    {
        try {
            \DB::beginTransaction();
            $details = LeaveRequest::where('NotifyFlag', 1)
                ->select('*')
                ->join('tblStaff', 'tblLeaveRequest.StaffID', '=', 'tblStaff.StaffRef')
                ->join('users', 'tblStaff.UserID', '=', 'users.id')
                ->join('tblLeaveType', 'tblLeaveRequest.AbsenceTypeID', '=', 'tblLeaveType.LeaveTypeRef')

                ->where('RejectionFlag', '!=', 1)
                ->whereNull('tblLeaveRequest.ApproverID')
                ->where('CompletedFlag', 1)
                ->where('HMO_Confirmation', 0)
                ->get()
                ->transform(function ($item, $key) {
                    $item->approvers = $item->approvers();
                    $item->fullname  = $item->staff->fullname;
                    return $item;
                });
            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'fail');
        }
    }

    public function get_completed_leave_request()
    {
        try {
            \DB::beginTransaction();
            $details = LeaveRequest::where('NotifyFlag', 1)
                ->select('*')
                ->join('tblStaff', 'tblLeaveRequest.StaffID', '=', 'tblStaff.StaffRef')
                ->join('users', 'tblStaff.UserID', '=', 'users.id')
                ->join('tblLeaveType', 'tblLeaveRequest.AbsenceTypeID', '=', 'tblLeaveType.LeaveTypeRef')
                ->where('RejectionFlag', '!=', 1)
                ->whereNull('tblLeaveRequest.ApproverID')
                ->where('CompletedFlag', 1)
                ->where('HMO_Confirmation', 1)
                ->get()
                ->transform(function ($item, $key) {
                    $item->approvers = $item->approvers();
                    $item->fullname  = $item->staff->fullname;
                    return $item;
                });
            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'fail');
        }
    }

    public function confirm_leave_request($ref)
    {
        try {
            \DB::beginTransaction();
            $confirm = LeaveRequest::where('LeaveReqRef', $ref)->update(['HMO_Confirmation' => 1]);
            if ($confirm) {
                $leave_request = LeaveRequest::where('LeaveReqRef', $ref)->first();
                $ref           = $leave_request->StaffID;

                $email = \DB::table('users')
                    ->select('email')
                    ->where('id', $ref)
                    ->first();

                $name = \DB::table('users')
                    ->select('first_name')
                    ->where('id', $ref)
                    ->first();

                Mail::to($email)->send(new ConfirmedLeave($name));
            }

            if ($confirm) {
                $details = \DB::table('tblLeaveRequest')
                    ->join('tblStaff', 'tblLeaveRequest.StaffID', '=', 'tblStaff.StaffRef')
                    ->join('users', 'tblStaff.UserID', '=', 'users.id')
                    ->join('tblLeaveType', 'tblLeaveRequest.AbsenceTypeID', '=', 'tblLeaveType.LeaveTypeRef')
                    ->where('NotifyFlag', 1)
                    ->where('RejectionFlag', '!=', 1)
                    ->whereNull('tblLeaveRequest.ApproverID')
                    ->where('CompletedFlag', 1)
                    ->where('HMO_Confirmation', 0)
                    ->get();
            }
            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'fail');
        }
    }
    public function get_leave_approvers_details()
    {
        try {
            \DB::beginTransaction();
            $get_data = LeaveApprover::where('ModuleID', 3)
                ->join('tblStaff', 'tblLeaveApprover.StaffID', 'tblStaff.StaffRef')
                ->get()
                ->transform(function ($item, $key) {
                    $item->fullname = $item->staff->Fullname;
                    $item->email    = $item->staff->user->email;
                    return $item;
                });
            \DB::commit();
            return response()->json($get_data)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 'fail');
        }
    }

}
