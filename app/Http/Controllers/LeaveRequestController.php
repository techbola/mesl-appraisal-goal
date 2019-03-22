<?php

namespace MESL\Http\Controllers;

use MESL\LeaveType;
// use MESL\Mail\Leave;
use MESL\Staff;
use MESL\User;
use MESL\Role;
use MESL\LeaveRequest;
use MESL\Department;
use MESL\Mail\LeaveRequest as LR;
use MESL\Mail\HRLeaveConfirmation;
use MESL\Mail\FinalHRLeaveConfirmation;
use MESL\Mail\LeaveRequestedInit;
use MESL\Mail\LeaveRequestSupervisor;
use MESL\Mail\LeaveRequestApproval;
use MESL\Mail\RejectLeaveRequest;
use MESL\Mail\ReliefLeaveRequest;
use MESL\Mail\LeaveRequestedRejected;
use Carbon\Carbon;
use MESL\RestrictionDates;
use MESL\LeaveTransaction;
use MESL\LeaveApprover;
use MESL\HandoverTask;
use MESL\HandOverNote;

use Illuminate\Http\Request;
use Mail;

class LeaveRequestController extends Controller
{
    public function dashboard()
    {
        $id             = \Auth::user()->id;
        $leave_requests = LeaveRequest::where('StaffID', $id)->get();
        $unsent_request = LeaveRequest::where('StaffID', $id)->where('NotifyFlag', 1)->get();
        $leavedays      = Staff::where('UserID', $id)->first();
        $leave_type     = LeaveType::all();
        $department     = Department::all()->sortBy('Department');

        $user  = \Auth::user();
        $id    = \Auth::user()->id;
        $staff = Staff::where('CompanyID', $user->CompanyID)->get();
        return view('leave_request.index', compact('leave_requests', 'unsent_request', 'leave_type', 'staff', 'user', 'id', 'department', 'user', 'leavedays'));
    }

    public function get_leave_days($leave_type_id)
    {

        $id = \Auth::user()->id;

        $leavedays = Staff::where('UserID', $id)->first();

        if ($leave_type_id == '1') {
            $leave_days = $leavedays->LeaveDays;
        } elseif ($leave_type_id == '2') {
            $leave_days = $leavedays->CasualLeaveDays;
        } elseif ($leave_type_id == '3') {
            $leave_days = $leavedays->ExamLeaveDays;
        } elseif ($leave_type_id == '4') {
            $leave_days = $leavedays->MaternityLeaveDays;
        } elseif ($leave_type_id == '5') {
            $leave_days = $leavedays->SickLeaveDays;
        } elseif ($leave_type_id == '6') {
            $leave_days = $leavedays->CompasionateLeaveDays;

        } elseif ($leave_type_id == '7') {

            $leave_days = $leavedays->PaternityLeaveDays;
        }

        $leave_used = collect(\DB::table('tblLeaveTransaction')
                ->where('StaffID', $id)->where('LeaveTypeID', $leave_type_id)->get())
            ->sum('DaysRequested');

        $leave_remaining_days = ($leave_days - $leave_used) < 0 ? 0 : $leave_days - $leave_used;
        //return $leave_used;
        return response()->json(['data' => ['leavedays' => $leave_days, 'leaveremainingdays' => $leave_remaining_days]]);

    }

    public function leave_request()
    {

        $leave_type     = LeaveType::all()->sortBy('LeaveType');
        $unsent_request = LeaveRequest::where('StaffID', auth()->user()->id)->where('NotifyFlag', 1)->get();
        $user           = \Auth::user();
        $id             = \Auth::user()->id;
        $department     = Department::all()->sortBy('Department');
        $leavedays      = Staff::where('UserID', $id)->first();
        $staff          = Staff::where('CompanyID', $user->CompanyID)
            ->where('DepartmentID', $user->staff->DepartmentID)
            ->where('UserID', '<>', $user->id)
            ->get()
            ->sortBy('FullName');

        $leave_used = \DB::table('tblLeaveTransaction')
            ->where('StaffID', $id)
            ->sum('DaysRequested');
        $remaining_days = $leavedays->LeaveDays - $leave_used;
        return view('leave_request.create', compact('leave_type', 'unsent_request', 'staff', 'id', 'leavedays', 'leave_used', 'remaining_days', 'department', 'leave_days'));
    }

