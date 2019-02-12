<?php

namespace MESL\Http\Controllers;

use MESL\LeaveType;
// use MESL\Mail\Leave;
use MESL\Staff;
use MESL\User;
use MESL\LeaveRequest;
use MESL\Department;
use MESL\Mail\LeaveRequest as LR;
use MESL\Mail\HRLeaveConfirmation;
use MESL\Mail\FinalHRLeaveConfirmation;
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
        }

        $leave_used = collect(\DB::table('tblLeaveTransaction')
                ->where('StaffID', $id)->where('LeaveTypeID', $leave_type_id)->get())
            ->sum('DaysRequested');
        $leave_remaining_days = $leave_days - $leave_used;
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

        //$leave_days=$leavedays->SickLeaveDays;

        $leave_used = \DB::table('tblLeaveTransaction')
            ->where('StaffID', $id)
            ->sum('DaysRequested');
        $remaining_days = $leavedays->LeaveDays - $leave_used;
        return view('leave_request.create', compact('leave_type', 'unsent_request', 'staff', 'id', 'leavedays', 'leave_used', 'remaining_days', 'department', 'leave_days'));
    }

    public function leave_approval()
    {
        $id             = \Auth::user()->id;
        $leave_requests = \DB::table('tblLeaveRequest')
            ->join('tblLeaveType', 'tblLeaveRequest.AbsenceTypeID', '=', 'tblLeaveType.LeaveTypeRef')
        // ->join('tblHandOver', 'tblLeaveRequest.LeaveReqRef', '=', 'tblHandOver.LeaveRequestID')
            ->join('users', 'tblLeaveRequest.StaffID', '=', 'users.id')
            ->where('ApproverID', auth()->user()->staff->StaffRef)
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
        // dd($leave_check);
        return view('leave_request.leave_approval', compact('leave_requests', 'leave_check'));
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

                if (!is_null($details->ApproverID) || $details->ApproverID > 0) {
                    $email = \DB::table('users')
                        ->select('email')
                        ->where('id', Staff::find($details->ApproverID)->user->id)
                        ->first();

                    $name = \DB::table('users')
                        ->select('first_name')
                        ->where('id', Staff::find($details->ApproverID)->user->id)
                        ->first();

                    // return ($leave_request);
                    Mail::to($email)->send(new LR($name, $details));
                }
                return redirect()->route('LeaveDashBoard')->with('success', 'Leave Request was added successfully');
            }
        } else {
            return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
        }
    }

    public function approve_leave_request(Request $request, LeaveApprover $get_approvers)
    {
        if ($request->input('approve')) {
            try {
                \DB::beginTransaction();
                foreach ($request->LeaveRef as $Ref) {
                    $details      = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $current_time = Carbon::now();

                    $module_id   = 3;
                    $comment     = "Approved";
                    $approver_id = $details->ApproverID;
                    $flag        = 1;
                    $approve     = \DB::statement("EXEC procApproveRequest '$current_time', '$Ref', $module_id, '$comment', $approver_id, $flag");

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

                                Mail::to($email)->send(new HRLeaveConfirmation($name));
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

                            Mail::to($email)->send(new LR($name, $details));
                        }
                    }
                }
                \DB::commit();
                return redirect()->route('LeaveApproval')->with('success', 'Leave Request was added successfully');
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
                    $leave_request = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $email         = \DB::table('users')
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
                return redirect()->route('LeaveDashBoard')->with('success', 'Leave Request was added successfully');
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
                foreach ($request->LeaveRef as $Ref) {
                    $details      = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $current_time = Carbon::now();

                    $module_id   = 3;
                    $comment     = "Approved";
                    $approver_id = auth()->user()->id;
                    $flag        = 1;
                    $approve     = \DB::statement("EXEC procApproveRequest '$current_time', '$Ref', $module_id, '$comment', $approver_id, $flag");

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

                            $name  = $leave_requester;
                            $email = $leave_requester->email;

                            Mail::to($email)->send(new FinalHRLeaveConfirmation($name));

                        }

                    }
                }
                \DB::commit();
                return redirect()->route('HrLeaveApproval')->with('success', 'Leave Request was added successfully');
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

                    $leave_request = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                    $email         = \DB::table('users')
                        ->select('email')
                        ->where('id', $leave_request->StaffID)
                        ->first();

                    $name = \DB::table('users')
                        ->select('first_name')
                        ->where('id', $leave_request->StaffID)
                        ->first();
                    if (!is_null($leave_request->ReliefOfficerID)) {
                        $relief_officer_email == \DB::table('users')
                            ->select('email')
                            ->where('id', (int) $leave_request->ReliefOfficerID)
                            ->first();

                        $relief_officer_name = \DB::table('users')
                            ->select('first_name')
                            ->where('id', (int) $leave_request->ReliefOfficerID)
                            ->first();

                        Mail::to($relief_officer_email)->send(new LR($relief_officer_name, $leave_request));
                    }
                    Mail::to($email)->send(new LR($name, $leave_request));
                }
                \DB::commit();
                return redirect()->route('LeaveDashBoard')->with('success', 'Leave Request was added successfully');
            } catch (Exception $e) {
                \DB::rollback();
                return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
            }
        }
    }

    public function store_leave_request(Request $request)
    {
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
            return redirect()->route('LeaveDashBoard')->with('success', 'Leave Request was added successfully');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
