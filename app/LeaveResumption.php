<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use MESL\Mail\NotifyLeaveResumptionReply;
use MESL\Mail\NotifyLeaveResumption;
use MESL\User;
use MESL\Staff;
use MESL\Department;
use MESL\DB;
use Auth;

class LeaveResumption extends Model
{
    /*
    |-----------------------------------------
    | ALL LEAVE RESUMPTION DATE
    |-----------------------------------------
    */
    public static function allLeaveResumption(){
    	// body
    	$all_leave_resumption_request = LeaveResumption::where("staff_id", Auth::user()->id)->orderBy("id", "ASC")->get();
        if(count($all_leave_resumption_request) > 0){
            $lr_box = [];
            foreach ($all_leave_resumption_request as $lr) {
                $super_data = User::where('id', $lr->supervisor_id)->first();
                $staff_data = User::where('id', $lr->staff_id)->first();
                $department = Department::where('DepartmentRef', $lr->department_id)->first();

                $first_approver = User::where('id', $lr->first_approver_id)->first();
                $second_approver = User::where('id', $lr->second_approver_id)->first();
                $third_approver = User::where('id', $lr->third_approver_id)->first();

                $data = [
                    'id'                => $lr->id,
                    'employee_name'     => ucfirst($staff_data->first_name).' '.ucfirst($staff_data->last_name),
                    'supervisor_name'   => ucfirst($super_data->first_name).' '.ucfirst($super_data->last_name),
                    'department_name'   => ucfirst($department->Department),
                    'late_resume_info'  => $lr->reason_for_resumption,
                    'supervisor_remark' => $lr->supervisor_remark,
                    'is_final_approved' => $lr->is_approved,
                    'first_approver'    => ucfirst($first_approver->first_name).' '.ucfirst($first_approver->last_name) ?? '-',
                    'first_approver_status' => $lr->first_approver_status,
                    'second_approver'    => ucfirst($second_approver->first_name).' '.ucfirst($second_approver->last_name) ?? '-',
                    'second_approver_status' => $lr->second_approver_status,
                    'third_approver'    => ucfirst($third_approver->first_name).' '.ucfirst($third_approver->last_name) ?? '-',
                    'third_approver_status' => $lr->third_approver_status,
                    'date'              => $lr->created_at->toDateTimeString()
                ];

                array_push($lr_box, $data);
            }
        }else{
            $lr_box = [];
        }

    	// return.
    	return $lr_box;
    }

    /*
    |-----------------------------------------
    | ALL LEAVE RESUMPTION DATE
    |-----------------------------------------
    */
    public static function allMyApprovalRequest(){
        // body
        $all_leave_resumption_request = LeaveResumption::where([
            ["first_approver_id", Auth::user()->id],
            ["first_approver_status", false]
        ])
        ->orWhere([
            ["second_approver_id", Auth::user()->id],
            ["second_approver_status", false]
        ])
        ->orWhere([
            ["third_approver_id", Auth::user()->id],
            ["third_approver_status", false]
        ])
        ->orderBy("id", "ASC")->get();

        if(count($all_leave_resumption_request) > 0){
            $lr_box = [];
            foreach ($all_leave_resumption_request as $lr) {
                $super_data = User::where('id', $lr->supervisor_id)->first();
                $staff_data = User::where('id', $lr->staff_id)->first();
                $department = Department::where('DepartmentRef', $lr->department_id)->first();

                $first_approver = User::where('id', $lr->first_approver_id)->first();
                $second_approver = User::where('id', $lr->second_approver_id)->first();
                $third_approver = User::where('id', $lr->third_approver_id)->first();

                $data = [
                    'id'                => $lr->id,
                    'employee_name'     => ucfirst($staff_data->first_name).' '.ucfirst($staff_data->last_name),
                    'supervisor_name'   => ucfirst($super_data->first_name).' '.ucfirst($super_data->last_name),
                    'department_name'   => ucfirst($department->Department),
                    'late_resume_info'  => $lr->reason_for_resumption,
                    'supervisor_remark' => $lr->supervisor_remark,
                    'is_final_approved' => $lr->is_approved,
                    'first_approver'    => ucfirst($first_approver->first_name).' '.ucfirst($first_approver->last_name),
                    'first_approver_status' => $lr->first_approver_status,
                    'second_approver'    => ucfirst($second_approver->first_name).' '.ucfirst($second_approver->last_name),
                    'second_approver_status' => $lr->second_approver_status,
                    'third_approver'    => ucfirst($third_approver->first_name).' '.ucfirst($third_approver->last_name),
                    'third_approver_status' => $lr->third_approver_status,
                    'date'              => $lr->created_at->toDateTimeString()
                ];

                array_push($lr_box, $data);
            }
        }else{
            $lr_box = [];
        }

        // return.
        return $lr_box;
    }

