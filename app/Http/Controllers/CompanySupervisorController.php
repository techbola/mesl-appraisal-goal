<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\CompanySupervisor;
use MESL\CompanyDepartment;
use MESL\User;

class CompanySupervisorController extends Controller
{
    /*
    |-----------------------------------------
    | SHOW DEPARTMENT PAGE
    |-----------------------------------------
    */
    public function index(Request $request){
    	// body
        $supervisors = CompanySupervisor::where('is_deleted', false)->orderBy('id', 'DESC')->get();
        $departments = CompanyDepartment::where('is_deleted', false)->orderBy('id', 'DESC')->get();
        $assigned_supervisors = CompanySupervisor::allSupervisors();

    	return view('company_supervisor.index', compact('departments', 'supervisors', 'assigned_supervisors'));
    }

    /*
    |-----------------------------------------
    | CREATE DEPARTMENT
    |-----------------------------------------
    */
    public function create(Request $request){
    	// body
    	$department = new CompanySupervisor();
        $data       = $department->add($request);

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
    	// body
        $department = new CompanySupervisor();
        $data       = $department->updateOne($request);

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
        $department = new CompanySupervisor();
        $data       = $department->removeOne($request);

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
        $all_department = CompanyDepartment::get();
        if(count($all_department) > 0){
            $department_box = [];
            foreach ($all_department as $department) {
                # code...
                $data = [
                    'id'    => $department->DepartmentRef,
                    'text'  => ucfirst($department->Department)
                ];

                array_push($department_box, $data);
            }
        }else{
            $department_box = [];
        }

        // return response.
        return response()->json($department_box);
    }
}
