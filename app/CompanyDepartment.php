<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use MESL\Staff;
use DB;

class CompanyDepartment extends Model
{
    /*
    |-----------------------------------------
    | CONVERT DEPT MODEL TO EXISTING TABLE
    |-----------------------------------------
    */
    protected $table      = 'tblDepartment';
    protected $guarded    = ['DepartmentRef'];
    protected $primaryKey = 'DepartmentRef';
    public $timestamps    = false;

    /*
    |-----------------------------------------
    | BOOT MODEL TO DB TABLE
    |-----------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('Department', function (Builder $builder) {
            $builder->orderBy('Department');
        });
    }

    /*
    |-----------------------------------------
    | LOAD ONE DEPARMENT
    |-----------------------------------------
    */
    public function loadOneDepartment($payload)
    {
        // body
        $data = CompanyDepartment::where("DepartmentRef", $payload->department_id)->first();

        // return
        return $data;
    }

    /*
    |-----------------------------------------
    | GET ALL DEPARTMENT
    |-----------------------------------------
    */
    public static function getAll()
    {
        // body
        $all_departments = CompanyDepartment::orderBy('DepartmentRef', 'ASC')->get();
        if (count($all_departments) > 0) {
            $department_box = [];
            foreach ($all_departments as $department) {
                // get department members id

                // $total_employees = Staff::whereIn("DepartmentID", $department->id)->count();

                $total_employees = Staff::whereRaw("CONCAT(',',DepartmentID,',') LIKE CONCAT('%,'," . $department->DepartmentRef . ",',%')")->count();

                $data = [
                    'id'             => $department->DepartmentRef,
                    'name'           => $department->Department,
                    'total_employee' => number_format($total_employees),
                ];

                array_push($department_box, $data);
            }
        } else {
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
    public function add($payload)
    {

        // check if already exist
        $already_exist = CompanyDepartment::where("Department", $payload->department)->first();
        if ($already_exist == null) {
            // body
            $this->Department = $payload->department;
            if ($this->save()) {
                $data = [
                    'status'  => 'success',
                    'message' => $payload->department . ' created!',
                ];
            } else {
                $data = [
                    'status'  => 'error',
                    'message' => 'Fail to create new department!',
                ];
            }
        } else {
            $data = [
                'status'  => 'error',
                'message' => $payload->department . ' already exist!',
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
    public function updateOne($payload)
    {
        // body
        $update_department = CompanyDepartment::find($payload->department_id);
        if ($update_department !== null) {
            $update_department->Department = $payload->department_name;
            if ($update_department->update()) {
                $data = [
                    'status'  => 'success',
                    'message' => $payload->department_name . ' updated!',
                ];
            } else {
                $data = [
                    'status'  => 'error',
                    'message' => 'Fail to update department!',
                ];
            }
        } else {
            $data = [
                'status'  => 'error',
                'message' => 'Failed to update, Try again',
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
    public function removeOne($payload)
    {
        // body
        $remove_department             = CompanyDepartment::find($payload->department_id);
        if ($remove_department->delete()) {
            $data = [
                'status'  => 'success',
                'message' => 'Department deleted!',
            ];
        } else {
            $data = [
                'status'  => 'error',
                'message' => 'Fail to delete department!',
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
    public function restoreAll($payload)
    {
        
    }

    /*
    |-----------------------------------------
    | RESTORE ONE DEPARTMENT
    |-----------------------------------------
    */
    public function restoreOne($payload)
    {
        
    }
}