    /*
    |-----------------------------------------
    | CALCULATE STAFF LEAVE BALANCE
    |-----------------------------------------
    */
    public function getLeaveInfo($payload){
    	// body

        // check if staff has a leave request
        $already_requested = \DB::table('tblLeaveRequest')->where("StaffID", $payload->staff_id)->first();
        if($already_requested == null){
            $data = [
                'status'    => 'error',
                'message'   => 'No active leave request found!'
            ];
        }else{

            $relief_officer = User::where("id", $already_requested->ReliefOfficerID)->first();
            $employee_data  = User::where("id", $payload->staff_id)->first();
            $leavedays  	= Staff::where('UserID', $payload->staff_id)->first();
            $leave_used 	= \DB::table('tblLeaveTransaction')->where('StaffID', $payload->staff_id)->sum('DaysRequested');
            $remaining_days = $leavedays->LeaveDays - $leave_used;

            $data = [
                'employee_name' => ucfirst($employee_data->first_name).' '.ucfirst($employee_data->last_name),
                'employee_id' => $payload->staff_id,
            	'leave_days' => $leavedays->LeaveDays,
            	'leave_used' => $leave_used,
            	'leave_left' => $remaining_days,
                'start_date' => $already_requested->StartDate,
                'end_date'   => $already_requested->ReturnDate,
                'relief_officer' => $already_requested->ReliefOfficerID
            ];
        }

        // return
        return $data;
    }

    /*
    |-----------------------------------------
    | ADD NEW LEAVE RESUMPTION LETTER
    |-----------------------------------------
    */
    public function addLeaveResumption($payload){
    	// body
    	$this->staff_id 			= $payload->staff_id;
    	$this->department_id 		= $payload->department_id;
    	$this->office_id 			= $payload->office_id;
    	$this->supervisor_id 		= $payload->supervisor_id;
    	$this->leave_commernce_date = $payload->leave_commernce_date;
    	$this->leave_resume_date 	= $payload->leave_resume_date;
    	$this->leave_days_taken 	= $payload->leave_days_taken;
    	$this->leave_days_used 		= $payload->leave_days_used;
    	$this->leave_days_left 		= $payload->leave_days_left;
    	$this->date_resume 			= $payload->date_resume;
    	$this->reason_for_resumption = $payload->reason_for_resumption;
    	$this->supervisor_remark 	 = $payload->supervisor_remark;
        $this->first_approver_id        = $payload->supervisor_id;
        $this->first_approver_status    = false; // Supervisor 
        $this->second_approver_id       = $payload->riskmgt_id;
        $this->second_approver_status   = false; // Risk Management
        $this->third_approver_id        = $payload->hrmgt_id;
        $this->third_approver_status    = false; // HR Operations
    	$this->is_approved 			    = false;
    	if($this->save()){
    		$data = [
    			'status' 	=> 'success',
    			'message' 	=> 'Leave Resumption Sent!'
    		];

            $employee_data      = User::where("id", $payload->staff_id)->first();
            $first_approver     = User::where("id", $payload->supervisor_id)->first();

            $mail_data = [
                'employee_name' => ucfirst($employee_data->first_name).' '.ucfirst($employee_data->last_name),
                'approver_name' => ucfirst($first_approver->first_name).' '.ucfirst($first_approver->last_name),
                'approve_link'  => env("APP_URL").'/approve/leave/resumption/'.$this->id.'/'.$payload->supervisor_id
            ];

            // send to approvals
            $this->sendApprovalsMail($mail_data, $first_approver->email);
    	}else{
    		$data = [
    			'status' 	=> 'error',
    			'message' 	=> 'Error, Could not create leave resumption, try again!'
    		];
    	}

    	// return 
    	return $data;
    }

