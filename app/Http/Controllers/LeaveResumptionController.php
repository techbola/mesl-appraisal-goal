<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\CompanySupervisor;
use MESL\CompanyDepartment;
use MESL\CompanyOffice;
use MESL\LeaveResumption;
use MESL\User;
use MESL\Staff;
use MESL\DB;
use MESL\Mail\NotifyLeaveResumption;
use Auth;

class LeaveResumptionController extends Controller
{
    /*
    |-----------------------------------------
    | SHOW DEPARTMENT PAGE
    |-----------------------------------------
    */
    public function index(Request $request){
    	// body
        $leave_resumptions   = LeaveResumption::allLeaveResumption();
        $check_already_exist = LeaveResumption::where("staff_id", Auth::user()->id)->first();
        if($check_already_exist !== null){
            $create_btn = "0";
        }else{
            $create_btn = "1";
        }

        // check if staff has a pending approval
        $resumption_approval = LeaveResumption::allMyApprovalRequest();

    	return view('leave_resumption.index', compact('leave_resumptions', 'resumption_approval', 'create_btn'));
    }

    /*
    |-----------------------------------------
    | CREATE DEPARTMENT
    |-----------------------------------------
    */
    public function create(Request $request){
    	// body
    	$leave_resumption 	= new LeaveResumption();
        $data       		= $leave_resumption->addLeaveResumption($request);

        // return response.
        return response()->json($data);
    }

    /*
    |-----------------------------------------
    | UPDATE DEPARTMENT
    |-----------------------------------------
    */
    public function update(Request $request){
    	// body
        $leave_resumption 	= new LeaveResumption();
        $data       		= $leave_resumption->updateLeaveResumption($request);

        // return response.
        return response()->json($data);
    }

    /*
    |-----------------------------------------
    | DELETE DEPARTMENT
    |-----------------------------------------
    */
    public function delete(Request $request){
    	// body
        $leave_resumption 	= new LeaveResumption();
        $data       		= $leave_resumption->deleteLeaveResumption($request);

        // return response.
        return response()->json($data);
    }

    /*
    |-----------------------------------------
    | CREATE DEPARTMENT
    |-----------------------------------------
    */
    public function restore(Request $request){
    	// body
    	
    }

    /*
    |-----------------------------------------
    | LOAD ONE DEPARMENT
    |-----------------------------------------
    */
    public function loadOne(Request $request){
        // body
        $supervisor = new CompanySupervisor();
        $data       = $supervisor->loadOneSupervisor($request);

        // return response.
        return response()->json($data);
    }


    /*
    |-----------------------------------------
    | LOAD ALL STAFFS
    |-----------------------------------------
    */
    public function allStaffs(){
        // body
        $all_staffs = User::all();
        if(count($all_staffs) > 0){
            $staff_box = [];
            foreach ($all_staffs as $staff) {
                # code...
                $data = [
                    'id'    => $staff->id,
                    'text'  => ucfirst($staff->first_name).' '.ucfirst($staff->last_name)
                ];

                array_push($staff_box, $data);
            }
        }else{
            $staff_box = [];
        }

        // return response.
        return response()->json($staff_box);
    }

    /*
    |-----------------------------------------
    | ALL DEPARTMENT
    |-----------------------------------------
    */
    public function allDepartment(){
        // body
        $all_department = CompanyDepartment::where('is_deleted', false)->get();
        if(count($all_department) > 0){
            $department_box = [];
            foreach ($all_department as $department) {
                # code...
                $data = [
                    'id'    => $department->id,
                    'text'  => ucfirst($department->name)
                ];

                array_push($department_box, $data);
            }
        }else{
            $department_box = [];
        }

        // return response.
        return response()->json($department_box);
    }

    /*
    |-----------------------------------------
    | ALL OFFICE LOCATION
    |-----------------------------------------
    */
    public function officeLocation(){
        // body
        $all_offices = CompanyOffice::orderBy('name', 'ASC')->get();
        if(count($all_offices) > 0){
            $office_box = [];
            foreach ($all_offices as $office) {
                # code...
                $data = [
                    'id'    => $office->id,
                    'text'  => ucfirst($office->name)
                ];

                array_push($office_box, $data);
            }
        }else{
            $office_box = [];
        }

        // return response.
        return response()->json($office_box);
    }

