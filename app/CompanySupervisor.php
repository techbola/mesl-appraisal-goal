<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use MESL\CompanyDepartment;
use MESL\User;

class CompanySupervisor extends Model
{

  public function staff()
  {
    return $this->belongsTo(Staff::class, 'staff_id', 'StaffRef');
  }
    /*
    |-----------------------------------------
    | LOAD ONE DEPARMENT
    |-----------------------------------------
     */
    public function loadOneSupervisor($payload)
    {
        // body
        $supervisor = CompanySupervisor::where("id", $payload->supervisor_id)->first();
        if ($supervisor !== null) {
            $department = CompanyDepartment::where("id", $supervisor->department_id)->first();
            $staff      = User::where("id", $supervisor->staff_id)->first();

            $data = [
                'id'            => $supervisor->id,
                'staff_id'      => $staff->id,
                'department_id' => $department->id,
                'first_name'    => ucfirst($staff->first_name),
                'last_name'     => ucfirst($staff->last_name),
                'department'    => $department->name,
            ];
        } else {
            $data = [];
        }

        // return
        return $data;
    }

    /*
    |-----------------------------------------
    | CREATE DEPARTMENT
    |-----------------------------------------
     */
    public function add($payload)
    {

        // check if already exist
        $already_exist = CompanySupervisor::where([["staff_id", $payload->staff_id], ['is_deleted', false]])->first();
        if ($already_exist == null) {

            if (empty($payload->department_id) || $payload->department_id == 0) {
                $data = [
                    'status'  => 'error',
                    'message' => 'Select a department',
                ];
            } elseif (empty($payload->staff_id) || $payload->staff_id == 0) {
                $data = [
                    'status'  => 'error',
                    'message' => 'Select an employee',
                ];
            } else {

                // check department already assigned
                $already_assign_department = CompanySupervisor::where([["department_id", $payload->department_id], ['is_deleted', false]])->first();
                if ($already_assign_department !== null) {
                    $data = [
                        'status'  => 'error',
                        'message' => 'Supervisor position already assigned',
                    ];
                } else {
                    // body
                    $this->staff_id      = $payload->staff_id;
                    $this->department_id = $payload->department_id;
                    $this->is_deleted    = false;
                    if ($this->save()) {
                        $data = [
                            'status'  => 'success',
                            'message' => 'Supervisor position assigned!',
                        ];
                    } else {
                        $data = [
                            'status'  => 'error',
                            'message' => 'Fail to assign a Supervisor!',
                        ];
                    }
                }
            }
        } else {
            $data = [
                'status'  => 'error',
                'message' => 'already assigned!',
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
        $update_department = CompanySupervisor::find($payload->supervisor_id);
        if ($update_department !== null) {
            $update_department->department_id = $payload->department_id;
            $update_department->staff_id      = $payload->staff_id;
            $update_department->is_deleted    = false;
            if ($update_department->update()) {
                $data = [
                    'status'  => 'success',
                    'message' => 'Supervisor position updated!',
                ];
            } else {
                $data = [
                    'status'  => 'error',
                    'message' => 'Fail to update Supervisor position!',
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
        $remove_department             = CompanySupervisor::find($payload->supervisor_id);
        $remove_department->is_deleted = true;
        if ($remove_department->delete()) {
            $data = [
                'status'  => 'success',
                'message' => 'Supervisor deleted!',
            ];
        } else {
            $data = [
                'status'  => 'error',
                'message' => 'Fail to delete Supervisor!',
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
        // body
        $restore_all = CompanySupervisor::where('is_deleted', true)->get();
        if (count($restore_all) > 0) {
            $total_no = 0;
            foreach ($restore_all as $department) {
                # code...
                $this->restoreOne($department);
                $total_no++;
            }
            $data = [
                'status'  => 'success',
                'message' => $total_no . ' data was restored',
            ];
        } else {
            $data = [
                'status'  => 'success',
                'message' => 'No data was restored',
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
    public function restoreOne($payload)
    {
        // body
        $restore_one             = CompanySupervisor::find($payload->id);
        $restore_one->is_deleted = false;
        if ($restore_one->update()) {
            $data = [
                'status'  => 'success',
                'message' => 'Data restored!',
            ];
        } else {
            $data = [
                'status'  => 'error',
                'message' => 'Fail to restore data!',
            ];
        }

        // return
        return $data;
    }

    /*
    |-----------------------------------------
    | LOAD ALL SUPERVISORS
    |-----------------------------------------
     */
    public static function allSupervisors()
    {
        // body
        $all_staffs     = User::all();
        $supervisor_box = [];
        foreach ($all_staffs as $staff) {
            $is_supervisor = CompanySupervisor::where([['staff_id', $staff->id], ['is_deleted', false]])->first();
            if ($is_supervisor !== null) {
                $is_department = CompanyDepartment::where('id', $is_supervisor->department_id)->first();
                if ($is_department !== null) {

                    $data = [
                        'id'         => $is_supervisor->id,
                        'staff_id'   => $is_supervisor->staff_id,
                        'first_name' => ucfirst($staff->first_name),
                        'last_name'  => ucfirst($staff->last_name),
                        'fullname'   => ucfirst($staff->first_name) . ' ' . ucfirst($staff->last_name),
                        'department' => $is_department->name,
                        'is_deleted' => $is_department->is_deleted,
                    ];
                } else {
                    $data = [
                        'id'         => $is_supervisor->id,
                        'staff_id'   => $is_supervisor->staff_id,
                        'first_name' => ucfirst($staff->first_name),
                        'last_name'  => ucfirst($staff->last_name),
                        'fullname'   => ucfirst($staff->first_name) . ' ' . ucfirst($staff->last_name),
                        'department' => 'No Department',
                    ];
                }

                array_push($supervisor_box, $data);
            }
        }

        // return
        return collect($supervisor_box);
    }
}