    /*
    |-----------------------------------------
    | UPDATE LEAVE RESUMPTION LETTER
    |-----------------------------------------
    */
    public function updateLeaveResumption($payload){
    	// body
    	$update_leave_resumption 						= LeaveResumption::find($payload->leave_resumption_id);
    	if($update_leave_resumption !== null){
    		$update_leave_resumption->staff_id 				= $payload->staff_id;
	    	$update_leave_resumption->department_id 		= $payload->department_id;
	    	$update_leave_resumption->office_id 			= $payload->office_id;
	    	$update_leave_resumption->supervisor_id 		= $payload->supervisor_id;
	    	$update_leave_resumption->department_id 		= $payload->department_id;
	    	$update_leave_resumption->leave_commernce_date 	= $payload->leave_commernce_date;
	    	$update_leave_resumption->leave_resume_date 	= $payload->leave_resume_date;
	    	$update_leave_resumption->leave_days_taken 		= $payload->leave_days_taken;
	    	$update_leave_resumption->leave_days_used 		= $payload->leave_days_used;
	    	$update_leave_resumption->leave_days_left 		= $payload->leave_days_left;
	    	$update_leave_resumption->date_resume 			= $payload->date_resume;
	    	$update_leave_resumption->reason_for_resumption = $payload->reason_for_resumption;
	    	$update_leave_resumption->supervisor_remark 	= $payload->supervisor_remark;
	    	$update_leave_resumption->is_approved 			= false;
	    	if($update_leave_resumption->update()){
	    		$data = [
	    			'status' 	=> 'success',
	    			'message' 	=> 'Updated!'
	    		];
	    	}else{
	    		$data = [
	    			'status' 	=> 'error',
	    			'message' 	=> 'Error, Could not update leave resumption, try again!'
	    		];
	    	}
    	}else{
    		$data = [
    			'status' 	=> 'error',
    			'message' 	=> 'Could not locate leave resumption data, try again!'
    		];
    	}

    	// return 
    	return $data;
    }

    /*
    |-----------------------------------------
    | DELETE LEAVE RESUMPTION
    |-----------------------------------------
    */
    public function deleteLeaveResumption($payload){
    	// body
    	$del_leave_resumption = LeaveResumption::find($payload->leave_resumption_id);
    	if($del_leave_resumption !== null){
    		if($del_leave_resumption->delete()){
    			$data = [
    				'status' 	=> 'success',
    				'message' 	=> 'Deleted!'
    			];
    		}else{
    			$data = [
	    			'status' 	=> 'error',
	    			'message' 	=> 'Error deleting leave resumption data, try again!'
	    		];
    		}
    	}else{
    		$data = [
    			'status' 	=> 'error',
    			'message' 	=> 'Could not locate data, because record was not be found!'
    		];
    	}

    	// return 
    	return $data;
    }

    /*
    |-----------------------------------------
    | SEND APPROVERS MAIL
    |-----------------------------------------
    */
    public function sendApprovalsMail($data, $email){
        // send mail notification
        \Mail::to($email)->send(new NotifyLeaveResumption($data));
    }