    public function leave_approval_supervisor()
    {
        $id             = \Auth::user()->id;
        $leave_requests = \DB::table('tblLeaveRequest')
            ->join('tblLeaveType', 'tblLeaveRequest.AbsenceTypeID', '=', 'tblLeaveType.LeaveTypeRef')
        // ->join('tblHandOver', 'tblLeaveRequest.LeaveReqRef', '=', 'tblHandOver.LeaveRequestID')
            ->join('users', 'tblLeaveRequest.StaffID', '=', 'users.id')
            ->where('ApproverID', auth()->user()->staff->StaffRef)
        // ->where('ApproverID', auth()->user()->id)
            ->where('NotifyFlag', 1)
            ->where('SupervisorApproved', 0)
            ->get();

        $leave_check = $leave_requests->transform(function ($item, $key) {
            $start = $item->StartDate;
            $end   = $item->ReturnDate;

            $events = RestrictionDates::where(function ($query) use ($start, $end) {
                $query->where(function ($query) use ($start, $end) {
                    $query->where('StartDate', '>=', $start)
                        ->where('EndDate', '>=', $start);
                })
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('EndDate', '>=', $end)
                            ->where('EndDate', '<=', $end);
                    })

                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('StartDate', '>=', $start)
                            ->where('EndDate', '>=', $end);
                    })

                ;
            });
            $item->handovers = HandOverNote::where('LeaveRequestID', $item->LeaveReqRef)->get();
            $item->status    = $events->count();
            return $item;
        });
        $staff = Staff::all()
            ->where('SupervisorFlag', 1)
            ->sortBy('FullName');
        // dd($leave_check);
        return view('leave_request.leave_approval_supervisor', compact('leave_requests', 'leave_check', 'staff'));
    }

    public function leave_approval()
    {
        $id             = \Auth::user()->id;
        $leave_requests = \DB::table('tblLeaveRequest')
            ->join('tblLeaveType', 'tblLeaveRequest.AbsenceTypeID', '=', 'tblLeaveType.LeaveTypeRef')
        // ->join('tblHandOver', 'tblLeaveRequest.LeaveReqRef', '=', 'tblHandOver.LeaveRequestID')
            ->join('users', 'tblLeaveRequest.StaffID', '=', 'users.id')
            ->where('ApproverID', auth()->user()->id)
            ->where('NotifyFlag', 1)
            ->get();

        $leave_check = $leave_requests->transform(function ($item, $key) {
            $start = $item->StartDate;
            $end   = $item->ReturnDate;

            $events = RestrictionDates::where(function ($query) use ($start, $end) {
                $query->where(function ($query) use ($start, $end) {
                    $query->where('StartDate', '>=', $start)
                        ->where('EndDate', '>=', $start);
                })
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('EndDate', '>=', $end)
                            ->where('EndDate', '<=', $end);
                    })

                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('StartDate', '>=', $start)
                            ->where('EndDate', '>=', $end);
                    })

                ;
            });
            $item->handovers = HandOverNote::where('LeaveRequestID', $item->LeaveReqRef)->get();
            $item->status    = $events->count();
            return $item;
        });
        $staff = Staff::all()->sortBy('FullName');
        // dd($leave_check);
        return view('leave_request.leave_approval', compact('leave_requests', 'leave_check', 'staff'));
    }

    public function hr_leave_approval()
    {
        $id             = \Auth::user()->id;
        $leave_requests = \DB::table('tblLeaveRequest')
            ->join('tblLeaveType', 'tblLeaveRequest.AbsenceTypeID', '=', 'tblLeaveType.LeaveTypeRef')
            ->join('users', 'tblLeaveRequest.StaffID', '=', 'users.id')
            ->where('NotifyFlag', 1)
            ->where('ApprovedFlag', 1)
            ->whereIn('tblLeaveRequest.RoleID', [16])
            ->get();

        $leave_check = $leave_requests->transform(function ($item, $key) {
            $start = $item->StartDate;
            $end   = $item->ReturnDate;

            $events = RestrictionDates::where(function ($query) use ($start, $end) {
                $query->where(function ($query) use ($start, $end) {
                    $query->where('StartDate', '>=', $start)
                        ->where('EndDate', '>=', $start);
                })
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('EndDate', '>=', $end)
                            ->where('EndDate', '<=', $end);
                    })

                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('StartDate', '>=', $start)
                            ->where('EndDate', '>=', $end);
                    })

                ;
            });
            $item->status = $events->count();
            return $item;
        });
        return view('leave_request.hr_leave_approval', compact('leave_requests', 'leave_check'));
    }

    public function retrieve_details($start_date, $numberdays)
    {
        $trans = collect(\DB::select("EXEC procLeaveEndDate '$start_date', $numberdays"));
        return response()->json($trans->first())->setStatusCode(200);
    }

    public function leave_notification($elem_value)
    {
        if (!is_null($elem_value)) {
            $leave_request = LeaveRequest::find($elem_value);
            $trans         = \DB::table('tblLeaveRequest')
                ->where('leaveReqRef', $elem_value)
                ->update([
                    'NotifyFlag'    => 1,
                    'ApproverID'    => $leave_request->SupervisorID,
                    'RejectionFlag' => '0',
                ]);

            if ($trans) {
                $details = \DB::table('tblLeaveRequest')
                    ->where('leaveReqRef', $elem_value)
                    ->first();

                if (!is_null($details->SupervisorID) || $details->SupervisorID > 0) {
                    $email = \DB::table('users')
                        ->select('email')
                        ->where('id', Staff::find($details->SupervisorID)->user->id)
                        ->first();

                    $name = \DB::table('users')
                        ->select('first_name')
                        ->where('id', Staff::find($details->SupervisorID)->user->id)
                        ->first();

                    // return ($leave_request);
                    // Mail::to($email)->send(new LR($name, $details));
                    // // supervisor
                    Mail::to($email)->send(new LeaveRequestSupervisor($leave_request));
                }
                return redirect()->route('LeaveDashBoard')->with('success', 'Leave request was added successfully');
            }
        } else {
            return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
        }
    }

    // supervisor
    public function approve_request_supervisor(Request $request, $ref)
    {
        $staffs = Staff::all();
        $user   = User::all();

        $leave_request = LeaveRequest::find($ref);
        // $leave_request->ApprovalDate = date('Y-m-d');

        // dd($leave_request);
        // $leave_request->RequestApproved    = 1;
        $leave_request->SupervisorApproved = 1;
        // $leave_request->ApproverID         = $request->Approver1 ?? 0;
        // $leave_request->ApproverID1        = $request->Approver1 ?? 0;
        // $leave_request->ApproverID2        = $request->Approver2 ?? 0;
        // $leave_request->ApproverID3        = $request->Approver3 ?? 0;
        // $leave_request->ApproverID4        = $request->Approver4 ?? 0;
        // $leave_request->ApproverComment    = $request->Comment;
        $leave_request->ApprovedFlag    = 1;
        $leave_request->ApproverComment = $request->ApproverComment;
        $leave_request->ApproverID      = 0;
        $get_approvers                  = LeaveApprover::where('ModuleID', 3)->get();

        $hr_users =
        User::whereHas('roles', function ($query) {
            $query->where('name', 'Head, Performance Management')
                ->orWhere('name', 'Head, Human Resources');
        })->get();

        if (User::find($leave_request->StaffID)) {
            $name = \DB::table('users')
                ->select('first_name')
                ->where('id', User::find($leave_request->StaffID)->first()->id)
                ->first();

            Mail::to($hr_users)->send(new HRLeaveConfirmation($name, $leave_request));
        }

        $leave_request->update();

        // $email = User::find($leave_request->RequesterID)->first()->email;
        // dd($request->all());
        // if (!is_null($leave_request->current_approver)) {
        //     Mail::to($leave_request->current_approver->email)->send(new LeaveRequestApproval($leave_request));
        // }
        // send emails when ApproverID is null and send route request to admin
        //  end
        return redirect('/leave_request/leave_approval_supervisor')->with('success', 'Request approved successfully');
    }

    public function reject_request_supervisor($id)
    {
        $staffs = Staff::all();
        $user   = User::all();

        $leave_request = LeaveRequest::find($id);
        // $leave_request->ApprovalDate = date('Y-m-d');

        // dd($leave_request);
        $leave_request->RejectionFlag      = 1;
        $leave_request->RejectedBy         = auth()->user()->staff->StaffRef;
        $leave_request->SupervisorApproved = 0;
        $leave_request->NotifyFlag         = 0;
        $leave_request->RejectionComment   = $request->RejectionComment;
        $leave_request->ApproverID         = $request->Approver1 ?? 0;
        $leave_request->ApproverID1        = $request->Approver1 ?? 0;
        $leave_request->ApproverID2        = $request->Approver2 ?? 0;
        $leave_request->ApproverID3        = $request->Approver3 ?? 0;
        $leave_request->ApproverID4        = $request->Approver4 ?? 0;

        $leave_request->update();

        // $email = User::find($leave_request->RequesterID)->first()->email;
        // dd($request->all());
        $requester = User::find($leave_request->StaffID);
        Mail::to($requester->email)->send(new LeaveRequestedRejected($leave_request));

        // send emails when ApproverID is null and send route request to admin
        //  end

        return redirect('/leave_request/leave_approval')->with('success', 'Request approved successfully');
    }

    public function approve_leave_request(Request $request, LeaveApprover $get_approvers)
    {
        if ($request->input('approve')) {
            // dd($request->all());
            try {
                \DB::beginTransaction();
                foreach ($request->LeaveRef as $key => $Ref) {
                    $details      = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $current_time = Carbon::now();

                    $module_id        = 3;
                    $approver_comment = (STRING) $request->ApproverComment[$Ref];
                    // dd($approver_comment);
                    $approver_id = $details->ApproverID;
                    $flag        = 1;
                    $approve     = \DB::statement("EXEC procApproveRequest '$current_time', '$Ref', $module_id, '$approver_comment', $approver_id, $flag");

                    if ($approve) {
                        $trans           = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                        $new_approver_id = $trans->ApproverID;
                        $leavedays       = $trans->NumberofDays;
                        $leave_id        = $trans->LeaveReqRef;
                        $staff_id        = $trans->StaffID;
                        $leave_type_id   = $trans->AbsenceTypeID;
                        $id              = \Auth::user()->id;

                        $trans->ApproverID = 0;
                        if (is_null($new_approver_id) || $new_approver_id == 0) {

                            // if ($details->AbsenceTypeID == 1) {
                            $record                = new LeaveTransaction;
                            $record->StaffID       = $staff_id;
                            $record->DaysRequested = $leavedays;
                            $record->LeaveID       = $leave_id;
                            $record->LeaveTypeID   = $leave_type_id;
                            $record->save();
                            // }

                            $get_approvers = LeaveApprover::where('ModuleID', 3)->get();

                            foreach ($get_approvers as $ref) {
                                $email = \DB::table('users')
                                    ->select('email')
                                    ->where('id', Staff::find($ref->StaffID)->first()->user->id)
                                    ->first();

                                $name = \DB::table('users')
                                    ->select('first_name')
                                    ->where('id', Staff::find($ref->StaffID)->first()->user->id)
                                    ->first();

                                // Mail::to($email)->send(new HRLeaveConfirmation($name));

                            }
                        }

                        if ($new_approver_id > 0) {
                            $email = \DB::table('users')
                                ->select('email')
                                ->where('id', $new_approver_id)
                                ->first();

                            $name = \DB::table('users')
                                ->select('first_name')
                                ->where('id', $new_approver_id)
                                ->first();

                            $approver_email = User::find($details->ApproverID)->email;
                            Mail::to($approver_email)->send(new LeaveRequestApproval($details));
                        }

                        if (!is_null($trans->ReliefOfficerID)) {
                            $relief_officer_email = User::find($trans->ReliefOfficerID)->email;
                            Mail::to($relief_officer_email)->send(new ReliefLeaveRequest($trans));
                        }
                    }
                    // mail to hr
                    // Mail::to($approver_email)->send(new LeaveRequestApproval($details));
                }
                \DB::commit();
                return redirect()->route('LeaveApproval')->with('success', 'Leave request was added successfully');
            } catch (Exception $e) {
                \DB::rollback();
                return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
            }
        } elseif ($request->input('reject')) {
            try {
                \DB::beginTransaction();
                foreach ($request->LeaveRef as $Ref) {
                    $details      = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $approver_id1 = $details->ApproverID1;
                    $current_time = Carbon::now();
                    $comment      = "You Can't Leave Now work Still To be done";
                    $reject_trans = \DB::table('tblLeaveRequest')
                        ->where('leaveReqRef', $Ref)
                        ->update(['NotifyFlag' => 0, 'RejectionFlag' => 1, 'RejectionDate' => $current_time, 'RejectionComment' => $comment, 'ApprovedFlag' => 0]);
                    $leave_request             = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $leave_request->RejectedBy = auth()->user()->staff->StaffRef;
                    $email                     = \DB::table('users')
                        ->select('email')
                        ->where('id', $leave_request->StaffID)
                        ->first();

                    $name = \DB::table('users')
                        ->select('first_name')
                        ->where('id', $leave_request->StaffID)
                        ->first();
                    Mail::to($email)->send(new LR($name, $leave_request));
                }

                \DB::commit();
                return redirect()->route('LeaveDashBoard')->with('success', 'Leave request was added successfully');
            } catch (Exception $e) {
                \DB::rollback();
                return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
            }
        }
    }

    public function approve_leave_request_hr(Request $request, LeaveApprover $get_approvers)
    {
        if ($request->input('approve')) {
            try {
                \DB::beginTransaction();
                foreach ($request->LeaveRef as $key => $Ref) {
                    $details      = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $current_time = Carbon::now();

                    $module_id              = 3;
                    $comment                = $request->Comment[$Ref];
                    $approver_id            = auth()->user()->id;
                    $flag                   = 1;
                    $details->CompletedFlag = 1;
                    // $details->ApproverComment = $request->Comment[$Ref];
                    $approve = \DB::statement("EXEC procApproveRequest '$current_time', '$Ref', $module_id, '$comment', $approver_id, $flag");

                    if ($approve) {
                        $trans           = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                        $new_approver_id = $trans->ApproverID;
                        $leavedays       = $trans->NumberofDays;
                        $leave_id        = $trans->LeaveReqRef;
                        $staff_id        = $trans->StaffID;
                        $leave_type_id   = $trans->AbsenceTypeID;
                        $id              = \Auth::user()->id;

                        if (is_null($new_approver_id) || $new_approver_id == 0) {

                            // if ($details->AbsenceTypeID == 1) {
                            $record                = new LeaveTransaction;
                            $record->StaffID       = $staff_id;
                            $record->DaysRequested = $leavedays;
                            $record->LeaveID       = $leave_id;
                            $record->LeaveTypeID   = $leave_type_id;
                            $record->save();
                            // }

                            $update_leave = \DB::table('tblLeaveRequest')
                                ->where('leaveReqRef', $Ref)
                                ->update([
                                    'CompletedDate' => $current_time,
                                    'CompletedFlag' => 1,
                                    'HRStaffID'     => auth()->user()->id,
                                ]);

                            $leave_req_ref   = LeaveRequest::find($Ref);
                            $leave_requester = User::find($leave_req_ref->StaffID)->first();
                            // dd($leave_requester->first()->email);

                            $name  = User::find($trans->StaffID);
                            $email = $leave_requester->email;

                            Mail::to($email)->send(new FinalHRLeaveConfirmation($name));
                            // relief officer
                            if (!is_null($trans->ReliefOfficerID)) {
                                $relief_officer_email = User::find($leave_req_ref->ReliefOfficerID)->email;
                                Mail::to($relief_officer_email)->send(new ReliefLeaveRequest($leave_req_ref));
                            }

                        }

                    }
                }
                \DB::commit();
                return redirect()->route('HrLeaveApproval')->with('success', 'Leave request was added successfully');
            } catch (Exception $e) {
                \DB::rollback();
                return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
            }
        } elseif ($request->input('reject')) {
            try {
                \DB::beginTransaction();
                foreach ($request->LeaveRef as $Ref) {
                    $details      = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $approver_id1 = $details->ApproverID1;
                    $current_time = Carbon::now();
                    $comment      = "You Can't Leave Now work Still To be done";
                    $reject_trans = \DB::table('tblLeaveRequest')
                        ->where('leaveReqRef', $Ref)
                        ->update(['NotifyFlag' => 0, 'RejectionFlag' => 1, 'RejectionDate' => $current_time, 'RejectionComment' => $comment, 'ApprovedFlag' => 0]);

                    $leave_request             = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $leave_request->RejectedBy = auth()->user()->staff->StaffRef;
                    $email                     = \DB::table('users')
                        ->select('email')
                        ->where('id', $leave_request->StaffID)
                        ->first();

                    $name = \DB::table('users')
                        ->select('first_name')
                        ->where('id', $leave_request->StaffID)
                        ->first();

                    Mail::to($email)->send(new LR($name, $leave_request));
                }
                \DB::commit();
                return redirect()->route('LeaveDashBoard')->with('success', 'Leave request was added successfully');
            } catch (Exception $e) {
                \DB::rollback();
                return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
            }
        }
    }

    public function store_leave_request(Request $request)
    {

        $id = \Auth::user()->id;

        $leavedays     = Staff::where('UserID', $id)->first();
        $leave_type_id = $request->AbsenceTypeID;

        if ($leave_type_id == '1') {
            $leave_days = $leavedays->LeaveDays;
        } elseif ($leave_type_id == '2') {
            $leave_days = $leavedays->CasualLeaveDays;
        } elseif ($leave_type_id == '3') {
            $leave_days = $leavedays->ExamLeaveDays;
        } elseif ($leave_type_id == '4') {
            $leave_days = $leavedays->MaternityLeaveDays;
        } elseif ($leave_type_id == '5') {
            $leave_days = $leavedays->SickLeaveDays;
        } elseif ($leave_type_id == '6') {
            $leave_days = $leavedays->CompasionateLeaveDays;
        } elseif ($leave_type_id == '7') {
            $leave_days = $leavedays->PaternityLeaveDays;
        }

        $leave_used = collect(\DB::table('tblLeaveTransaction')
                ->where('StaffID', $id)->where('LeaveTypeID', $leave_type_id)->get())
            ->sum('DaysRequested');

        $leave_remaining_days = ($leave_days - $leave_used);
        if ($leave_remaining_days <= 0) {
            return back()->withInput()->with('error', 'You have exceeded the number of leave days allocated to you');
        } elseif ($request->NumberofDays > $leave_remaining_days) {
            return back()->withInput()->with('error', 'Request Failed. You have requested more than the number of leave days allocated to you');
        }

        // check to see if there is an approved leave already and still ongoing
        $pending_request = LeaveRequest::where('StaffID', auth()->user()->id)
            ->where('CompletedFlag', 1)
            ->where('ApprovedFlag', 1)
            ->where('ApproverID', 0)
            ->get();

        $ongoing_request = [];
        foreach ($pending_request as $key => $value) {
            if (Carbon::now() > $value->ReturnDate) {
                array_push($ongoing_request, $value->LeaveReqRef);
            }
        }
        if (count($ongoing_request) > 0) {
            return back()->withInput()->with('error', 'You have an approved request which is still ongoing');
        }
        try {
            \DB::beginTransaction();

            if ($request->hasFile('HandOverNote')) {
                $start_date     = $request->StartDate;
                $converted_date = (int) $request->NumberofDays;
                // $drpartment                  = (int) $request->
                $completion_Date             = Carbon::parse($start_date)->addDays($converted_date);
                $leave_request               = new LeaveRequest($request->except(['Task', 'HonCompletionDate', 'Description']));
                $leave_request->ReturnDate   = $completion_Date;
                $filenamewithextension       = $request->file('HandOverNote')->getClientOriginalName();
                $filename                    = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension                   = $request->file('HandOverNote')->getClientOriginalExtension();
                $filenametostore             = str_slug($filename) . time() . '.' . $extension;
                $saveFile                    = $request->file('HandOverNote')->storeAs('public/leave_document', $filenametostore);
                $leave_request->HandOverNote = $filenametostore;
                $leave_request->ReturnDate   = $request->ReturnDate;
                $leave_request->SupervisorID = auth()->user()->staff->SupervisorID;
                $leave_request->save();
            } else {
                $start_date                  = $request->StartDate;
                $converted_date              = (int) $request->NumberofDays;
                $completion_Date             = Carbon::parse($start_date)->addDays($converted_date);
                $leave_request               = new LeaveRequest($request->except(['Task', 'HonCompletionDate', 'Description']));
                $leave_request->SupervisorID = auth()->user()->staff->SupervisorID;
                $leave_request->ReturnDate   = $request->ReturnDate;

                $leave_request->save();
            }

            foreach ($request->Task as $key => $value) {

                // if ($saved) {
                $hon = new HandOverNote([
                    'LeaveRequestID' => $leave_request->LeaveReqRef,

                    'Task'           => $request->Task[$key] ?? null,
                    'CompletionDate' => Carbon::parse($request->HonCompletionDate[$key]) ?? null,
                    'Description'    => $request->Description[$key] ?? null,
                ]);
                $hon->save();
                // }
            }

            \DB::commit();
            // send initiator leave
            $email               = User::find($leave_request->StaffID)->email;
            $relief_office_email = User::find($leave_request->ReliefOfficerID)->email ?? null;

            Mail::to($email)->send(new LeaveRequestedInit($leave_request));
            return redirect()->route('LeaveDashBoard')->with('success', 'Leave request was added successfully');
        } catch (Exception $e) {
            \DB::rollback();
            return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
        }
    }

    public function leave_handover()
    {
        $leave_type = LeaveType::all();
        $staff      = Staff::all();
        // $staff      = Staff::where('CompanyID', $user->CompanyID)->get();
        $user           = \Auth::user();
        $id             = \Auth::user()->id;
        $department     = Department::all()->sortBy('Department');
        $handover_tasks = HandoverTask::orderBy('HandoverTaskRef', 'DESC')->get();
        return view('leave_request.handover', compact('leave_type', 'staff', 'id', 'user', 'department', 'handover_tasks'));
    }

    //Leave handover task method, IN PROGRESS!!!!!!
    public function handover_task(Request $request)
    {
        $handover_tasks = HandoverTask::orderBy('HandoverTaskRef', 'DESC');

        $leave_type = LeaveType::all();

        $staff = Staff::all();

        return view('leave_request.handover_task', compact('leave_type', 'staff', 'handover_tasks'));

    }

    //store handover task
    public function store_task(Request $request)
    {
        $handover_task = new HandoverTask($request->all());

        $handover_task->StaffID = auth()->user()->id;

        if ($handover_task->save()) {
            return response()->json($handover_task);
        }
    }

    //Delete travel request function
    public function destroy_task($id)
    {
        // $handover_task = Handovertask::find($id);

        $handover_task = Handovertask::where('HandoverTaskRef', $id)->firstOrFail();
        // dd($handover_task);

        $handover_task->delete();

        return redirect()->back()->with('success', 'Task Deleted successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $leave_request = LeaveRequest::where('LeaveReqRef', $id)->first();
        // dd($leave_request);
        $id         = \Auth::user()->id;
        $leave_type = LeaveType::all();
        $department = Department::all()->sortBy('Department');

        $user  = \Auth::user();
        $id    = \Auth::user()->id;
        $staff = Staff::where('CompanyID', $user->CompanyID)->get();
        return view('leave_request.edit', compact('leave_request', 'staff', 'id', 'user', 'department', 'leave_type'));
    }

    public function update(Request $request, $id)
    {
        $leave_request = LeaveRequest::where('LeaveReqRef', $id)->first();
        if ($request->hasFile('HandOverNote')) {
            $start_date     = $request->StartDate;
            $converted_date = (int) $request->NumberofDays;
            // $drpartment                  = (int) $request->
            $completion_Date             = Carbon::parse($start_date)->addDays($converted_date);
            $leave_request->ReturnDate   = $completion_Date;
            $filenamewithextension       = $request->file('HandOverNote')->getClientOriginalName();
            $filename                    = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension                   = $request->file('HandOverNote')->getClientOriginalExtension();
            $filenametostore             = str_slug($filename) . time() . '.' . $extension;
            $saveFile                    = $request->file('HandOverNote')->storeAs('public/leave_document', $filenametostore);
            $leave_request->HandOverNote = $filenametostore;
            $leave_request->ReturnDate   = $request->ReturnDate;
            $leave_request->SupervisorID = auth()->user()->staff->SupervisorID;
            foreach ($request->HandOverNoteRef as $key => $value) {

                // if ($saved) {
                $hon = HandOverNote::find($value);

                $hon->update([
                    'LeaveRequestID' => $leave_request->LeaveReqRef,

                    'Task'           => $request->Task[$key] ?? null,
                    'CompletionDate' => Carbon::parse($request->HonCompletionDate[$key]) ?? null,
                    'Description'    => $request->Description[$key] ?? null,
                ]);
                // }
            }
        } else {
            $start_date     = $request->StartDate;
            $converted_date = (int) $request->NumberofDays;
            // $drpartment                  = (int) $request->
            $completion_Date           = Carbon::parse($start_date)->addDays($converted_date);
            $leave_request->ReturnDate = $completion_Date;

            $leave_request->ReturnDate   = $request->ReturnDate;
            $leave_request->SupervisorID = auth()->user()->staff->SupervisorID;
        }
        foreach ($request->HandOverNoteRef as $key => $value) {

            // if ($saved) {
            $hon = HandOverNote::find($key);
            // dd($hon);

            $hon->update([
                'LeaveRequestID' => $leave_request->LeaveReqRef,

                'Task'           => $request->Task[$key] ?? null,
                'CompletionDate' => Carbon::parse($request->HonCompletionDate[$key]) ?? null,
                'Description'    => $request->Description[$key] ?? null,
            ]);
            // }
        }
        if ($leave_request->update($request->except(['HandOverNote', 'HandOverNoteRef', 'Task', 'HonCompletionDate', 'Description']))) {
            return redirect()->route('LeaveDashBoard')->with('success' . 'Update was successful');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        //
    }

    public function create_leave_handover()
    {
        $leave_habdover = LeaveRequest::find($id);
        $leave_request  = LeaveRequesr::Where('');
    }

    public function fetch_leave_hons($leave_ref)
    {
        $hons = HandOverNote::where('LeaveRequestID', $leave_ref)->get();
        return $hons;
    }

    public function leave_type()
    {
        $leavetypes = LeaveType::Orderby('LeaveTypeRef', 'DESC')->get();
        return view('leave_request.leave_type', compact('leavetypes'));
    }

    public function store_leavetype(Request $request)
    {
        $leavetype = new LeaveType($request->all());

        if ($leavetype->save()) {
            $data = [
                'status'  => 'success',
                'message' => 'Leave Type was created successfully!',
            ];
        } else {
            $data = [
                'status'  => 'error',
                'message' => 'Leave Type creation was not successful!',
            ];
        }

        return redirect()->route('StoreLeaveType')->with($data['status'], $data['message']);
    }

    public function edit_leave_type($id)
    {
        $leavetype = LeaveType::where("LeaveTypeRef", $id)->first();

        return response()->json($leavetype);
    }

    public function update_leave_type(Request $request)
    {
        $leavetype = LeaveType::find($request->LeaveTypeRef);

        $leavetype->update($request->except(['_token']));

        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function delete_leave_type($id)
    {
        $leavetype = LeaveType::where("LeaveTypeRef", $id);

        $leavetype->delete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }
}
