<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use MESL\Staff;

class CompanyDepartment extends Model
{

	/*
	|-----------------------------------------
	| LOAD ONE DEPARMENT
	|-----------------------------------------
	*/
	public function loadOneDepartment($payload){
		// body
		$data = CompanyDepartment::where("id", $payload->department_id)->first();

		// return
		return $data;
	}

    /*
    |-----------------------------------------
    | GET ALL DEPARTMENT
    |-----------------------------------------
    */
    public static function getAll(){
        // body
        $all_departments = CompanyDepartment::where('is_deleted', false)->orderBy('id', 'ASC')->get();
        if(count($all_departments) > 0){
            $department_box = [];
            foreach ($all_departments as $department) {
                // get department members id

                $total_employees = Staff::where("DepartmentID", $department->id)->count();

                $data = [
                    'id'                => $department->id,
                    'name'              => $department->name,
                    'total_employee'    => number_format($total_employees)
                ];

                array_push($department_box, $data);
            }
        }else{
            $department_box = [];
        }

        // return 
        return $department_box;
    }


    /*
    |-----------------------------------------
    | CREATE DEPARTMENT
    |-----------------------------------------
    */
    public function add($payload){

    	// check if already exist
    	$already_exist = CompanyDepartment::where("name", $payload->department)->first();
    	if($already_exist == null){
    		// body
	    	$this->name 		= $payload->department;
	    	$this->is_deleted 	= false;
	    	if($this->save()){
	    		$data = [
	    			'status' 	=> 'success',
	    			'message' 	=> $payload->department.' created!'
	    		];
	    	}else{
	    		$data = [
	    			'status' 	=> 'error',
	    			'message' 	=> 'Fail to create new department!'
	    		];
	    	}
    	}else{
    		$data = [
    			'status' 	=> 'error',
    			'message' 	=> $payload->department.' already exist!'
    		];
    	}

    	// return 
    	return $data;
    }

    /*
    |-----------------------------------------
    | UPDATE DEPARTMENT
    |-----------------------------------------
    */
    public function updateOne($payload){
    	// body
    	$update_department 				= CompanyDepartment::find($payload->department_id);
    	if($update_department !== null){
    		$update_department->name 		= $payload->department_name;
	    	$update_department->is_deleted 	= false;
	    	if($update_department->update()){
	    		$data = [
	    			'status' 	=> 'success',
	    			'message' 	=> $payload->department_name.' updated!'
	    		];
	    	}else{
	    		$data = [
	    			'status' 	=> 'error',
	    			'message' 	=> 'Fail to update department!'
	    		];
	    	}
    	}else{
    		$data = [
    			'status' 	=> 'error',
    			'message' 	=> 'Failed to update, Try again'
    		];
    	}

    	// return 
    	return $data;
    }

    /*
    |-----------------------------------------
    | DELETE DEPARTMENT
    |-----------------------------------------
    */
    public function removeOne($payload){
    	// body
    	$remove_department 				= CompanyDepartment::find($payload->department_id);
    	$remove_department->is_deleted 	= true;
    	if($remove_department->update()){
    		$data = [
    			'status' 	=> 'success',
    			'message' 	=> 'Department deleted!'
    		];
    	}else{
    		$data = [
    			'status' 	=> 'error',
    			'message' 	=> 'Fail to delete department!'
    		];
    	}

    	// return 
    	return $data;
    }

    /*
    |-----------------------------------------
    | RESTORE ALL DEPARTMENT
    |-----------------------------------------
    */
    public function restoreAll($payload){
    	// body
    	$restore_all = CompanyDepartment::where('is_deleted', true)->get();
    	if(count($restore_all) > 0){
    		$total_no = 0;
			foreach ($restore_all as $department) {
	    		# code...
	    		$this->restoreOne($department);
	    		$total_no++;
	    	}
	    	$data = [
				'status' => 'success',
				'message' => $total_no.' data was restored'
			];
    	}else{
    		$data = [
	    		'status' 	=> 'success',
	    		'message' 	=> 'No data was restored'
	    	];
    	}

    	// return
    	return $data;
    }

    /*
    |-----------------------------------------
    | RESTORE ONE DEPARTMENT
    |-----------------------------------------
    */
    public function restoreOne($payload){
    	// body
    	$restore_one 				= CompanyDepartment::find($payload->id);
    	$restore_one->is_deleted 	= false;
    	if($restore_one->update()){
    		$data = [
    			'status' 	=> 'success',
    			'message' 	=> 'Data restored!'
    		];
    	}else{
    		$data = [
    			'status' 	=> 'error',
    			'message' 	=> 'Fail to restore data!'
    		];
    	}

    	// return 
    	return $data;
	}

	public function staff_department()
	{
		return $this->belongsTo('MESL\Staff', 'DepartmentID');
	}
	
}