    /*
    |-----------------------------------------
    | SEND APPROVERS MAIL
    |-----------------------------------------
    */
    public function sendReplyApprovalsMail($data, $email){
        // send mail notification
        \Mail::to($email)->send(new NotifyLeaveResumptionReply($data));
    }

    /*
    |-----------------------------------------
    | APPROVE LEAVE RESUMPTION
    |-----------------------------------------
    */
    public function approveLeaveResumption($lrr_id, $approver_id){
        // body
        // check and unapprove leave resumption request
        $first_approver  = LeaveResumption::where([
            ["id", $lrr_id], 
            ["first_approver_id", $approver_id],
            ["first_approver_status", false]
        ])->first();
        $second_approver = LeaveResumption::where([
            ["id", $lrr_id], 
            ["second_approver_id", $approver_id],
            ["second_approver_status", false]
        ])->first();
        $third_approver  = LeaveResumption::where([
            ["id", $lrr_id], 
            ["third_approver_id", $approver_id],
            ["third_approver_status", false],
        ])->first();

        // All 3 Approvers
        if($first_approver !== null){
            // approve and send to next approver
            $approve_leave_resumption                           = LeaveResumption::find($first_approver->id);
            $approve_leave_resumption->first_approver_status    = true;
            if($approve_leave_resumption->update()){
                $data = [
                    'status'    => 'success',
                    'message'   => 'Leave Resumption Approved!'
                ];

                $employee_data  = User::where("id", $first_approver->staff_id)->first();
                $approver_data  = User::where("id", $first_approver->second_approver_id)->first();

                $mail_data = [
                    'employee_name' => ucfirst($employee_data->first_name).' '.ucfirst($employee_data->last_name),
                    'approver_name' => ucfirst($approver_data->first_name).' '.ucfirst($approver_data->last_name),
                    'approve_link'  => env("APP_URL").'/approve/leave/resumption/'.$lrr_id.'/'.$approver_data->id
                ];

                // send to approvals
                $this->sendApprovalsMail($mail_data, $approver_data->email);
            }
        }elseif($second_approver !== null){
            // approve and send to next approver
            $approve_leave_resumption                           = LeaveResumption::find($second_approver->id);
            $approve_leave_resumption->second_approver_status    = true;
            if($approve_leave_resumption->update()){
                $data = [
                    'status'    => 'success',
                    'message'   => 'Leave Resumption Approved!'
                ];

                $employee_data  = User::where("id", $second_approver->staff_id)->first();
                $approver_data  = User::where("id", $second_approver->third_approver_id)->first();

                $mail_data = [
                    'employee_name' => ucfirst($employee_data->first_name).' '.ucfirst($employee_data->last_name),
                    'approver_name' => ucfirst($approver_data->first_name).' '.ucfirst($approver_data->last_name),
                    'approve_link'  => env("APP_URL").'/approve/leave/resumption/'.$lrr_id.'/'.$approver_data->id
                ];

                // send to approvals
                $this->sendApprovalsMail($mail_data, $approver_data->email);
            }
        }elseif($third_approver !== null){
            // approve and send to next approver
            $approve_leave_resumption                           = LeaveResumption::find($third_approver->id);
            $approve_leave_resumption->third_approver_status    = true;
            $approve_leave_resumption->is_approved              = true;
            if($approve_leave_resumption->update()){
                $data = [
                    'status'    => 'success',
                    'message'   => 'Leave Resumption Approved!'
                ];

                $employee_data  = User::where("id", $third_approver->staff_id)->first();
                $mail_data = [
                    'employee_name' => ucfirst($employee_data->first_name).' '.ucfirst($employee_data->last_name)
                ];

                // send to approvals
                $this->sendReplyApprovalsMail($mail_data, $employee_data->email);
            }
        }else{
            $data = [
                'status'    => 'error',
                'message'   => 'Could not find Leave Resumption and Approvers, Try again!'
            ];
        }

        // return
        return $data;
    }
}