    /*
    |-----------------------------------------
    | CALCULATE STAFF LEAVE
    |-----------------------------------------
    */
    public function calculateStaffLeave(Request $request){
    	// body
        $leave_resumption 	= new LeaveResumption();
        $data       		= $leave_resumption->getLeaveInfo($request);

        // return response.
        return response()->json($data);
    }

    /*
    |-----------------------------------------
    | DEPARTMENT SUPERVISOR
    |-----------------------------------------
    */
    public function departmentSupervisor(Request $request){
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
                    'id'    => $supervisor->staff_id,
                    'text'  => ucfirst($user->first_name).' '.ucfirst($user->last_name),
                    'deparment_id'      => $department->id,
                    'department_name'   => $department->name,
                ];
            }else{
                $data = [
                    'id'                => 0,
                    'text'              => 'No Supervisor Found!',
                    'deparment_id'      => $department->id,
                    'department_name'   => $department->name,
                ];
            }
        }

    	// return response.
    	return response()->json($data);
    }


    /*
    |-----------------------------------------
    | TEST NOTIFICATION MAIL
    |-----------------------------------------
    */
    public function testNotification(Request $request){
        // body
        
        $mail_data = [
            'employee_name' => 'John Wick',
            'approver_name' => 'Emeka Jude',
            'approve_link'  => env("APP_URL").'/approve/leave/resumption/83hdh37273jn'
        ];

        // send mail to approver 1
        \Mail::to('testapprover@gmail.com')->send(new NotifyLeaveResumption($mail_data));

        $data = [
            'status'    => 'success',
            'message'   => 'Mail sent!'
        ];

        // return response.
        return response()->json($data);
    }

    /*
    |-----------------------------------------
    | GET APPROVERS
    |-----------------------------------------
    */
    public function getApprovers(){
        // body
        $guess_hr = CompanyDepartment::where([['is_deleted', false], ['name', 'LIKE', '%HR%']])
                    ->orWhere([['is_deleted', false], ['name', 'LIKE', '%Human Resources%']])->first();
        $guess_rm = CompanyDepartment::where([['is_deleted', false], ['name', 'LIKE', '%Risk%']])
                    ->orWhere([['is_deleted', false], ['name', 'LIKE', '%Risk Management%']])->first();

        if($guess_hr !== null && $guess_rm !== null){
            $get_hr_supervisor = CompanySupervisor::where("department_id", $guess_hr->id)->first();
            $get_rm_supervisor = CompanySupervisor::where("department_id", $guess_rm->id)->first();

            if($get_hr_supervisor !== null && $get_rm_supervisor !== null){
                $data = [
                    'status'    => 'success',
                    'message'   => 'Data found!',
                    'riskmgt_id'=> $get_rm_supervisor->staff_id,
                    'hrmgt_id'  => $get_hr_supervisor->staff_id
                ];
            }else{
                $data = [
                    'status'    => 'error',
                    'message'   => 'Error, Department Supervisor are properly assigned!',
                    'riskmgt_id'=> 0,
                    'hrmgt_id'  => 0
                ];
            }
        }else{
            $data = [
                'status'    => 'error',
                'message'   => 'Resumption letter is currently not available, Department Supervisors not yet assigned',
                'riskmgt_id'=> 0,
                'hrmgt_id'  => 0
            ];
        }

        // return response.
        return response()->json($data, 200);
    }

    /*
    |-----------------------------------------
    | APPROVE LEAVE RESUMPTION
    |-----------------------------------------
    */
    public function approveLeaveResumption($id, $approver_id){
        // body
        $leave_resumption   = new LeaveResumption();
        $data               = $leave_resumption->approveLeaveResumption($id, $approver_id);

        // return response.
        return response()->json($data);
    }
}
