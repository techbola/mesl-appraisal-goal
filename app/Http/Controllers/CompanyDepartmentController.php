<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\CompanyDepartment;

class CompanyDepartmentController extends Controller
{
    /*
    |-----------------------------------------
    | SHOW DEPARTMENT PAGE
    |-----------------------------------------
    */
    public function index(Request $request){
    	// body
        $departments = CompanyDepartment::getAll();
    	return view('company_department.index', compact('departments'));
    }

    /*
    |-----------------------------------------
    | CREATE DEPARTMENT
    |-----------------------------------------
    */
    public function create(Request $request){
    	// body
    	$department = new CompanyDepartment();
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
        $department = new CompanyDepartment();
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
        $department = new CompanyDepartment();
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
        $department = new CompanyDepartment();
        $data       = $department->loadOneDepartment($request);

        // return response.
        return response()->json($data);
    }
}
