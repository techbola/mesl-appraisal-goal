<?php

namespace MESL;

// use Codesleeve\Stapler\ORM\EloquentTrait;
// use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{

    // implements StaplerableInterface
    // use EloquentTrait;

    protected $table   = 'tblStaff';
    protected $guarded = ['StaffRef', 'YearsOfService', 'RefName', 'RefRelationship', 'RefOccupation', 'RefPhone', 'RefEmail', 'RefAddress'];
    public $timestamps = false;
    public $primaryKey = 'StaffRef';

    public $with = ['user'];

    public function user()
    {
        return $this->belongsTo('MESL\User', 'UserID');
    }
    public function company()
    {
        return $this->belongsTo('MESL\Company', 'CompanyID');
    }
    public function country()
    {
        return $this->belongsTo('MESL\Country', 'CountryID');
    }
    public function state()
    {
        return $this->belongsTo('MESL\State', 'StateID');
    }

    public function state_of_origin()
    {
        return $this->belongsTo('MESL\State', 'StateofOrigin');
    }

    public function country_of_origin()
    {
        return $this->belongsTo('MESL\Country', 'CountryOfOrigin');
    }

    public function country_of_birth()
    {
        return $this->belongsTo('MESL\Country', 'CountryOfBirth');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'GenderID');
    }

    public function marital_status()
    {
        return $this->belongsTo(MaritalStatus::class, 'MaritalStatusID');
    }

    public function location()
    {
        return $this->belongsTo('MESL\Location', 'LocationID');
    }
    public function tasks()
    {
        return $this->hasMany('MESL\ProjectTask', 'StaffID', 'StaffRef');
    }
    public function departments()
    {
        return $this->hasMany(Department::class, 'DepartmentRef', 'DepartmentID');
    }

    public function religion()
    {
        return $this->belongsTo('MESL\Religion', 'ReligionID');
    }

    public function company_department()
    {
        return $this->belongsTo(CompanyDepartment::class, 'DepartmentID', 'id');
    }
    public function supervisor()
    {
        return $this->hasOne(CompanySupervisor::class, 'staff_id', 'StaffRef');
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
        return $this->user->FullName ?? '';
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

    public function bank()
    {
        return $this->hasOne(Bank::class, 'BankRef', 'BankID');
    }

    public function scorecards()
    {
        return $this->hasMany('MESL\ScoreCard', 'StaffID');
    }

    public function subordinates()
    {
        return $this->hasMany('MESL\Staff', 'SupervisorID');
    }

    public function references()
    {
        return $this->hasMany(Reference::class, 'ReferenceID');
    }

    // public function __construct(array $attributes = array())
    // {
    //     $this->hasAttachedFile('PhotographLocation', [
    //         'styles' => [
    //             'medium' => '300x400',
    //             'thumb'  => '200x300',
    //         ],
    //     ]);
    //
    //     parent::__construct($attributes);
    // }

}
