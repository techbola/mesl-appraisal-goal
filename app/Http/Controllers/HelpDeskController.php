<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use MESL\Location;
use MESL\Complaint;
use MESL\Customer;
use MESL\BuildingProject;
use MESL\Department;
use MESL\ComplaintComment;
use MESL\ComplaintAttachment;
use MESL\Staff;
use MESL\CompanyOffice;
use MESL\CompanyDepartment;

class HelpDeskController extends Controller
{
    /*
    |-----------------------------------------
    | INDEX
    |-----------------------------------------
    */
    public function index(){
    	// body
    	$clients    	= Customer::all();
        $complaints 	= Complaint::all();
        $comments   	= ComplaintComment::all();
        $departments 	= CompanyDepartment::get();
        

        $staff  = auth()->user()->staff;
        $_depts = Staff::where('StaffRef', $staff->StaffRef)->get(['DepartmentID'])->first();
        $depts  = explode(',', $_depts->DepartmentID);
        $my_departments         = Department::whereIn('DepartmentRef', $depts)->get();

        $complaint_sent_to_dept = Complaint::whereIn('current_queue', $depts)->get();
        $complaint_discussions  = Complaint::whereIn('current_queue', $depts)->get();
        $locations 				= CompanyOffice::get();

    	return view('help_desk.index', compact('locations', 'clients', '_depts', 'depts', 'complaints', 'departments', 'comments', 'complaint_sent_to_dept'));
    }
}
