<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\CompanySupervisor;
use MESL\CompanyDepartment;
use MESL\IdentityCard;
use MESL\Staff;
use MESL\User;
use Auth;
use DB;

class IdentityCardController extends Controller
{
    /*
    |-----------------------------------------
    | SHOW VIEW INDEX
    |-----------------------------------------
    */
    public function index(){
    	// body
    	return view('identity_card.index');
    }
    
    /*
    |-----------------------------------------
    | LOAD SINGLE DATA
    |-----------------------------------------
    */
    public function loadOne(){
    	// body
    }
    
    /*
    |-----------------------------------------
    | LOAD ALL DATA
    |-----------------------------------------
    */
    public function loadAll(){
    	// body
    }
    
    /*
    |-----------------------------------------
    | CREATE DATA 
    |-----------------------------------------
    */
    public function create(Request $request){
    	
    	$identity_card 	= new IdentityCard();
    	$data 			= $identity_card->createNewCardRequest($request);

    	// return response.
    	return redirect()->back()->with($data["status"], $data["message"]);
    }
    
    /*
    |-----------------------------------------
    | UPDATE DATA
    |-----------------------------------------
    */
    public function update(){
    	// body
    }
    
    /*
    |-----------------------------------------
    | DELETE DATA
    |-----------------------------------------
    */
    public function delete(){
    	// body
    }

    /*
    |-----------------------------------------
    | GET DEPARTMENT
    |-----------------------------------------
    */
    public function departmentInfo(Request $request){
    	// body
        $staff = Staff::where("UserID", $request->staff_id)->first();
    	$supervisor = CompanySupervisor::where("department_id", $staff->DepartmentID)->first();
        $department = CompanyDepartment::where("id", $staff->DepartmentID)->first();
        if($department == null){
            $data = [
                'status'    => 'error',
                'message'   => 'Department not found!'
            ];
        }else{
            if($supervisor !== null){
                $user = User::where("id", $supervisor->staff_id)->first();
                $data = [
                    'id'    			=> $supervisor->staff_id,
                    'text'  			=> ucfirst($user->first_name).' '.ucfirst($user->last_name),
                    'department_id'     => $department->id,
                    'department_name'   => $department->name,
                ];
            }else{
                $data = [
                    'id'                => 0,
                    'text'              => 'No Supervisor Found!',
                    'department_id'     => $department->id,
                    'department_name'   => $department->name,
                ];
            }
        }

    	// return response.
    	return response()->json($data);
    }

    /*
    |-----------------------------------------
    | GET STAFF INFORMATION
    |-----------------------------------------
    */
    public function staffInfo(Request $request){
    	// body
        $user = User::where("id", $request->staff_id)->first();
        if($user == null){
            $data = [
                'status'    => 'error',
                'message'   => 'Staff information not found!'
            ];
        }else{
            $data = [
                'employee_id'    => $user->id,
                'employee_name'  => ucfirst($user->first_name).' '.ucfirst($user->last_name),
            ];
        }

    	// return response.
    	return response()->json($data);
    }
}
