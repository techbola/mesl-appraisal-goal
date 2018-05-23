<?php

namespace Cavidel;

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model implements StaplerableInterface
{
    use EloquentTrait;
    protected $table   = 'tblStaff';
    protected $guarded = ['StaffRef'];
    public $timestamps = false;
    public $primaryKey = 'StaffRef';

    public function user()
    {
        return $this->belongsTo('Cavidel\User', 'UserID');
    }
    public function company()
    {
        return $this->belongsTo('Cavidel\Company', 'CompanyID');
    }
    public function tasks()
    {
        return $this->hasMany('Cavidel\ProjectTask', 'StaffID', 'StaffRef');
    }
    public function getProjectsAttribute()
    {
        $staff_id = $this->StaffRef;
        $projects = Project::whereHas('tasks', function ($query) use ($staff_id) {
            $query->where('StaffID', $staff_id);
        })->orWhere('SupervisorID', $staff_id)->get();
        return $projects;
    }
    public function getProjectsExtendedAttribute()
    {
        // Same as getProjectsAttribute(), but Including projects I've CREATED (Even if I'm not involved).
        $staff_id = $this->StaffRef;
        $projects = Project::whereHas('tasks', function ($query) use ($staff_id) {
            $query->where('StaffID', $staff_id);
        })->orWhere('SupervisorID', $staff_id)->orWhere('CreatedBy', $this->UserID)->get();
        return $projects;
    }

    public function getFullNameAttribute()
    {
        return $this->user->FullName;
    }
    public function getFirstNameAttribute()
    {
        return $this->user->first_name;
    }
    public function getMiddleNameAttribute()
    {
        return $this->user->middle_name;
    }
    public function getLastNameAttribute()
    {
        return $this->user->last_name;
    }

    public function payroll_details()
    {
        return $this->hasMany(PayrollMonthly::class, 'StaffID');
    }

    public function __construct(array $attributes = array())
    {
        $this->hasAttachedFile('PhotographLocation', [
            'styles' => [
                'medium' => '300x400',
                'thumb'  => '200x300',
            ],
        ]);

        parent::__construct($attributes);
    }

}
