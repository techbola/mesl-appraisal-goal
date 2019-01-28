<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use MESL\CompanySupervisor;
use MESL\CompanyDepartment;
use MESL\IdentityCard;
use MESL\Staff;
use MESL\User;
use Image;
use Auth;
use DB;

class IdentityCard extends Model
{

    /*
    |-----------------------------------------
    | ALL CARD REQUST
    |-----------------------------------------
    */
    public static function allCardRequest(){
        // body
        $all_request = IdentityCard::where("staff_id", Auth::user()->id)->first();
        if($all_request !== null){
            // department name
            $department = CompanyDepartment::where("id", $all_request->department_id)->first();
            $approver = User::where("id", $all_request->first_approver_id)->first();

            $data = [
                'id'                    => $all_request->id,
                'staff_id'              => $all_request->staff_id,
                'department_id'         => $all_request->department_id,
                'department_name'       => $department->name,
                'passport_path'         => $all_request->passport_path,
                'expected_request_date' => $all_request->expected_request_date,
                'staff_id_number'       => $all_request->staff_id_number,
                'first_approver_id'     => $all_request->first_approver_id,
                'first_approver_name'   => $approver->first_name.' '.$approver->last_name,
                'first_approver_status' => $all_request->first_approver_status,
                'card_request_date'     => $all_request->created_at->toDateString()
            ];
        }else{
            $data = [];
        }

        // return 
        return collect($data);
    }

    /*
    |-----------------------------------------
    | CREATE NEW CARD REQUEST
    |-----------------------------------------
    */
    public function createNewCardRequest($request, $new_name){
    	$department_id 	= $request->department_id;
    	$staff_id 		= $request->staff_id;
    	$idcard_number  = $request->staff_id_number;
    	$expected_date  = $request->expected_request_date;
        $staff_id_number = $request->staff_id_number;

    	// reason for request
    	$reason_1 = $request->reason_1;
    	$reason_2 = $request->reason_2;
    	$reason_3 = $request->reason_3;

    	if($reason_1 == "on"){
    		$idcard_request_reason = "Lost or Stolen";
    	}elseif($reason_2 == "on"){
    		$idcard_request_reason = "Not received";
    	}elseif($reason_3 == "on"){
    		$idcard_number = "New Employee";
    	}

    	if($this->already_requested($staff_id)){
    		$data = [
    			'status' 	=> 'success',
    			'message' 	=> 'ID Card Request Already Sent, Contact the HR & IT Department for any delay!'
    		];
    	}else{
    		// get approver's office
    		$department = CompanyDepartment::where("name", "LIKE", "%HR%")
                        ->orWhere("name", "LIKE", "%Human Resources%")->first();
    		$approver = CompanySupervisor::where("department_id", $department->id)->first();

    		$this->staff_id 				= $staff_id;
    		$this->department_id 			= $department_id;
    		$this->passport_path 			= $new_name;
    		$this->expected_request_date 	= $expected_date;
            $this->staff_id_number          = $staff_id_number;
    		$this->first_approver_id 		= $approver->staff_id;
    		$this->first_approver_status 	= false;
    		if($this->save()){
    			$data = [
    				'status' 	=> 'success',
    				'message' 	=> 'ID Card Request Sent!'
    			];
    		}else{
    			$data = [
    				'status' 	=> 'error',
    				'message' 	=> 'Error sending ID Card Request, Try again!'
    			];
    		}
    	}

    	// return 
    	return $data;
    }

    /*
    |-----------------------------------------
    | CHECK IF ALREADY EXISTED
    |-----------------------------------------
    */
    public function already_requested($staff_id){
    	// body
    	$already_exist = IdentityCard::where("staff_id", $staff_id)->first();
    	if($already_exist == null){
    		return false;
    	}else{
    		return true;
    	}
    }
}