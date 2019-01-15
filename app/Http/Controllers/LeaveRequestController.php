<?php

namespace MESL\Http\Controllers;


use MESL\LeaveType;
// use MESL\Mail\Leave;
use MESL\Staff;
use MESL\LeaveRequest;
use MESL\CompanyDepartment;
use MESL\Mail\LeaveRequest as LR;
use MESL\Mail\HRLeaveConfirmation;
use Carbon\Carbon;
use MESL\RestrictionDates;
use MESL\LeaveTransaction;
use MESL\LeaveApprover;
// use MESL\LeaveApprover;

// use MESL\LeaveType;
// use MESL\Mail\Leave;
// use MESL\Staff;
// use MESL\LeaveRequest;
// use Carbon\Carbon;
// use MESL\RestrictionDates;
// use MESL\LeaveTransaction;

use Illuminate\Http\Request;
use Mail;

class LeaveRequestController extends Controller
{
    public function dashboard()
    {
        $id             = \Auth::user()->id;
        $leave_requests = LeaveRequest::where('StaffID', $id)->get();
        $leavedays      = Staff::where('UserID', $id)->first();
        return view('leave_request.index', compact('leave_requests', 'leavedays'));
    }

    public function leave_request()
    {
        $leave_type = LeaveType::all();
        $user       = \Auth::user();
        $id         = \Auth::user()->id;
        $staff      = Staff::where('CompanyID', $user->CompanyID)->get();
        $leavedays  = Staff::where('UserID', $id)->first();
        $leave_used = \DB::table('tblLeaveTransaction')
            ->where('StaffID', $id)
            ->sum('DaysRequested');
        $remaining_days = $leavedays->LeaveDays - $leave_used;
        return view('leave_request.create', compact('leave_type', 'staff', 'id', 'leavedays', 'leave_used', 'remaining_days'));
    }

    public function leave_approval()
    {
        $id             = \Auth::user()->id;
        $leave_requests = \DB::table('tblLeaveRequest')
            ->join('tblLeaveType', 'tblLeaveRequest.AbsenceTypeID', '=', 'tblLeaveType.LeaveTypeRef')
            ->join('users', 'tblLeaveRequest.StaffID', '=', 'users.id')
            ->where('ApproverID', $id)
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
            $item->status = $events->count();
            return $item;
        });
        return view('leave_request.leave_approval', compact('leave_requests', 'leave_check'));
    }

    public function retrieve_details($start_date, $numberdays)
    {
        $trans = collect(\DB::select("EXEC procLeaveEndDate '$start_date', $numberdays"));
        return response()->json($trans->first())->setStatusCode(200);
    }

    public function leave_notification($elem_value)
    {
        if (!is_null($elem_value)) {
            $trans = \DB::table('tblLeaveRequest')
                ->where('leaveReqRef', $elem_value)
                ->update(['NotifyFlag' => 1, 'RejectionFlag' => '0']);

            if ($trans) {
                $details = \DB::table('tblLeaveRequest')
                    ->where('leaveReqRef', $elem_value)
                    ->first();

                if (!is_null($details->ApproverID) || $details->ApproverID > 0) {
                    $email = \DB::table('users')
                        ->select('email')
                        ->where('id', $details->ApproverID)
                        ->first();

                    $name = \DB::table('users')
                        ->select('first_name')
                        ->where('id', $details->ApproverID)
                        ->first();

                    Mail::to($email)->send(new LR($name));
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
                        $id              = \Auth::user()->id;

                        if (is_null($new_approver_id) || $new_approver_id == 0) {

                            if ($details->AbsenceTypeID == 1) {
                                $record                = new LeaveTransaction;
                                $record->StaffID       = $staff_id;
                                $record->DaysRequested = $leavedays;
                                $record->LeaveID       = $leave_id;
                                $record->save();
                            }

                            $update_leave = \DB::table('tblLeaveRequest')
                                ->where('leaveReqRef', $Ref)
                                ->update(['CompletedDate' => $current_time, 'CompletedFlag' => '1']);

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

                            Mail::to($email)->send(new LR($name));
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
                $start_date                  = $request->StartDate;
                $converted_date              = (int) $request->NumberofDays;
                $completion_Date             = Carbon::parse($start_date)->addDays($converted_date);
                $leave_request               = new LeaveRequest($request->all());
                $leave_request->ReturnDate   = $completion_Date;
                $filenamewithextension       = $request->file('HandOverNote')->getClientOriginalName();
                $filename                    = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension                   = $request->file('HandOverNote')->getClientOriginalExtension();
                $filenametostore             = str_slug($filename) . time() . '.' . $extension;
                $saveFile                    = $request->file('HandOverNote')->storeAs('public/leave_document', $filenametostore);
                $leave_request->HandOverNote = $filenametostore;
                $leave_request->ReturnDate   = $completion_Date;
                $leave_request->save();
            } else {
                $start_date                = $request->StartDate;
                $converted_date            = (int) $request->NumberofDays;
                $completion_Date           = Carbon::parse($start_date)->addDays($converted_date);
                $leave_request             = new LeaveRequest($request->all());
                $leave_request->ReturnDate = $completion_Date;
                $leave_request->save();
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
        $user       = \Auth::user();
        $id         = \Auth::user()->id;
        $department = CompanyDepartment::all();
        return view('leave_request.handover', compact('leave_type', 'staff', 'id', 'user', 'department'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function create_leave_handover()
    {
        $leave_habdover = LeaveRequest::find($id);
        $leave_request = LeaveRequesr::Where('');
    }
}
