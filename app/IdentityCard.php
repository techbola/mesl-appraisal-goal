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
    | CREATE NEW CARD REQUEST
    |-----------------------------------------
    */
    public function addNewCardRequest($payload){
    	// body
    	$passport_image = $request->file("card_passport");
    	$department_id 	= $request->department_id;
    	$staff_id 		= $request->staff_id;
    	$idcard_number  = $request->staff_id_number;
    	$expected_date  = $request->expected_request_date;

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
    		// add new request
    		$passport_path = $this->uploadCardPassport($passport_image, $staff_id);

    		// get approver's office
    		$department = CompanyDepartment::where("name", "LIKE", "%HR%")->orWhere("name", "LIKE", "%Human Resources%")->first();
    		$approver = CompanySupervisor::where("department_id", $department->id)->first();

    		$this->staff_id 				= $staff_id;
    		$this->department_id 			= $department_id;
    		$this->passport_path 			= $passport_path;
    		$this->expected_request_date 	= $expected_date;
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

    /*
    |-----------------------------------------
    | HANDLE PASSPORT UPLOAD
    |-----------------------------------------
    */
    public function uploadCardPassport($staff_id, $passport_image){
    	// body


    	$new_passport_name = "";

    	$passport_store_path = public_path('images/passport_images/');

    	// return new passport name
    	return $new_passport_name;
    }
}
