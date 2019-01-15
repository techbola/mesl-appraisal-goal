<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use MESL\User;
use MESL\Staff;
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
    	$all_leave_resumption_request = LeaveResumption::orderBy("id", "ASC")->get();
        if(count($all_leave_resumption_request) > 0){
            $lr_box = [];
            foreach ($all_leave_resumption_request as $lr) {
                $super_data = User::where('id', $lr->supervisor_id)->first();
                $staff_data = User::where('id', $lr->staff_id)->first();
                $department = CompanyDepartment::where('id', $lr->department_id)->first();

                $data = [
                    'id'                => $lr->id,
                    'employee_name'     => ucfirst($staff_data->first_name).' '.ucfirst($staff_data->last_name),
                    'supervisor_name'   => ucfirst($super_data->first_name).' '.ucfirst($super_data->last_name),
                    'department_name'   => ucfirst($department->name),
                    'late_resume_info'  => $lr->reason_for_resumption || "None",
                    'supervisor_remark' => $lr->supervisor_remark || "None",
                    'is_approved'       => $lr->is_approved,
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
    	$this->supervisor_remark 	= $payload->supervisor_remark;
    	$this->is_approved 			= false;
    	if($this->save()){
    		$data = [
    			'status' 	=> 'success',
    			'message' 	=> 'Leave Resumption Sent!'
    		];
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
}
