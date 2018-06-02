<?php

namespace Cavidel\Http\Controllers;
use Cavidel\LeaveType;
use Cavidel\Staff;
use Cavidel\LeaveRequest;
use Carbon\Carbon;
use Cavidel\LeaveTransaction;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function dashboard()
    {
        $id = \Auth::user()->id;
        $leave_requests = LeaveRequest::where('StaffID', $id)->get();
        $leavedays = Staff::where('UserID', $id)->first();
        return view('leave_request.index', compact('leave_requests', 'leavedays'));
    }

    public function leave_request()
    {
        $leave_type = LeaveType::all();
        $user = \Auth::user();
        $id = \Auth::user()->id;
        $staff = Staff::where('CompanyID', $user->CompanyID)->get();
        $leavedays = Staff::where('UserID', $id)->first();
        $leave_used = \DB::table('tblLeaveTransaction')
        ->where('StaffID', $id)
        ->sum('DaysRequested');
        $remaining_days = $leavedays->LeaveDays - $leave_used;
        return view('leave_request.create', compact('leave_type', 'staff', 'id', 'leavedays', 'leave_used', 'remaining_days'));
    }

    public function leave_approval()
    {
        $id = \Auth::user()->id;
        $leave_requests = \DB::table('tblLeaveRequest')
        ->join('tblLeaveType', 'tblLeaveRequest.AbsenceTypeID', '=', 'tblLeaveType.LeaveTypeRef' )
        ->join('users','tblLeaveRequest.StaffID', '=', 'users.id')
        ->where('ApproverID', $id)
        ->where('NotifyFlag', 1)
        ->get();
        return view('leave_request.leave_approval', compact('leave_requests'));
    }

    public function retrieve_details($start_date, $numberdays)
    {
        $trans =  collect(\DB::select("EXEC procLeaveEndDate '$start_date', $numberdays"));
         return response()->json($trans->first())->setStatusCode(200);
    }

    public function leave_notification($elem_value)
    {
        if(!is_null($elem_value))
        {
            $trans = \DB::table('tblLeaveRequest')
            ->where('leaveReqRef', $elem_value)
            ->update(['NotifyFlag' => 1, 'RejectionFlag' => '0']);

            if($trans){
                return $trans;
            }
        }else{
            return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
        }
    }

    public function approve_leave_request(Request $request)
    {
        if($request->input('approve'))
              {
                 try{
                     \DB::beginTransaction();
                        foreach($request->LeaveRef as $Ref) 
                          { 
                            $details = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                            $current_time = Carbon::now(); 
                           
                            $module_id = 3;
                            $comment = "Approved";
                            $approver_id =$details->ApproverID;
                            $flag = 1;
                            $approve = \DB::statement("EXEC procApproveRequest '$current_time', '$Ref', $module_id, '$comment', $approver_id, $flag");

                            if($approve)
                            {
                                $trans = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                                $new_approver_id = $trans->ApproverID;
                                $leavedays = $trans->NumberofDays;
                                $leave_id = $trans->LeaveReqRef;
                                $staff_id = $trans->StaffID;
                                $id = \Auth::user()->id;
                                if(is_null($new_approver_id) || $new_approver_id == 0)
                                {
                                    $record = new LeaveTransaction;
                                    $record->StaffID = $staff_id;
                                    $record->DaysRequested = $leavedays;
                                    $record->LeaveID = $leave_id;
                                    $record->save();

                                    $update_leave = \DB::table('tblLeaveRequest')
                                        ->where('leaveReqRef', $Ref)
                                        ->update(['CompletedDate' => $current_time, 'CompletedFlag' => '1']);
                                }
                            }
                          }
                     \DB::commit();
                        return redirect()->route('LeaveDashBoard')->with('success', 'Leave Request was added successfully');
                    }catch(Exception $e)
                      {
                         \DB::rollback();
                          return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
                       } 
                }elseif($request->input('reject'))
                {
                     try{
                     \DB::beginTransaction();
                        foreach($request->LeaveRef as $Ref) 
                          { 
                            $details = LeaveRequest::where('LeaveReqRef', $Ref)->first();
                            $approver_id1 = $details->ApproverID1;
                            $current_time = Carbon::now();
                            $comment = "You Can't Leave Now work Still To be done";
                            $reject_trans = \DB::table('tblLeaveRequest')
                                            ->where('leaveReqRef', $Ref)
                                            ->update(['NotifyFlag' => 0, 'RejectionFlag' => 1, 'RejectionDate' => $current_time, 'RejectionComment' => $comment, 'ApprovedFlag' => 0]);
                          }
                     \DB::commit();
                        return redirect()->route('LeaveDashBoard')->with('success', 'Leave Request was added successfully');
                    }catch(Exception $e)
                      {
                         \DB::rollback();
                          return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
                       } 
                }
    }

    public function store_leave_request(Request $request)
    {
                try{
                     \DB::beginTransaction();

                          if($request->hasFile('HandOverNote'))
                          {
                            $start_date = $request->StartDate;
                            $converted_date = (int)$request->NumberofDays;
                            $completion_Date = Carbon::parse($start_date)->addDays($converted_date);
                            $leave_request = new LeaveRequest($request->all());
                            $filenamewithextension = $request->file('HandOverNote')->getClientOriginalName();
                            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                            $extension = $request->file('HandOverNote')->getClientOriginalExtension();
                            $filenametostore = str_slug($filename).time().'.'.$extension;
                            $saveFile = $request->file('HandOverNote')->storeAs('LeaveDocument', $filenametostore);
                            $leave_request->HandOverNote = $filenametostore;
                            $leave_request->ReturnDate = $completion_Date;
                            $leave_request->save();
                          }else
                          {
                            $start_date = $request->StartDate;
                            $converted_date = (int)$request->NumberofDays;
                            $completion_Date = Carbon::parse($start_date)->addDays($converted_date);
                            $leave_request = new LeaveRequest($request->all());
                            $leave_request->ReturnDate = $completion_Date;
                            $leave_request->save();
                          }
                     \DB::commit();
                        return redirect()->route('LeaveDashBoard')->with('success', 'Leave Request was added successfully');
                    }catch(Exception $e)
                      {
                         \DB::rollback();
                          return redirect()->back()->withinput()->with('error', 'Error encountered while trying to do the action');
                       } 
    }
}
