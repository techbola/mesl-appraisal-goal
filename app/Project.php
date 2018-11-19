<?php

namespace Cavi;

use Illuminate\Database\Eloquent\Model;
use \Cavi\ProjectStatus;

class Project extends Model
{
  protected $table   = 'tblProjects';
  protected $guarded = ['ProjectRef'];
  public $primaryKey = 'ProjectRef';

  public $with = ['tasks'];
  protected $appends = ['status', 'progress', 'progress_percent'];


  // public function assignees()
  // {
  //   return $this->belongsToMany('Cavi\Staff', 'tblProjectStaff', 'project_id', 'staff_id');
  // }

  public function getAssigneesAttribute()
  {
    $tasks = ProjectTask::select('StaffID')->where('ProjectID', $this->ProjectRef)->groupBy('StaffID')->with('staff')->get();
    $staff = [];
    foreach ($tasks as $task) {
      $staff[] = $task->staff;
    }
    return $staff;
  }

  public function getUsersAttribute()
  {
    $tasks = ProjectTask::select('StaffID')->where('ProjectID', $this->ProjectRef)->groupBy('StaffID')->with('staff')->get();
    $users = [];
    foreach ($tasks as $task) {
      $users[] = $task->staff->user;
    }
    return $users;
  }
  public function getUserIdsAttribute()
  {
    $tasks = ProjectTask::select('StaffID')->where('ProjectID', $this->ProjectRef)->groupBy('StaffID')->with('staff')->get();
    $user_ids = [];
    foreach ($tasks as $task) {
      $user_ids[] = $task->staff->UserID;
    }
    // Include supervisor if not already in
    if (!in_array($this->supervisor->UserID, $user_ids)) {
      array_push($user_ids, $this->supervisor->UserID);
    }
    return $user_ids;
  }

  public function supervisor()
  {
    return $this->belongsTo('Cavi\Staff', 'SupervisorID', 'StaffRef');
  }
  // public function status()
  // {
  //   return $this->belongsTo('Cavi\ProjectStatus', 'StatusID');
  // }
  public function getStatusAttribute()
  {
    if ($this->progress != '100') {
      return ProjectStatus::where('slug', 'in progress')->first();
    } else {
      return ProjectStatus::where('slug', 'complete')->first();
    }
  }
  public function customer()
  {
    return $this->belongsTo('Cavi\Customer', 'CustomerID');
  }
  public function vendor()
  {
    return $this->belongsTo('Cavi\Vendor', 'VendorID');
  }
  public function tasks()
  {
    return $this->hasMany('Cavi\ProjectTask', 'ProjectID', 'ProjectRef');
  }
  public function steps()
  {
    return $this->hasManyThrough(Step::class, ProjectTask::class, 'ProjectID', 'TaskID');
  }
  public function issues()
  {
    return $this->hasMany('Cavi\IssueItem', 'ProjectID', 'ProjectRef');
  }
  public function chats()
  {
    return $this->hasMany('Cavi\ProjectChat', 'ProjectID', 'ProjectRef')->orderBy('created_at', 'desc');
  }
  public function files()
  {
    return $this->hasMany('Cavi\ProjectFile', 'ProjectID', 'ProjectRef')->orderBy('created_at', 'desc');
  }
  public function getOnTrackAttribute()
  {
    $today = date('Y-m-d');
    $data = $this->steps()->whereDate('tblSteps.EndDate', '<', $today)->where('Done', '0')->get();
    if (count($data) > 0) {
      return false;
    } else {
      return true;
    }
  }

  public function assignees_list()
  {
    $list = [];
    foreach ($this->assignees as $staff) {
      $list[] = $staff->user->ShortName;
    }
    return implode($list, ", ");
  }

  public function getProgressAttribute()
  {

    $progress = 0;
    if(count($this->tasks) > 0) {
      foreach ($this->tasks as $task) {
        $progress += $task->progress;
      }
      $progress = $progress / count($this->tasks);
    }
    return floor($progress);
  }

  public function getProgressPercentAttribute()
  {
    return $this->progress.'%';
  }

  public function getDaysLeftAttribute()
  {
    $today = strtotime(date('Y-m-d'));
    $end_date = strtotime($this->EndDate);
    if ($end_date > $today) {
      return ($end_date - $today) / 86400 . ' days left';
    } elseif ($end_date < $today && $this->status->name == 'Complete') {
      return 'Complete';
    } elseif ($end_date < $today) {
      return 'Overdue';
    } elseif ($end_date == $today) {
      return 'Ends Today!';
    }
  }

}
