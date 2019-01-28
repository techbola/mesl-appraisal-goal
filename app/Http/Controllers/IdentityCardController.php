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
        $all_idcard_request = IdentityCard::allCardRequest();

    	return view('identity_card.index', compact('all_idcard_request'));
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
        $passport_image = $request->file("card_passport");
        $this->validate($request, [
            'card_passport' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $staff_data = User::where("id", $request->staff_id)->first();
        $store_path = public_path('images/passport_images/');
        $new_name   = strtolower($staff_data->first_name).'-'.time().'.'.$passport_image->getClientOriginalExtension();
        $passport_image->move($store_path, $new_name);

        $identity_card  = new IdentityCard();
        $data           = $identity_card->createNewCardRequest($request, $new_name);
    

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