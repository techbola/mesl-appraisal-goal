<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\ProjectStatus;

class Project extends Model
{
  protected $table   = 'tblProjects';
  protected $guarded = ['ProjectRef'];
  public $primaryKey = 'ProjectRef';


  // public function assignees()
  // {
  //   return $this->belongsToMany('App\Staff', 'tblProjectStaff', 'project_id', 'staff_id');
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

  public function supervisor()
  {
    return $this->belongsTo('App\Staff', 'SupervisorID', 'StaffRef');
  }
  // public function status()
  // {
  //   return $this->belongsTo('App\ProjectStatus', 'StatusID');
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
    return $this->belongsTo('App\Customer', 'CustomerID');
  }
  public function tasks()
  {
    return $this->hasMany('App\ProjectTask', 'ProjectID', 'ProjectRef');
  }
  public function issues()
  {
    return $this->hasMany('App\IssueItem', 'ProjectID', 'ProjectRef');
  }
  public function chats()
  {
    return $this->hasMany('App\ProjectChat', 'ProjectID', 'ProjectRef');
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
